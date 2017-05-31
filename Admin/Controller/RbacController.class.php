<?php

namespace Admin\Controller;

use Admin\Model\ContentModel;
use Common\Model\CodeModel;

class RbacController extends BaseController {
	public function index() {
	}

    /**
     * 批量操作
     */
    public function batchForModify() {
        $table = I('table');
        $id = I('id');
        $col = I('col');
        $v = I('val');
        $cols=array('cartname','status');
        if (in_array($col, $cols)) {
            switch($table){
                case 'sugcat' :
                    $db = M ()->execute ( 'update `' . C ( 'DB_PREFIX' ) . $table . '`  set `' . $col . '`="' . $v . '"  where `id` = (' . $id . ')' );
                    break;
            }

            if ($db !== false) {
               apiReturn(CodeModel::CORRECT,'操作成功');
            } else {
                apiReturn(CodeModel::ERROR,'操作失败');
            }
        }else {
            apiReturn(CodeModel::ERROR,'系统错误');
        }
    }



	/**
	 * 批量操作
	 */
	public function batch($table, $id, $col, $v) {
		$cols=array('rank','status','recommend','__del__','__under__','__sta__');
		if (in_array($col, $cols)) {
			switch ($col) {
				case '__del__' :
					if (substr ( $id, strlen ( $id ) - 1, 1 ) == ',') {
						$id = $id . '0';
					}
					$db = M ()->execute ( 'delete from `' . C ( 'DB_PREFIX' ) . $table . '`   where `id` in (' . $id . ') ' );
					
					break;
				case '__sta__' :
					if (substr ( $id, strlen ( $id ) - 1, 1 ) == ',') {
						$id = $id . '0';
					}
					$db = M ()->execute ( 'update `' . C ( 'DB_PREFIX' ) . $table . '`  set `status`=' . $v . '  where `id` in (' . $id . ') ' );

					break;
				case '__under__' : //上下架
                    $db = M ()->execute ( 'update `' . C ( 'DB_PREFIX' ) . $table . '` set `status`=' . $v . ' where `id` in (' . $id . ') ' );
					if ($v ==0 && $db) {
                        ContentModel::underCenter($id);//下架
					}
					break;
				default :
					if($table=='topic'){
                        $db = M ()->execute ( 'update `' . C ( 'DB_PREFIX' ) . $table . '` set `' . $col . '`=' . $v . ' where `tid` in (' . $id . ') ' );
					}else{
                        $db = M ()->execute ( 'update `' . C ( 'DB_PREFIX' ) . $table . '` set `' . $col . '`=' . $v . ' where `id` in (' . $id . ') ' );
					}
					break;
			}
			if ($db !== false) {
				$this->ajaxReturn ( Array (
						'status' => 1 
				) );
			} else {
				$this->ajaxReturn ( Array (
						'status' => 0
				) );
			}
		} else {
			$this->ajaxReturn ( Array (
					'status' => 0
			) );
		}
	}
	
	// 角色列表
	public function role() {
		$list = M ( "role" )->select ();
		$this->assign ( "list", $list );
		
		$this->display ();
	}
	
	// 添加角色
	public function addRole() {
		if (IS_POST) {
			$db = M ( "role" )->add ( $_POST );
			if ($db !== false) {
				$this->success ( "添加角色成功！" );
			} else {
				$this->error ( "添加失败！" );
			}
		} else {
			$pid = I ( "pid", 0 );
			$sort = M ( "role" )->max ( "id" );
			$this->assign ( "pid", $pid );
			$this->assign ( "sort", $sort + 1 );
			
			// 输出当前Role列表
			$list = M ( "role" )->select ();
			$this->assign ( "list", $list );
			$this->display ('addRole');
		}
	}
	
	// 编辑角色
	public function editRole($id = 0) {
		if (IS_POST) {
			$db = M ( "role" )->save ( $_POST );
			if ($db !== false) {
				$this->success ( "编辑角色成功！" );
			} else {
				$this->error ( "编辑失败！" );
			}
		} else {
			
			$db = M ( "role" )->find ( $id );
			$this->assign ( "db", $db );
			
			// 输出当前Role列表
			$list = M ( "role" )->select ();
			$this->assign ( "list", $list );
			$this->display ('editRole');
		}
	}
	
	// 删除角色
	public function deleteRole($id) {
		$db = M ( "role" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
	// 节点处理
	
	// 节点列表
	public function node() {
		$list = M ( "node" )->order ( "sort asc" )->select ();
		$list = node_merge ( $list );
		$this->assign ( "list", $list );
		
		$this->display ();
	}
	
	// 添加节点
	public function addNode() {
		if (IS_POST) {
			$db = M ( "node" )->add ( $_POST );
			if ($db !== false) {
				$this->success ( "添加节点成功！" );
			} else {
				$this->error ( "添加失败！" );
			}
		} else {
			// 获取参数：父级ID
			$pid = I ( "pid", 0 );
			$level = I ( "level", 0 );
			$sort = M ( "node" )->max ( "id" );
			$this->assign ( "pid", $pid );
			$this->assign ( "level", $level + 1 );
			$this->assign ( "sort", $sort + 1 );
			
			// 输出当前Node列表
			$list = M ( "node" )->order ( "sort asc" )->select ();
			$list = node_merge ( $list );
			$this->assign ( "list", $list );
			$this->display ('addNode');
		}
	}
	
	// 编辑节点
	public function editNode($id = 0) {
		if (IS_POST) {
			$db = M ( "node" )->save ( $_POST );
			if ($db !== false) {
				$this->success ( "编辑节点成功！" );
			} else {
				$this->error ( "编辑失败！" );
			}
		} else {
			
			$db = M ( "node" )->find ( $id );
			$this->assign ( "db", $db );
			
			// 输出当前Node列表
			$list = M ( "node" )->where('level in (1,2) and status=1')->order ( "sort asc" )->select ();
			$list = node_merge( $list );
			$this->assign ( "list", $list );
			$this->display ('editNode');
		}
	}
	
	// 删除节点
	public function deleteNode($id) {
		$db = M ( "node" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
	// 用户处理
	
	// 用户列表
	public function user() {
		$where['username']=array('neq',C('ADMIN_AUTH_KEY'));
		$list = M ( "user" )->where($where)->select ();
		$list = node_merge ( $list );
		$this->assign ( "list", $list );
		
		$this->display ();
	}
	
	// 添加用户
	public function addUser() {
		if (IS_POST) {
			$data = Array (
					"username" => I ( "username" ),
					"userpwd" => md5(I ( "userpwd" )),
					"remark" => I ( "remark" ),
					"sort" => I ( "sort" ),
					"status" => I ( "status" ),
					//"roleid" => implode ( ",", I ( "roleid" ) )
			);
			$db = M ( "user" )->add ( $data );
			
			if ($db !== false) {
                foreach ( I ( "roleid" ) as $v ) {
					$arr [] = array (
							'role_id' => $v,
							"user_id" => $db
					);
				}
				
				M ( "role_user" )->where ( array ("user_id" => $db ) )->delete ();
				M ( "role_user" )->addAll ( $arr );
				$this->success ( "添加用户成功！" );
			} else {
				$this->error ( "添加失败！" );
			}
		} else {
			// 获取参数：父级ID
			$pid = I ( "pid", 0 );
			$level = I ( "level", 0 );
			$sort = M ( "user" )->max ( "id" );
			$this->assign ( "pid", $pid );
			$this->assign ( "level", $level + 1 );
			$this->assign ( "sort", $sort + 1 );
			
			// 输出角色列表
			$rolelist = M ( "role" )->select ();
			$this->assign ( "rolelist", $rolelist );
			
			// 输出当前user列表
			$list = M ( "user" )->select ();
			$list = node_merge ( $list );
			$this->assign ( "list", $list );
			$this->display ('addUser');
		}
	}
	
	// 编辑用户
	public function editUser($id = 0) {
		if (IS_POST) {
			$pwd=I('userpwd');
			if(strlen($pwd)!==32){
				$pwd=md5($pwd);
			}
			$data = Array (
					"id" => $id,
					"username" => I ( "username" ),
					"userpwd" => $pwd,
					"remark" => I ( "remark" ),
					"sort" => I ( "sort" ),
					"status" => I ( "status" ) 
			);
			
			$db = M ( "user" )->save ( $data );
			
			if ($db !== false) {
				
				foreach ( I ( "roleid" ) as $v ) {
					$arr [] = array (
							'role_id' => $v,
							"user_id" => $id 
					);
				}
				
				M ( "role_user" )->where ( array (
						"user_id" => $id 
				) )->delete ();
				M ( "role_user" )->addAll ( $arr );
				
				$this->success ( "编辑用户成功！" );
			} else {
				$this->error ( "编辑失败！" );
			}
		} else {
			$this->assign ( "id", $id );
			$db = M ( "user" )->find ( $id );
			$this->assign ( "db", $db );
			
			// 已有角色列表
			
			$rolenow = M ( "role_user" )->where ( array (
					"user_id" => $id 
			) )->getField ( "role_id", true );
			
			// 输出角色列表
			$rolelist = M ( "role" )->select ();
			
			foreach ( $rolelist as $v ) {
				$selected = false;
				if (in_array ( $v ["id"], $rolenow )) {
					$selected = true;
				}
				
				$arr [] = array (
						"id" => $v ["id"],
						"name" => $v ["name"],
						"selected" => $selected 
				);
			}
			
			$this->assign ( "rolelist", $arr );
			
			// 输出当前user列表
			$list = M ( "user" )->select ();
			$list = node_merge ( $list );
			$this->assign ( "list", $list );
			$this->display ('editUser');
		}
	}
	
	// 删除用户
	public function deleteUser($id) {
		$db = M ( "user" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
	// 授权
	public function access($id = 0) {
		if (IS_POST) {
			$db = M ( "access" );
			$db->where ( array (
					"role_id" => $id 
			) )->delete ();
			
			$arr = array ();
			$access = I ( "access" );
			$channel = I ( "channel" );
			$shop = I ( "shop" );
			$arracc = str2arr ( $access );

			$data['channel']=$channel;
			$data['shop']=$shop;
			$db1=M('role')->where ('id='.$id)->save($data);
				
			foreach ( $arracc as $v ) {
				$tmp = explode ( "_", $v );
				if ($tmp [0] !== "") {
					$arr [] = array (
							"role_id" => $id,
							"node_id" => $tmp [0],
							"level" => $tmp [1] 
					);
				}
				;
			}
			
			if (false !== $db->addAll ( $arr )) { 
				$this->success ( "授权成功！" );
			} else {
				$this->error ( "授权失败" );
			}
		} else {
			//模块权限
			$fields = array (
					"id",
					"name",
					"title",
					"pid",
					"level" 
			);
			
			$where=array();
			if(empty($_SESSION[C('ADMIN_AUTH_KEY')])) {
				$where['super']=0;
			}
			$nodelist = M ( "node" )->field ( $fields )->where($where)->order ( "sort asc" )->select ();
			 
			$access = M ( "access" )->where ( array (
					"role_id" => $id 
			) )->getField ( "node_id", true );
			$nodelist = node_merge1 ( $nodelist, $access );
			$this->assign ( "nodelist", $nodelist );
			
			//栏目权限
			$fields = array (
					"id",
					"name", 
					"pid",
					"depth"
			);
				
			$where=array(); 
			$channellist = M ( "channel" )->field ( $fields )->where($where)->order ( "sort asc" )->select ();
			
			$access = M ( "role" )->where ( 'id='.$id)->getField ( "channel" );
			
			$access=str2arr($access);
			$channellist = node_merge1 ( $channellist, $access );
			
			$this->assign ( "channellist", $channellist );
			

			//门店权限
			$fields = array (
					"id",
					"name",
					"pid",
					"depth"
			);
			
			$where=array();
			$shoplist = M ( "shop" )->field ( $fields )->where($where)->order ( "sort asc" )->select ();
				
			$access = M ( "role" )->where ( 'id='.$id)->getField ( "shop" );
				
			$access=str2arr($access);
			$shoplist = node_merge1 ( $shoplist, $access );
				
			$this->assign ( "shoplist", $shoplist );
			
			
			$this->assign ( "id", $id );
			$this->display ();
		}
	}
}
?>