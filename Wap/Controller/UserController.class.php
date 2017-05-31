<?php
namespace Wap\Controller;

use Common\Model\AreaModel;
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
        $msg = MessageModel::getNewMsgNumByUid($this->userid);
        $this->assign('msgrow',$msg);
        $this->assign('headtitle','个人中心');
        $this->display();
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
            $user = UserModel::getUser();
            $this->assign('user',$user);
            $this->assign('headtitle','修改资料');
            $this->display();
        }
    }

    //个人设置
    public function setup(){
        if (IS_POST) {
            $type = I('post.type');
            if($type == 'pwd'){
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
            }
        }
        $this->assign('headtitle','个人设置');
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

    //相册
    public function delimg(){
        $imgid = I('post.imgid');
        if(false !==UserPhotoModel::delPhoto($imgid,$this->userid)){
            apiReturn(CodeModel::CORRECT,'删除成功');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败');
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

    //我的好友
    public function friends(){
        if (IS_POST) {

        }else{
            $this->assign('headtitle','我的好友');
            $this->display();
        }
    }
    //获取我的好友
    public function getFriends(){
        $con['f.uid'] = $this->userid;
        $field = 'f.*,m.nickname,m.picture,m.describe';
        $p = I('page',0);
        $offset = 40;
        $star = $p*$offset;
        $list = D('friends')->alias('f')
            ->join('t_member as m on f.f_uid = m.uid')->field($field)
            ->limit($star,$offset)->where($con)->select();
        foreach($list as &$val){
            if($topic = TopicModel::getTopicByUid($val['t_uid'],TopicModel::TYPE_HUMOR,'one')){
                $val['topic'] = $topic['message'];
            }
        }
        apiReturn(CodeModel::CORRECT,'',$list);

    }

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