<?php
namespace Home\Controller;

use Common\Model\CodeModel;
use Common\Model\UserModel;
use Think\Controller;

class BaseController extends Controller
{
    protected  $userid;

    public function _initialize(){
        $user = UserModel::getUser();
        if(empty($user)){
            if(!UserModel::cookieLogin(UserModel::WEB)){
                if (IS_POST){
                    apiReturn(CodeModel::ERROR,'你还没有登录');
                }else{
                    session('to',$_REQUEST['to']);
                    redirect('/login/index');
                }
            };
        }else{
            $this->assign('user',$user);
            $this->userid = $user['uid'];
        }
    }

}
?>