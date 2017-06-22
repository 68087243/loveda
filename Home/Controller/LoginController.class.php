<?php

namespace Home\Controller;

use Common\Model\AreaModel;
use Common\Model\CodeModel;
use Common\Model\UserModel;
Use \Think\Controller;

class LoginController extends Controller {

	public function index() {
        $this->display();
	}

    /**
     * 登录
     */
    public function login() {
        //验证码
        if(isset($_POST['verify'])){
            if( !isVerifyCorrect()){
                apiReturn(CodeModel::ERROR,'验证码错误！');
            }
        }
        $username = I("post.username", '', 'string');
        $password = I("post.password", '', 'string');
        if (empty($username) || empty($password)) {
            apiReturn(CodeModel::ERROR,'用户名或密码不能为空');
        } else {
            $remember = isset($_POST['autologin']) ? true : false;
            if(false===UserModel::login($username, $password,$remember,'web')){
                apiReturn(CodeModel::ERROR ,'登录失败');
            }else{
                if(session('to')){
                    $url = session('to');
                }else{
                    $url = '/';
                }
                apiReturn(CodeModel::CORRECT ,'登录成功',$url);
            }
        }
    }

    public function reg(){
        $data = M('member')->create();
        if($data){
            $data['birthdate'] = $_POST['year'].'年'.$_POST['month'].'月';
            if(!regex($data['tel'],'mob')){
                apiReturn(CodeModel::ERROR,'电话号码格式不正确');
            }
            if(strlen($data['password'])<5||strlen($data['password'])>18){
                apiReturn(CodeModel::ERROR,'密码长度应为4');
            }
            if(!$data['sex']){
                apiReturn(CodeModel::ERROR,'请选择性别');
            }
            if(!$data['account']){
                apiReturn(CodeModel::ERROR,'请填写账号');
            }else{
                $data['nickname'] = $data['account']; //注册时昵称默认为登录账户
            }
            if(!$data['proivce'] || !$data['city']){
                apiReturn(CodeModel::ERROR,'请选择所在城市');
            }
            if(UserModel::isExistNickname($data['account'])){
                apiReturn(CodeModel::ERROR,'账户已存在');
            }
            $password = $data['password'];
            $data['password'] = md5($password);
            $id = UserModel::reg($data);
            if($id){
                //注册完后自动登录
                if(true===UserModel::login($data['account'],$password,false,'web')){//注册后自动登录
                    apiReturn(CodeModel::CORRECT,'注册成功','/member/index.html');
                }else{
                    apiReturn(CodeModel::CORRECT,'注册成功','/login/index?returnurl=/member/index');
                }
            }else{
                apiReturn(CodeModel::ERROR,'注册失败.');
            }
        }else{
            apiReturn(CodeModel::ERROR,'注册失败，请刷新重试');
        }


    }

	public function register() {
        $areas =  AreaModel::getAreaAll();
        $priovce = array();
        $city = array();
        foreach ($areas as $area) {
            if ($area["parentid"] == 0 && $area["parentid"] !== null) { //排除中国和俄罗斯
                array_push($priovce, $area);
            } elseif ($area["parentid"] > 0) {
                array_push($city, $area);
            }
        }
        $this->assign('priovce',$priovce);
        $this->assign('city',$city);
        $this->display();
	}

	public function failure() {
        $this->display();
	}

	public function findpwd() {
        $this->display();
	}

	public function logout() {
        UserModel::setUser(null);
		session_unset ();
		session_destroy ();
		session('[destroy]');
		$this->redirect('/');
	}

    /**
     * 找回密码
     */
    public function findpwdAction(){
        $email = I('post.email');
        UserModel::reSetPwd($email);
    }
}
?>