<?php

namespace Admin\Controller;

use Common\Model\CodeModel;
use Think\Controller;

class LoginController extends Controller {
    public function index() {
        $this->display ( 'Index/login' );
    }
	/**
	 * 退出登录
	 */
	public function logout() {
		session_unset ();
		session_destroy ();
		session('[destroy]');
		$this->redirect ( 'Login/index' );
	}

	/**
	 * 清除缓存
	 */
	public function clrcache() {
		//1. 清除runtime文件夹
		if (file_exists ( RUNTIME_PATH)) {
			
			$ctrl=new \Org\Net\File();
			$ctrl->unlinkDir(RUNTIME_PATH);
			//$ctrl->unlinkDir(HTML_PATH);
			
			//2. 重建文件缓存(label)
			$db=M('label')->where('status=1')->find();
			if($db){
				$db=M('label')->where('status=1')->select();
				foreach($db as $key=>$value){
					lbl($value['name'],$value['info']);
				}
			}
			
			//3. 重建栏目内容数统计 
			$db=M('channel')->where('status=1')->find();
			if($db){
				$db=M('channel')->where('status=1')->select();
				foreach($db as $key=>$value){ 
					$this->updateChannelNum($value['sortpath']);
				}
			}
			
			//4.更新订单统计
			//$this->updateOrderStatistic();
		
			$this->ajaxReturn ( Array (
					'status' => 1 
			) );
		} else {
			$this->ajaxReturn ( Array (
					'status' => 0 
			) );
		}
		
		
		
	}
	//更新栏目内容数统计
	private function updateChannelNum($sortpath=''){
		$arr=str2arr($sortpath);
		$arr=arr2clr($arr);
		if(count($arr)>0){
			$count=0;
			foreach($arr as $key=>$value){
				$where=array();
				$where['status']=1;
    			$where['sortpath']=array('like','%,'.$value.',%');
				$count = M('content')->where($where)->count();
				M('channel')->where('id='.$value)->setField('num',$count);
			}
		}
	}
	/**
	 * 登录验证
	 * @param string $username	用户名
	 * @param string $userpwd	密码
	 * @param string $verify	验证码
	 */
	public function login($username = null, $userpwd = null) {
		// 保存登录信息
		if (IS_POST) {
            if( !isVerifyCorrect()){
                apiReturn(CodeModel::ERROR,'验证码错误！');
            }
            $username = I('post.username');
            $userpwd = I('post.pwd');
			$Rbac = new \Org\Util\Rbac ();
			$map ['username'] = $username;
			$map ['userpwd'] = md5($userpwd);
			$authInfo = $Rbac->authenticate ( $map );
			if (! $authInfo['id']) {
                apiReturn(CodeModel::ERROR,'用户名或密码错误！');
			}
			session ( C ( 'USER_AUTH_KEY' ), $authInfo ['id'] );
			session ( 'adminid', $authInfo ['id'] ); // 用户ID
			session ( 'adminname', $authInfo ['username'] ); // 角色ID
			
			$roleid=M('role_user')->where('user_id='.$authInfo['id'])->getField('role_id');
			session ( 'roleid', $roleid ); // 角色ID
			
			//取细分权限
			$where1=array();
			$where1['id']=$roleid;
			$db = M('role')->field('channel,shop')->where($where1)->find(); 
			$channel = $db['channel'];
			session ( 'channel_role', $channel ); // 栏目权限
			$data = array ();
			$data ['id'] = $authInfo ['id'];
			$data ['lastlogtime'] = date('Y-m-d H:i:s');
			$data ['lastlogip'] = getRealIp();
			$data ['logtimes'] = $authInfo ['logtimes'] + 1;
			M ( 'user' )->save ( $data );
			// 检查超级管理员
			if ($authInfo ['username'] == C ( "ADMIN_AUTH_KEY" )) {
				session ( C ( 'ADMIN_AUTH_KEY' ), true );
				session ( 'channel_role',null);
				session ( 'shop_role',null);
			}
			// 缓存访问权限
			$Rbac->saveAccessList ();
            apiReturn(CodeModel::CORRECT,'登录成功','/Admin/Index');
		} else {
			redirect ( U ( "/Admin/Login" ) );
		}
	}
	
    public function uppwd(){
        $old = I('post.old');
        $new = I('post.pwd');
        if(!regex($old,'require')){
            apiReturn(CodeModel::ERROR,'请输入原始密码');
        }else{
            $con ['userpwd'] = md5($old);
            $con ['username'] = session('adminname');
            $user = M('user')->where($con)->select();
            if(empty($user)){
                apiReturn(CodeModel::ERROR,'原始密码错误');
            }
        }
        if(regex($new,'require')){
            $con ['username'] = session('adminname');
            $savadata['userpwd'] = md5($new);
            if(false !== M('user')->where($con)->save($savadata)){
                session_unset ();
                session_destroy ();
                session('[destroy]');
                apiReturn(CodeModel::CORRECT,'修改成功');
            }else{
                apiReturn(CodeModel::ERROR,'修改失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'请输入新密码');
        }
    }
}
?>