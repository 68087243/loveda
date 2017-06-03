<?php

namespace Admin\Controller;

class FormController extends BaseController {

	/**
	 * 智能点餐列表，分页
	 */
	public function form() {
		$where = null;
		$searchtype = I ( 'searchtype' );
		$keyword = I ( 'keyword' );
		$status = I ( 'status' );
	
		switch ($searchtype) {
			case '0' : 
				$where ['ext1'] = $keyword; 
				break;
			case '1' :
				$where ['ext2'] = $keyword;
				break;
			case '2' :
				if (is_numeric ( $keyword )) {
					$where ['type'] = $keyword;
				}
				break;
		}
	
		if (is_numeric ( $status )) {
			$where ['status'] = $status;
		}
 
			
	
		// 分页
		$p = intval ( I ( 'p' ) );
		$p = $p ? $p : 1;
		$row = C ( 'VAR_PAGESIZE' );
	
		$rs = M ( "form" )->where ( $where )->order ( 'id desc' )->page ( $p, $row );
		$list = $rs->select ();
	
		$this->assign ( "list", $list );
		$count = $rs->where ( $where )->count ();
	
		if ($count > $row) {
			$page = new \Think\Page ( $count, $row );
			$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
			$this->assign ( 'page', $page->show () );
		}
	
		$this->assign ( "keyword", $keyword );
		$this->assign ( "status", $status );
		$this->assign ( "searchtype", $searchtype );
	
		$this->display ();
	}
	
	// 添加智能点餐
	public function addForm($pid = 0) {
		if (IS_POST) {
			$db = D ( "form" );
			$data = empty ( $data ) ? $_POST : $data;
	
			$data ['addip'] = get_client_ip (); 
			if (false !== $db->add ( $data )) {
				$this->success ( "添加反馈成功！" );
			} else {
				$this->error ( '添加反馈失败！' );
			}
		} else {
			$sort = M ( "form" )->max ( "id" );
			$this->assign ( "sort", $sort + 1 );
			$this->assign ( "pid", $pid );
	
			// 输出反馈分类列表
			$typelist = M ( "formtype" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "typelist", $typelist ); 
				
			// 输出当前Form列表
			$list = M ( "form" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "list", $list );
	
			$this->display ('addForm');
		}
	}
	
	// 编辑反馈
	public function editForm() {
		$id = I ( 'id' );
		if (IS_POST) {
			$db = D ( "form" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data );
			if ($data) {
				if(!isN($data['reply'])){
					$data['replytime']=time_format();
				}
				if ($db->save ( $data ) !== false) {
					$this->success ( "编辑反馈成功！" );
				} else {
					$this->error ( '编辑反馈失败' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
	
			$db = M ( "form" )->find ( $id );
			$this->assign ( "db", $db );
			// 输出反馈分类列表
			$typelist = M ( "formtype" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "typelist", $typelist );
			$this->display ('editForm');
		}
	}
	
	// 删除反馈
	public function deleteForm() {
		$id = I ( 'id' );
		$db = M ( "form" )->delete ( $id );
	
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
	
	
	/**
	 * 表单类型管理
	 */
	public function formtype() {
		$list = M ( "formtype" )->order ( 'sortpath asc' )->select ();
		$this->assign ( "list", $list );
		$this->display ();
	}
	
	// 添加表单类型
	public function addFormtype($pid = 0) {
		if (IS_POST) {
			$db = D ( "formtype" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data );
			$data ['fields']=arr2str($data ['fields']);
			// depth,sortpath
			$info = M ( 'formtype' )->getById ( $pid );
			$data ['depth'] = $info ['depth'] + 1;
			$sortpath = $info ['sortpath'];
			if ($data) {
				if ($db->add ( $data )) {
					// 更新sortpath
					$last_id = $db->getLastInsID ();
					if (empty ( $sortpath )) {
						$sortpath = '0,';
					}
					$db = M ( 'formtype' )->where ( 'id=' . $last_id );
					$db->save ( array (
							'sortpath' => $sortpath . $last_id . ','
					) );
					$this->success ( "添加表单类型成功！" );
				} else {
					$this->error ( '添加表单类型失败！' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
			$sort = M ( "formtype" )->max ( "id" );
			$this->assign ( "sort", $sort + 1 );
			$this->assign ( "pid", $pid );
				
			// 输出当前Formtype列表
			$list = M ( "formtype" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "list", $list );
			 
			$this->display ('addFormtype');
		}
	}
	
	// 编辑表单类型
	public function editFormtype($id = 0) {
		if (IS_POST) {
			$db = D ( "formtype" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data );

			$data ['fields']=arr2str($data ['fields']);
			//we ($data ['fields']);
			
			// 上级表单类型不能是自己
			if ($data ['pid'] == $id) {
				$this->error ( '上级不能是自己！' );
			}
				
			// depth,sortpath
			$info = M ( 'formtype' )->getById ( $data ['pid'] );
			// 有下级表单类型不能改变自己的上级
			if ($data ['pid'] !== $info ['pid']) {
				if ($data ['pid'] != '0') {
					$find = $db->where ( 'pid=' . $id )->count ();
					if ($find > 0) {
						$this->error ( '有下级表单类型时不能是改变自己的上级！' );
					}
				}
			}
			$data ['depth'] = $info ['depth'] + 1;
			$sortpath = $info ['sortpath'];
			
			if ($data) {
				if ($db->save ( $data ) !== false) {
					// 更新sortpath
					$last_id = $db->getLastInsID ();
					if (empty ( $sortpath )) {
						$sortpath = '0,';
					}
					$db = M ( 'formtype' )->where ( 'id=' . $last_id );
					$db->save ( array (
							'sortpath' => $sortpath . $last_id . ','
					) );
					$this->success ( "编辑表单类型成功！" );
				} else {
					$this->error ( '编辑表单类型失败' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
				
			$db = M ( "formtype" )->find ( $id );
			$this->assign ( "db", $db );
			
			// 输出当前Formtype列表
			$list = M ( "formtype" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "list", $list ); 
			$this->display ('editFormtype');
		}
	}
	
	// 删除表单类型
	public function deleteFormtype($id) {
		$db = M ( "formtype" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
	
	
	 
}
?>