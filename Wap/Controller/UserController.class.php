<?php
namespace Wap\Controller;

use Common\Model\AreaModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\FavoriteModel;
use Common\Model\FriendsModel;
use Common\Model\GuestbookModel;
use Common\Model\MessageModel;
use Common\Model\ReplyModel;
use Common\Model\TopicModel;
use Common\Model\UserModel;
use Common\Model\UserPhotoModel;
use Think\Controller;
use Think\Page;
class UserController extends BaseController {

    public function index(){
        $con['uid'] =$this->userid;
        $con['type'] =UserPhotoModel::AVATAR_TYPE;
        $con['status'] = UserPhotoModel::IN_AUDIT;
        $inauditAvatar =   UserPhotoModel::getUserPhotoByCon($con,UserPhotoModel::AVATAR_TYPE);
        $this->assign('inauditAvatar',$inauditAvatar);//审核中的头像
        $msg = MessageModel::getNewMsgNumByUid($this->userid);
        $this->assign('msgrow',$msg);

        $user = UserModel::getUser();
        if($user){
            $habbys = '';
            $pairing = '';
            if($user['hobbyids']){
                $con1['_string'] = "hid in({$user['hobbyids']})";
                $habby = D('habby')->where($con1)->select();
                foreach($habby as $val){
                    if($val){
                        $habbys.=$val['name'].'   ';
                    }
                }
            }
            $habbys.= $user['hobby_note'];
            $this->assign('habbys',$habbys);
            if($user['pairingids']){
                $con2['_string'] = "hid in({$user['pairingids']})";
                $pairings= D('pairing')->where($con2)->select();
                foreach($pairings as $val){
                    if($val){
                        $pairing.=$val['name'].'   ';
                    }
                }
            }
            $pairing.=$user['pairing_note'];
            $this->assign('pairing',$pairing);
        }
        $this->display();
    }

    public function uploadPhoto(){
        $type = I('post.scope');
        $data = M('member_photo')->create();
        if($type == 'avatar'){ //头像
            $con['uid'] =$this->userid;
            $con['type'] =UserPhotoModel::AVATAR_TYPE;
            $con['status'] = UserPhotoModel::IN_AUDIT;
            $list =  UserPhotoModel::getUserPhotoByCon($con);
            if(!empty($list)){
                apiReturn(CodeModel::ERROR,'有头像正在审核中，，，');
            }
            $data['type'] = UserPhotoModel::AVATAR_TYPE;
        }else{
            $data['type'] = UserPhotoModel::PHOTO_TYPE;
        }
        if(isset($data['img']) && $data['img']){
            $data['uid'] = $this->userid;
            if($id = UserPhotoModel::addImg($data)){
                apiReturn(CodeModel::CORRECT,'上传成功',$id);
            }else{
                apiReturn(CodeModel::ERROR,'上传失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'上传图片方式不正确');
        }
    }
    //修改用户信息
    public function info(){
        if (IS_POST) {
            $data = M('member')->create();
            $data = array_filter($data);
            if(false !== UserModel::modifyMember($this->userid,$data,UserModel::WAP)){
                apiReturn(CodeModel::CORRECT,'修改成功');
            }else{
                apiReturn(CodeModel::ERROR,'修改失败');
            }
        }else{
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
            $this->assign('city',$city);
            $user = UserModel::getUser();
            $this->assign('user',$user);
            $this->assign('headtitle','修改资料');
            $this->display();
        }
    }

    public function friends(){
        $this->assign('headtitle','我的好友');
        $this->assign('cuid', $this->userid);
        $this->display();
    }

    public function delFriend(){
        $fuid = I('post.fuid');
        if(FriendsModel::delFriend($this->userid,$fuid)){
            apiReturn(CodeModel::CORRECT,'删除成功!');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败!');
        }
    }

    public function getFriends(){
        $p = I('page',0);
        $offset = 15;
        $star = $p*$offset;
        //查询所有我的好友包含状态为待回复的
        $con['f.uid'] = $this->userid;
        $list = D('friends')->alias('f')->join('t_member as m on m.uid = f.f_uid')
            ->field('m.nickname,m.picture,m.birthdate,m.describe,f.*')
            ->where($con)->order('f.fid desc')->limit($star,$offset)->select();
        foreach($list as &$val){
            $val['age'] = getAge($val['birthdate']);
        }
        apiReturn(CodeModel::CORRECT,'',$list);
    }

    //接受
    public function refuseFriend(){
        $fid = I('post.fid');
        $fuid = I('post.fuid');
        $type = I('post.type');
        if(FriendsModel::refuseFriend($fid)){
            $user = UserModel::getUser();
            //给声请人发送接受好友提示消息
            $msg['type'] = MessageModel::ACCEPT_FRIENDS_MSG;
            if($type ==1){ //撤销
                $msg['message'] = "[{$user['nickname']}]撤销了对您的好友请求!";
            }else{ //拒绝
                $msg['message'] = "[{$user['nickname']}]拒绝了您的好友请求!";
            }
            $msg['uid'] = $fuid;
            $msg['operator'] =  $this->userid;
            MessageModel::addMsg($msg);
            if($type ==1){ //撤销
                apiReturn(CodeModel::CORRECT,'撤销成功!');
            }else{ //拒绝
                apiReturn(CodeModel::CORRECT,'拒绝成功!');
            }
        }else{
            if($type ==1){ //撤销
                apiReturn(CodeModel::ERROR,'撤销失败!');
            }else{ //拒绝
                apiReturn(CodeModel::ERROR,'拒绝失败!');
            }
        }

    }


    //相册
    public function photo(){
        if (IS_POST) {
            $data = M('member_photo')->create();
            if(isset($data['img']) && $data['img']){
                $data['uid'] = $this->userid;
                if($id = UserPhotoModel::addImg($data)){
                    apiReturn(CodeModel::CORRECT,'上传成功',$id);
                }else{
                    apiReturn(CodeModel::ERROR,'上传失败');
                }
            }else{
                apiReturn(CodeModel::ERROR,'上传图片方式不正确');
            }
        }else{
            if(!isset( $_REQUEST['uid']) ||  !$_REQUEST['uid'] ){
                $uid = $this->userid;
            }else{
                $uid = $_REQUEST['uid'];
                $fuser = UserModel::getUserById($uid);
                $this->assign('usersex',$fuser['sex']);
            }
            $isself = false;
            if($uid == $this->userid) {
                $isself = true;
            }

            $photolist = UserPhotoModel::getUserPhoto($uid);
            $this->assign('isself',$isself);
            $this->assign('photolist',$photolist);
            $this->assign('headtitle','相册');
            $this->display();
        }
    }

    //相册
    public function delimg(){
        $imgid = I('post.imgid');
        if(false !==UserPhotoModel::delPhoto($imgid,$this->userid)){
            apiReturn(CodeModel::CORRECT,'删除成功');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败');
        }
    }

    //个人设置
    public function uppwd(){
        if (IS_POST) {
            $oldpwd = I('post.oldpassword');
            $pwd = I('post.password');
            $pwd2 = I('post.password2');
            $user = UserModel::getUser();
            if($user['password'] !== md5($oldpwd)){
                apiReturn(CodeModel::ERROR,'原始密码错误');
            }
            if(trim($pwd)!==trim($pwd2)){
                apiReturn(CodeModel::ERROR,'重复密码输入不一致');
            }
            $savedata['password'] = md5(trim($pwd));
            if(false!== UserModel::modifyMember($this->userid,$savedata,UserModel::WAP)){
                apiReturn(CodeModel::CORRECT,'修改成功,请重新登录');
            }else{
                apiReturn(CodeModel::CORRECT,'修改失败');
            }
        }else{
            $this->assign('headtitle','修改密码');
            $this->display();
        }
    }


    public function postTopic(){
        $club = ClubModel::getClub();
        $this->assign('club',$club);
        $this->display('post_topic');
    }

    public function cqing(){
        if(IS_POST){
            $user = UserModel::getUser();
            $key = 'CHUA:QING:COUNT:UID'.$_REQUEST['uid'].'OP:'.$user['uid'];
            if(cookie($key)){
                apiReturn(CodeModel::ERROR,'你已发送过了，请耐心等待回复！');
            }
            $message = I('post.message');
            if($message==2){
                $message ='我收到你的讯息，我将会在升级会员套餐後尽快与你联络。';
            }else{
                $message ='请查看我的简介，看看是否有兴趣联络我。如果有兴趣，向我“传情”，我将会主动联络你！';
            }
            $msg['type'] = MessageModel::FRIENDS_MSG;
            $msg['message'] = "[传情讯息]$message";
            $msg['uid'] =  $_REQUEST['uid'];
            $msg['operator'] =  $user['uid'];
            if(MessageModel::addMsg($msg)){
                cookie($key,true,86400*7);
                apiReturn(CodeModel::CORRECT,'发送成功');
            }else{
                apiReturn(CodeModel::ERROR,'发送失败');
            }
        }else{
            $this->display();
        }
    }
















    public function userinfo(){
        $uid = $_REQUEST['uid'];
        if($uid == $this->userid){
            $isself = true;
        }else{
            $isfriend = FriendsModel::isfriend($this->userid,$uid);
        }
        $user = UserModel::getUserById($uid);
        $isself = false;
        $isfriend = false;
        $this->assign('isself',$isself);
        $this->assign('isfriend',$isfriend);
        $this->assign('user',$user);
        $this->assign('headtitle',$user['nickname']);
        $this->display();
    }



    //收藏
    public function favorite(){
        $this->assign('headtitle','我的收藏');
        $this->display();
    }

    //收藏
    public function getFavorite(){
        $con['f.fuid'] = $this->userid;
        $p = I('page',0);
        $offset = 40;
        $star = $p*$offset;
        $list = M('favorite')->alias('f')
            ->join('t_topic as t on t.tid = f.tid')
            ->where($con)->field('t.*,f.fid')->order('f.fid desc')
            ->limit($star,$offset)->where($con)->select();
        foreach($list as &$val){
            if($val['uid']){
                $tuser = UserModel::getUserById($val['uid']);
                $val['avatar'] = $tuser['picture'];
                $val['level'] = $tuser['level'];
                $val['sex'] = $tuser['sex'];
            }
            $val['createtime'] = timeTran($val['createtime']);
        }
        apiReturn(CodeModel::CORRECT,'' ,$list);
    }

    public function delfavorite(){
        $fid = I('post.fid');
        if(false !== FavoriteModel::delfavorite($fid,$this->userid)){
            apiReturn(CodeModel::CORRECT,'删除成功');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败');
        }
    }




//    //我的好友
//    public function friends(){
//        if (IS_POST) {
//
//        }else{
//            $this->assign('headtitle','我的好友');
//            $this->display();
//        }
//    }


    //帖子
    public function utopic(){
        if(!isset( $_REQUEST['uid']) ||  !$_REQUEST['uid'] ){
            $uid = $this->userid;
        }else{
            $uid = $_REQUEST['uid'];
        }
        $topiclist = TopicModel::getTopicByUid($uid);
        $this->assign('topiclist',$topiclist);
        $this->assign('headtitle','我的帖子');
        $this->display();
    }

    public function deltopic(){
        $tid = I('post.tid');
        if(false !== TopicModel::delTopic($tid,$this->userid)){
            apiReturn(CodeModel::CORRECT,'删除成功');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败');
        }
    }

    //消息中心
    public function message(){
        $list = MessageModel::getMsgByUid($this->userid);
        foreach ($list as $val) {
            if($val['type'] != MessageModel::SYSTEM_MSG){
                MessageModel::readMesUp($val['mid']);//更改非系统消息的未读状态
            }
        }
        $this->assign('list',$list);
        $this->assign('headtitle','消息中心');
        $this->display();
    }

    //接受好友请求
    public function addFriends(){
        $uid = I('uid');
        if(regex($uid,'number')){
            if($this->userid == $uid){
                apiReturn(CodeModel::ERROR,'自己不能添加自己为好友！');
            }
            $user = UserModel::getUser();
            $data['uid'] = $this->userid;
            $data['f_uid'] = $uid;
            $data['status'] = FriendsModel::REPLY_TO;
            if(FriendsModel::addFriends($data)){
                //接受好友后发送接受消息给申请人
                $msg['type'] = MessageModel::ADD_FRIENDS_MSG;
                $msg['message'] = "【{$user['nickname']}】申请成为你的好友";
                $msg['uid'] = $uid;
                $msg['operator'] =  $this->userid;
                MessageModel::addMsg($msg);
                apiReturn(CodeModel::CORRECT,'添加成功,待对方同意');
            }else{
                apiReturn(CodeModel::CORRECT,'添加失败');
            }
        }else{
            apiReturn(CodeModel::CORRECT,'添加失败,请刷新重试');
        }
    }
    //接受好友请求
    public function acceptFriends(){
        $operator = I('post.operator');
        if(regex($operator,'number')){
            $user = UserModel::getUser();
            $data['uid'] = $this->userid;
            $data['f_uid'] = $operator;
            $data['status'] = FriendsModel::FRIENDS;
            if(FriendsModel::addFriends($data)){
                //接受好友后发送接受消息给申请人
                $msg['type'] = MessageModel::ACCEPT_FRIENDS_MSG;
                $msg['message'] = "用户【{$user['nickname']}】接受了你的好友请求";
                $msg['uid'] = $operator;
                $msg['operator'] =  $this->userid;
                MessageModel::addMsg($msg);
                apiReturn(CodeModel::CORRECT,'添加成功');
            }else{
                apiReturn(CodeModel::CORRECT,'添加失败');
            }
        }else{
            apiReturn(CodeModel::CORRECT,'添加失败,请刷新重试');
        }
    }


    //消息中心
    public function msginfo(){
        $mid = $_REQUEST['mid'];
        $msg = MessageModel::getMsgByMid($mid);
        MessageModel::readMesUp($mid);//更改非系统消息的未读状态
        $this->assign('msg',$msg);
        $this->assign('headtitle','消息中心');
        $this->display();
    }


    //留言板
    public function guestbook(){
        $this->assign('headtitle','留言板');
        $this->display();
    }

    //留言板
    public function getGuestbook(){
        if(!isset( $_REQUEST['uid']) ||  !$_REQUEST['uid'] ){
            $uid = $this->userid;
        }else{
            $uid = $_REQUEST['uid'];
        }
        if(isset( $_REQUEST['gid']) && $_REQUEST['gid'] ){
            $con['g.gid'] = $_REQUEST['gid'];
        }
        $con['g.uid'] = $uid;
        $p = I('page',0);
        $offset = 40;
        $star = $p*$offset;
        $list = M('guestbook')->alias('g')->join('t_member as m on g.cuid = m.uid')
            ->where($con)->field('g.*,m.nickname,m.uid as userid,m.picture')->order('gid desc')
            ->limit($star,$offset)->where($con)->select();
        foreach($list as &$val){
            $val['createtime'] = timeTran($val['createtime']);
            $val['reply'] = ReplyModel::getReplyByIdType($val['gid'],ReplyModel::GUESBOOK);
        }
        apiReturn(CodeModel::CORRECT,'',$list);

    }

    public function subGuestbook(){
        $type = I('post.type','add');
        if($type == 'add'){ //留言
            $data = D('guestbook')->create();
            if(!regex($data['uid'],'number')){
                apiReturn(CodeModel::ERROR,'留言失败，请刷新重试!');
            }
            if(!$data['message']){
                apiReturn(CodeModel::ERROR,'请填写留言内容！');
            }
            $data['cuid'] = $this->userid;
            if(GuestbookModel::addMsg($data)){
                $user = UserModel::getUser();
                //留言后给主人发送提示消息
                $msg['type'] = MessageModel::ACCEPT_FRIENDS_MSG;
                $msg['message'] = "【{$user['nickname']}】给你留言了!";
                $msg['uid'] =  $data['uid'];
                $msg['operator'] =  $this->userid;
                MessageModel::addMsg($msg);
                apiReturn(CodeModel::CORRECT,'留言成功');
            }else{
                apiReturn(CodeModel::ERROR,'留言失败');
            }
        }else{ //回复
            $data = I('post.');
            if(!$data['uid'] || !$data['tid']){
                apiReturn(CodeModel::ERROR,'回复失败，请刷新重试');
            }
            if(!$data['message']){
                apiReturn(CodeModel::ERROR,'回复内容不能为空！');
            }
            $user = UserModel::getUser();
            $replydata['tid'] = $data['tid'];
            $replydata['uid'] = $this->userid;
            $replydata['nickname'] = $user['nickname'];
            $replydata['message'] = $data['message'];
            $replydata['type'] = ReplyModel::GUESBOOK;
            if(ReplyModel::addReply($replydata)){
                //留言后给主人发送提示消息
                $msg['type'] = MessageModel::GUEST_MSG;
                $msg['message'] = "【{$user['nickname']}】回复了你的留言了!";
                $msg['uid'] =  $data['uid'];
                $msg['operator'] =  $this->userid;
                $msg['tid'] =   $data['tid'];
                MessageModel::addMsg($msg);
                apiReturn(CodeModel::CORRECT,'留言成功');
            }
        }
    }
}