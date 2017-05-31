<?php

namespace Admin\Controller; 
use Think\Controller;

/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */
class QueryController extends Controller {
	public function index() {
		echo('');
	}
	
	public function content($pid=null,$selected=null,$rootid=null){
		$title = null;
		$content = null;
		$where = null;
		$searchtype = I ( 'searchtype' );
		$keyword = I ( 'keyword' );
		
		switch ($searchtype) {
			case '0' :
				$title = $keyword;
				break;
			case '1' :
				$content = $keyword;
				break;
			case '2' :
				if (is_numeric ( $keyword )) {
					$pid = $keyword;
				}
				break;
		}
		
		//$where ['status'] = 1;
		if (is_numeric ( $pid ) && $pid != 0) {
			$where ['pid'] = $pid;
		}
		if(isset($rootid)){
			$where['sortpath']= array('like','%,'.$rootid.',%');
		}
		if (! isN ( $title )) {
			$where ['title'] = array (
					'like',
					'%' . $title . '%' 
			);
		}
		if (is_numeric( $content )) {
			$where ['id'] =	$content;
		}
		
		// 分页
		$p = intval ( I ( 'p' ) );
		$p = $p ? $p : 1;
		$row = 9;//C ( 'VAR_PAGESIZE' );
		
		$rs = M ( "content" )->where ( $where )->order ( 'id desc' )->page ( $p, $row );
		$list = $rs->select ();
		$this->assign ( "list", $list );
		$count = $rs->where ( $where )->count ();
		
		if ($count > $row) {
			$page = new \Think\Page ( $count, $row );
			$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
			$this->assign ( 'page', $page->show () );
		}
		
		$this->assign ( "keyword", $keyword ); 
		$this->assign ( "searchtype", $searchtype );
		$selected=str_replace('，', ',', $selected);
		$selected=str_replace(' ', '', $selected);
		$this->assign ( "selected", $selected ); 
		
		$this->display ();
	}
	
}
