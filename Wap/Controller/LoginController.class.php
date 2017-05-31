<?php
namespace Wap\Controller;

use Common\Model\AreaModel;
use Common\Model\CodeModel;
use Common\Model\UserModel;
use Think\Controller;

class LoginController extends Controller {

    public function login(){
        if (IS_POST) {
            $username = I("post.username", '', 'string');
            $password = I("post.password", '', 'string');
            if (empty($username) || empty($password)) {
                apiReturn(CodeModel::ERROR,'用户名或密码不能为空');
            } else {
                $remember = isset($_POST['autologin']) ? true : false;
                if(false===UserModel::login($username, $password,$remember,'wap')){
                    apiReturn(CodeModel::CORRECT ,'登录失败');
                }else{
                    apiReturn(CodeModel::CORRECT ,'登录成功');
                }
            }
        }
        $this->display();
    }

    public function logout(){
        UserModel::setUser(null);
        cookie(UserModel::NOR_USER_WAP_COOKIE_KEY,null);
        redirect('/login/login');
    }

    public function reg(){
        if (IS_POST) {
            $username = I("post.nickname", '', 'string');
            $password = I("post.password", '', 'string');
            $repassword = I("post.repassword", '', 'string');
            $email = I("post.email", '', 'string');
            if (empty($username) || empty($password)) {
                apiReturn(CodeModel::ERROR,'用户名或密码不能为空');
            }
            if (strlen($password)<4) {
                apiReturn(CodeModel::ERROR,'密码长度不能小于4');
            }
            if ($password != $repassword) {
                apiReturn(CodeModel::ERROR,'密码不一致');
            }
            if (!$_POST['proivce']&&!$_POST['city']) {
                apiReturn(CodeModel::ERROR,'请选择城市');
            }
            if (!regex($email,'email')) {
                apiReturn(CodeModel::ERROR,'邮箱格式不正确');
            }

            if($data = D('member')->create()){
                $data['password'] = md5($password);
                if(false===UserModel::reg($data)){
                    apiReturn(CodeModel::ERROR ,'注册失败');
                }else{
                    if(UserModel::login($username, $password,true,'wap')){
                        apiReturn(CodeModel::CORRECT ,'注册成功','/user/index.html');
                    }else{
                        apiReturn(CodeModel::CORRECT ,'注册成功','/login/login.html');
                    }
                }
            }else{
                apiReturn(CodeModel::ERROR,D('member')->getError());
            }
        }else{
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
            $this->assign('headtitle','注册');
            $this->display();
        }

    }

}