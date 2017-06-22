<?php
namespace Wap\Controller;

use Common\Model\CodeModel;
use Common\Model\UserModel;
use Think\Controller;

class BaseController extends Controller
{
    protected $userid;

    public function _initialize(){
        $user = UserModel::getUser();
        if(empty($user)){
            if(!UserModel::cookieLogin(UserModel::WEB)){
                if (IS_POST){
                    apiReturn(CodeModel::ERROR,'你还没有登录');
                }else{
                    session('to',$_REQUEST['to']);
                    redirect('/login/login');
                }
            };
        }else{
            if(session('loginstatus')){//登录状态
                session('user',$user,1800);//重置缓存时间
                $this->assign('user',$user);
                $this->userid = $user['uid'];
            }else{
                $data['loginstatus'] = 0;//取消登录状态
                UserModel::modifyMember($user['uid'],$data);
                UserModel::setUser('');
                redirect('/login/login');
            }
        }
    }

}
?>