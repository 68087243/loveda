<?php
namespace Common\Model;
use Org\Util\String;
use Think\Model;

class UserModel extends Model
{
    const LOG_IN = 1;//登录状态
	const MALE = 2;//男
	const FEMALE = 1;//女
	const NORMAL_USERS = 1;//正常使用的账号
    const NOUSERSTATE = -1;//禁用
    const TEL_STATE_UN = 0;//没有认证
    const VISITOR_MEMBER = 1;//普通会员
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
        session('loginstatus',true,1800);//登录状态半小时
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
        $con['account'] = $nickname;
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
        $data["loginstatus"] = self::LOG_IN;
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
                $con['account'] = $username;
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

    /**重置密码
     * @param $keywrod
     */
    public static function reSetPwd($email){
        $con['email'] = $email;
        $user = self::getUserByCon($con);
        if($user){
            $ctrl=new \Org\Util\String();
            $pwd = $ctrl->randString(6,1);
            $body=lbl('tpl_findpwd');
            if(isN($body)){
                apiReturn(CodeModel::ERROR,'发送邮件失败，请联系客服');
            }
            $preg="/{(.*)}/iU";
            $n=preg_match_all($preg,$body,$rs);
            $rs=$rs[1];
            if($n>0){
                foreach($rs as $v){
                    if(trim($v)=='name'){
                        $oArr[]='{ name }';
                        $tArr[]= $user['nickname']?$user['nickname']:$email;
                        $body=str_replace($oArr,$tArr,$body);
                    }
                    if(trim($v) == 'pwd'){
                        $oArr[]='{ pwd }';
                        $tArr[]= $pwd;
                        $body=str_replace($oArr,$tArr,$body);
                    }
                }
            }
            $subject='[名叔馆]重置密码';
            if(send_mail($email,$subject,$body)){
                $where['uid']=$user['uid'];
                if( M('member')->where($where)->setField('password',md5($pwd))){
                    list($name,$end)=explode('@',$email);
                    if(strlen($name)>5){
                        $email =  substr($name,0,3).'***@'.$end;
                    }else{
                        $email =  substr($name,0,1).'***@'.$end;
                    }
                    apiReturn(CodeModel::CORRECT,"新密码已发送到你的邮箱: $email,请注意查收",'/login/index.html');
                }
            }else{
                apiReturn(CodeModel::ERROR,'发送邮件失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'该邮箱地址还没有被注册绑定');
        }
    }

}
