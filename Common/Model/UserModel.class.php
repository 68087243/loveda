<?php
namespace Common\Model;
use Org\Util\String;
use Think\Model;

class UserModel extends Model
{
	const MALE = 1;//男
	const FEMALE = 0;//女

	const NORMAL_USERS = 1;//正常使用的账号
    const NOUSERSTATE = -1;//禁用
    const TEL_STATE_UN = 0;//没有认证
    const WAP = 'wap';//移动端登录
    const WEB = 'web';//pc端登录
    const NOR_USER_WEB_COOKIE_KEY = "user_web_token";
    const NOR_USER_WAP_COOKIE_KEY = "user_wap_token";
    const EXPIRE_TIME = 2592000;//30天

    // 自动验证设置
    protected $_validate = array(
        array('nickname', 'require', "用户名不能为空", Model::MUST_VALIDATE),
        array("nickname","","用户名已经存在",0,'unique',1),
        array("email","","邮箱已被注册",0,'unique',1),
        array('password','require', "密码不能为空", Model::MUST_VALIDATE),
    );

    public static function setUser($user){
        session('user',$user);
    }

    public static function getUser(){
        return session('user');
    }

    public static function isExistTel($tel){
        $con['tel'] = $tel;
        $user = self::getUserByCon($con);
        if(!empty($user)){
            return true;
        }
        return false;
    }

    public static function isExistNickname($nickname){
        $con['nickname'] = $nickname;
        $user = self::getUserByCon($con);
        if(!empty($user)){
            return true;
        }
        return false;
    }
    public static function isExistEmail($email){
        $con['email'] = $email;
        $user = self::getUserByCon($con);
        if(!empty($user)){
            return true;
        }
        return false;
    }

    /**
     * 根据userid获取用户
     * @param $userId
     * @return bool|mixed
     */
    public static function getUserById($userId){
        if(regex($userId,'number')){
            return M('member')->find($userId);
        }else{
            return false;
        }
    }

    public static function getUserByCon($con){
        $field = 'uid,nickname,tel,sex,picture,proivce,city,level,income,marriage,weight,age';
        return M('member')->where($con)->field($field)->select();
    }

    /**
     *  生成新的记忆token
     * @return type
     */
    public static function newToken(){
        import("ORG.Util.String");
        return md5(String::randString(32));
    }

    /**
     * 获取用户token
     * @param unknown $userId
     * @param unknown $remember
     * @param unknown $type
     */
    public static function getUserToken($userId, $remember){
        $data = array();
        if($remember){
            $rememberToken = UserModel::newToken();
            $data['cache_token'] = md5($rememberToken);
        }
        $data["loginip"] = ip2long($_SERVER["REMOTE_ADDR"]);
        $data["logintime"] = date("Y-m-d H;i;s", time());
        $saveResult = D("member")->where(array("uid"=>$userId))->save($data);
        if($saveResult === false){
            return false;
        }else{
            return $rememberToken;
        }
    }

    /**
     * @param $type
     * @return bool|mixed
     */
    public static function cookieLogin($type){
        if($type == self::WEB){
            $token = cookie(self::NOR_USER_WEB_COOKIE_KEY);
        }elseif($type == self::WAP){
            $token = cookie(self::NOR_USER_WAP_COOKIE_KEY);
        }

        if(empty($token)){
            return false;
        }
        $con['cache_token'] = md5($token);
        if(!empty($con)){
            $user = D("member")->where($con)->find();
            if(!empty($user)){
                self::setUser($user);
                return $user;
            }
        }
        return false;
    }

    /**
     * 设置cookie
     * @param $userid
     * @param $remember
     * @param $type
     */
    public static function updateUserAndSetCookie($userid,$remember,$type){
        $rememberToken = self::getUserToken($userid, $remember, $type);
        if($rememberToken){
            if($remember){
                if($type == self::WEB){
                    cookie(self::NOR_USER_WEB_COOKIE_KEY, $rememberToken, array("expire"=>self::EXPIRE_TIME));
                }elseif($type == self::WAP){
                    cookie(self::NOR_USER_WAP_COOKIE_KEY, $rememberToken, array("expire"=>self::EXPIRE_TIME));
                }
            }else{
                if($type == self::WEB){
                    cookie(self::NOR_USER_WEB_COOKIE_KEY, 'null');
                }elseif($type == self::WAP){
                    cookie(self::NOR_USER_WAP_COOKIE_KEY, 'null');
                }
            }
        }
    }

    /**
     *用户登录
     * @param $username
     * @param $userpwd
     * @param $remember
     * @return bool|string
     */
    public static  function login($username, $userpwd,$remember,$type) {
        if ($username && $userpwd) {
            if(regex($username,'mob')){
                $con['tel'] = $username;
            }elseif(regex($username,'email')){
                $con['email'] = $username;
            }else{
                $con['nickname'] = $username;
            }
            $con['password'] = md5($userpwd);
            $user = D("member")->where($con)->find();
            if(!empty($user)){
                if($user['status']==self::NOUSERSTATE){
                   apiReturn(CodeModel::ACCOUNT_DISABLE,"用户已被禁用，请联系管理员");
                }else{
                    self::updateUserAndSetCookie($user['uid'], $remember,$type);
                    self::setUser($user);
                    return true;
                }
            }else{
                apiReturn(CodeModel::ERROR,"用户名，密码不正确");
            }
        }else{
            return false;
        }
    }


    /**编辑用户并更新用户缓存
     * @param $userid
     * @param $data
     * @return bool
     */
    public static function modifyMember($userid,$data,$type){
        if(regex($userid,'number') && !empty($data)){
            $con['uid'] = $userid;
            if(false !== M('member')->where($con)->save($data)){
                $user = self::getUserById($userid);
                UserModel::updateUserAndSetCookie($userid,true,$type);
                self::setUser($user);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getuserByUsername($username){
        $con['nickname'] = $username;
        return M('member')->where($con)->find();
    }

    public static function checkMemberIfCanReply($uid){
        self::getUserById($uid);
    }

    /**
     * 注册
     * @param $data
     * @return bool|mixed
     */
    public static function reg($data){
        $db = M ( 'member' )->add ( $data );
        if($db>0){
            return $db;
        }
        return false;
    }

}
