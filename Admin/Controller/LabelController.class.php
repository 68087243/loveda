<?php

namespace Admin\Controller;

class LabelController extends BaseController {
	public function index() {
	}

	/**
	 * 标签列表，分页
	 */
	public function label() {
		$where = null;
		$searchtype = I ( 'searchtype' );
		$keyword = I ( 'keyword' ); 
		$status = I ( 'status' );
		
		switch ($searchtype) {
			case '0' :
				$name = $keyword;
				break;
			case '1' :
				$info = $keyword;
				break; 
		}

		if (is_numeric ( $status )) {
			$where ['status'] = $status;
		}
		if (!isN ( $name )) {
			$where ['name'] = array('like','%'.$name.'%');
		}
		if (!isN ( $info )) {
			$where ['info'] = array('like','%'.$info.'%');
		}
 
		// 分页
		$p = intval ( I ( 'p' ) );
		$p = $p ? $p : 1;
		$row = C ( 'VAR_PAGESIZE' );
	
		$rs = M ( "label" )->where ( $where )->order ( 'id desc' )->page ( $p, $row );
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
		$this->assign ( "status", $status ); 
	
		$this->display ();
	}
	
	// 添加标签
	public function addLabel() {
		if (IS_POST) {
			$db = D ( "label" );
			$data = empty ( $data ) ? $_POST : $data; 
			$data = $db->create ( $data ); 
			if (false !== $db->add ( $data )) {
				lbl($data['name'],$data['info']);
				$this->success ( "添加标签成功！" );
			} else {
				$this->error ( '添加标签失败！' );
			}
		} else {

			$sort = M ( "label" )->max ( "id" );
			$this->assign ( "sort", $sort + 1 );
			$this->display ('addLabel');
		}
	}
	
	// 编辑标签
	public function editLabel() {
		$id = I ( 'id' );
		if (IS_POST) {
			$db = D ( "label" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data ); 
			if ($data) {
				if ($db->save ( $data ) !== false) { 
					lbl($data['name'],$data['info']);
					$this->success ( "编辑标签成功！" );
				} else {
					$this->error ( '编辑标签失败' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
				
			$db = M ( "label" )->find ( $id );
			$this->assign ( "db", $db ); 
			
			$this->display ('editLabel');
		}
	}
	
	// 删除标签
	public function deleteLabel($id=null) { 
		$db = M ( "label" )->delete ( $id ); 
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
 
}
?>