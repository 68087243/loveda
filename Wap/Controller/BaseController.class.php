<?php
namespace Wap\Controller;

use Common\Model\UserModel;
use Think\Controller;

class BaseController extends Controller
{
    protected $userid;

    public function _initialize(){
        $user = UserModel::getUser();
        if(empty($user)){
            if(!UserModel::cookieLogin(UserModel::WAP)){
                redirect('/login/login');
            };
        }else{
            $this->assign('user',$user);
            $this->userid = $user['uid'];
        }
    }

}
?>