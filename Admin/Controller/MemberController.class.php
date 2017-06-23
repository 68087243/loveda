<?php

namespace Admin\Controller;

use Admin\Model\LevelModel;
use Admin\Model\OrderModel;
use Common\Model\AddressModel;
use Common\Model\AreaModel;
use Common\Model\CodeModel;
use Common\Model\DiscountModel;
use Common\Model\UserModel;
use Common\Model\UserPhotoModel;

class MemberController extends BaseController {


    public function photo(){
        if(is_number($_REQUEST['status'])){
            $where['p.status'] = $_REQUEST['status'];
        }
        if(!empty($_REQUEST['keyword'])){
            $where['_string'] = "p.note like '%{$_REQUEST['keyword']}%' or m.nickname like '%{$_REQUEST['keyword']}%'";
        }
        if(!empty($_REQUEST['type'])){
            $where['type'] = $_REQUEST['type'];
        }
        // 分页
        $row = 25;
        $count = M ( "member_photo" )->alias('p')->join('t_member as m on m.uid = p.uid')->where ( $where )->count();
        $page = new \Think\Page ( $count, $row );
        $list =M ( "member_photo" )->alias('p')->join('t_member as m on m.uid = p.uid')->where ( $where )
            ->field( 'p.*,m.nickname')->order('m.uid desc')->limit($page->firstRow,$page->listRows)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $this->display();
    }

    public function modifyPhoto(){
        $data = I('post.');
        if(false!== UserPhotoModel::modifyPhoto($data['id'],$data)){
            apiReturn(CodeModel::CORRECT,'操作成功');
        }else{
            apiReturn(CodeModel::ERROR,'操作失败');
        }
    }


    /**
     * 等级管理
     */
    public function level() {
        $list = LevelModel::getLevel();
        $list1 = myArraySort($list,'level',SORT_DESC);
        $this->assign ( "maxlevel", $list1[0]['level']);
        $this->assign ( "list", $list);
        $this->display ();
    }

    public function modifylevel(){
        $id = I('post.id');
        $data = M('level')->create();
        if(regex($id,'number')){
           $rs =  LevelModel::modifyLevel($id,$data);
        }else{
            $rs = LevelModel::addLevel($data);
        }
        if(false!== $rs){
            apiReturn(CodeModel::CORRECT,'操作成功');
        }else{
            apiReturn(CodeModel::CORRECT,'操作失败');
        }
    }

    public function  delLevel(){
        $id = I('post.id');
       if(LevelModel::delLevel($id)){
           apiReturn(CodeModel::CORRECT,'操作成功');
       }else{
           apiReturn(CodeModel::CORRECT,'操作失败');
       }
    }

    /**
     * 会员列表，分页
     */
    public function member() {
        if(!empty($_REQUEST['keyword'])){
            $where['_string'] = "m.nickname like '%{$_REQUEST['keyword']}%' or m.tel like '%{$_REQUEST['keyword']}%' or m.qqid like '%{$_REQUEST['keyword']}%'";
        }
        if(!empty($_REQUEST['proivce'])){
            $where['m.proivce'] = $_REQUEST['proivce'];
        }
        if(!empty($_REQUEST['city'])){
            $where['m.city'] = $_REQUEST['city'];
        }
        if(isset($_REQUEST['levelid']) && $_REQUEST['levelid']){
            $where['m.level'] = $_REQUEST['levelid'];
        }
        // 分页
        $row = 25;
        $count = M ( "member" )->alias('m')->join('t_level as l on m.level = l.level')->where ( $where )->count();
        $page = new \Think\Page ( $count, $row );
        $list = M ( "member" )->alias('m')->join('t_level as l on m.level = l.level')->where ( $where )
            ->field('m.*,l.name as levelname')->order('m.uid desc')->limit($page->firstRow,$page->listRows)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $areas =  AreaModel::getAreaAll();
        $proivce = array();
        $city = array();
        foreach ($areas as $area) {
            if ($area["parentid"] == 0 && $area["parentid"] !== null) { //排除中国和俄罗斯
                array_push($proivce, $area);
            } elseif ($area["parentid"] > 0) {
                array_push($city, $area);
            }
        }
        $this->assign('proivce',$proivce);
        #$this->assign('city',$city);
        // 输出当前Member等级列表
        $this->assign ( "levels", LevelModel::getLevel(true));
        $this->display ();
    }


    // 编辑会员
    public function editMember() {
        $id = I ( 'id' );
        if(is_number($_REQUEST['status'])){
            $where['p.status'] = $_REQUEST['status'];
        }
        if(!empty($_REQUEST['keyword'])){
            $where['_string'] = "p.note like '%{$_REQUEST['keyword']}%' or m.nickname like '%{$_REQUEST['keyword']}%'";
        }
        if(!empty($_REQUEST['type'])){
            $where['p.type'] = $_REQUEST['type'];
        }
        $where['p.uid'] = $id;
        // 分页
        $row = 25;
        $count = M ( "member_photo" )->alias('p')->join('t_member as m on m.uid = p.uid')->where ( $where )->count();
        $page = new \Think\Page ( $count, $row );
        $list =M ( "member_photo" )->alias('p')->join('t_member as m on m.uid = p.uid')->where ( $where )
            ->field( 'p.*,m.nickname')->order('m.uid desc')->limit($page->firstRow,$page->listRows)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        // 输出当前Member等级列表
        $list = M ( "level" )->where ( 'status=1' )->order ( 'id desc' )->select ();
        $this->assign ( "level", $list );
        $user = UserModel::getUserById($id);
        $this->assign ( "user", $user );

        $areas =  AreaModel::getAreaAll();
        $proivce = array();
        $city = array();
        foreach ($areas as $area) {
            if ($area["parentid"] == 0 && $area["parentid"] !== null) { //排除中国和俄罗斯
                array_push($proivce, $area);
            } elseif ($area["parentid"] > 0) {
                array_push($city, $area);
            }
        }
        $this->assign('proivce',$proivce);
        $this->display ('editMember');

    }

    /**
     * 编辑用户
     */
    public function modifyUser(){
        $data = $_POST;
        if(!isset($data['uid']) || !$data['uid']){
            apiReturn(CodeModel::ERROR,'修改未知用户,请退出当前页面重试');
        }
        $user = UserModel::getUserById($data['uid']);
        if(isset($data['tel']) && $user['tel'] !=$data['tel']){
            if(!regex($data['tel'],'mob')){
                apiReturn(CodeModel::ERROR,'电话格式错误');
            }
            if(UserModel::isExistTel($data['tel'])){
                apiReturn(CodeModel::ERROR,'该电话号码已存在');
            }
        }
        if(isset($data['nickname']) && $user['nickname'] !=$data['nickname']){
            if(UserModel::isExistNickname($data['nickname'])){
                apiReturn(CodeModel::ERROR,'昵称已存在');
            }
        }
        if(isset($data['email']) && $user['email'] !=$data['email']){
            if(!regex($data['email'],'email')){
                apiReturn(CodeModel::ERROR,'邮箱格式错误');
            }
            if(UserModel::isExistEmail($data['email'])){
                apiReturn(CodeModel::ERROR,'邮箱已存在');
            }
        }
        if ($data) {
            if (UserModel::modifyMember($data['uid'],$data) !== false) {
                apiReturn(CodeModel::CORRECT, "编辑会员成功！" );
            } else {
                apiReturn(CodeModel::ERROR, "编辑会员失败！" );
            }
        }else{
            apiReturn(CodeModel::ERROR);
        }
    }

	// 删除会员
	public function deleteMember($id) {
		$db = M ( "member" )->delete ( $id );
		if ($db !== false) { 
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}

	// 编辑等级
	public function editLevel($id = 0) {
		if (IS_POST) {
			$db = D ( "level" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data );
			
			// 上级等级不能是自己
			if ($data ['pid'] == $id) {
				$this->error ( '上级不能是自己！' );
			}
			
			// depth,sortpath
			$info = M ( 'level' )->getById ( $data ['pid'] );
			// 有下级等级不能改变自己的上级
			if ($data ['pid'] !== $info ['pid']) {
				if ($data ['pid'] != '0') {
					$find = $db->where ( 'pid=' . $id )->count ();
					if ($find > 0) {
						$this->error ( '有下级等级时不能是改变自己的上级！' );
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
					$db = M ( 'level' )->where ( 'id=' . $last_id );
					$db->save ( array (
							'sortpath' => $sortpath . $last_id . ',' 
					) );
					$this->success ( "编辑等级成功！" );
				} else {
					$this->error ( '编辑等级失败' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
			
			$db = M ( "level" )->find ( $id );
			$this->assign ( "db", $db );
			
			// 输出当前Level列表
			$list = M ( "level" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "list", $list );
			
			$this->display ('editLevel');
		}
	}
	
	// 删除等级
	public function deleteLevel($id) {
		$db = M ( "level" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}


}
?>