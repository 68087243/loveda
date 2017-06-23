<?php

namespace Home\Controller;


use Common\Model\AreaModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\EscortPlanModel;
use Common\Model\FriendsModel;
use Common\Model\HabbyModel;
use Common\Model\MessageModel;
use Common\Model\TopicModel;
use Common\Model\UserModel;
use Common\Model\UserPhotoModel;
Use \Think\Controller;

class MemberController extends BaseController {


    public function _initialize(){
        parent::_initialize();
        $friendslist = FriendsModel::getFriendsByuid($this->userid);
        $this->assign('friendslist',$friendslist);
        $this->assign('friendcount',count($friendslist));
        $this->assign('newscount',MessageModel::getNewMsgNumByUid($this->userid));
    }

	public function index() {
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
        $this->display();
	}


    public function modifyuser(){
        $uid = $this->userid;
        $data = D('member')->create();
        $user = UserModel::getUser();
        if(isset($data['tel']) && $user['tel'] !=$data['tel']){
            if(!regex($data['tel'],'mob')){
                apiReturn(CodeModel::ERROR,'电话格式错误');
            }
            if(UserModel::isExistTel($data['tel'])){
                apiReturn(CodeModel::ERROR,'该电话号码已存在');
            }
        }
        if(isset($data['nickname']) && $user['nickname'] !=$data['nickname']){
            if(UserModel::isExistNickname($data['nickname'])){
                apiReturn(CodeModel::ERROR,'昵称已存在');
            }
        }
        if(isset($data['email']) && $user['email'] !=$data['email']){
            if(!regex($data['email'],'email')){
                apiReturn(CodeModel::ERROR,'邮箱格式错误');
            }
            if(UserModel::isExistEmail($data['email'])){
                apiReturn(CodeModel::ERROR,'邮箱已存在');
            }
        }
        if($data['password']){
            if(strlen($data['password'])<5 ){
                apiReturn(CodeModel::ERROR,'新密码最少5位数');
            }
            if($data['password'] !=$data['confirm_pw']){
                apiReturn(CodeModel::ERROR,'新密码两次输入不一致');
            }
            $data['password'] = md5($data['password']);
        }
        $data=array_filter($data);
        if($data){
            if((isset($data['proivce']) && $data['proivce']) && (!isset($data['city']) || !$data['city'])){ //只设置了省，没有选择城市
                $data['city'] = 0; //去除以前的城市
            }
            if(false!== UserModel::modifyMember($uid,$data,UserModel::WEB)){
                apiReturn(CodeModel::CORRECT,'修改成功');
            }else{
                apiReturn(CodeModel::ERROR,'修改失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'修改失败，请刷新重试');
        }
    }

    public function hobby(){
        if(IS_POST){
            $data = I('post.');;
            $data=array_filter($data);
            $savedata['hobbyids'] = substr($data['hobbyids'],0,-1);
            $savedata['hobby_note'] = $data['hobby_note'];
            if(false !== UserModel::modifyMember($this->userid,$savedata)) {
                apiReturn(CodeModel::CORRECT,'更新成功');
            }else{
                apiReturn(CodeModel::ERROR,'更新失败');
            }
        }else{
            $user = UserModel::getUser();
            $this->assign('hobbyids', explode(',',$user['hobbyids']));
            $this->assign('list', HabbyModel::getHabby());
            $this->display();
        }
    }

    public function pairing(){
        if(IS_POST){
            $data = I('post.');;
            $data=array_filter($data);
            $savedata['pairingids'] = substr($data['pairingids'],0,-1);
            $savedata['pairing_note'] = $data['pairing_note'];
            if(false !== UserModel::modifyMember($this->userid,$savedata)) {
                apiReturn(CodeModel::CORRECT,'更新成功');
            }else{
                apiReturn(CodeModel::ERROR,'更新失败');
            }
        }else{
            $user = UserModel::getUser();
            $this->assign('pairingids', explode(',',$user['pairingids']));
            $this->assign('list', HabbyModel::getPairing());
            $this->display();
        }
    }

    public function photos(){
        $photolist = UserPhotoModel::getUserPhoto($this->userid);
        $con['uid'] =$this->userid;
        $con['type'] =UserPhotoModel::AVATAR_TYPE;
        $con['status'] = UserPhotoModel::IN_AUDIT;
        $inauditAvatar =   UserPhotoModel::getUserPhotoByCon($con,UserPhotoModel::AVATAR_TYPE);
        $this->assign('photolist',$photolist);//相册
        $this->assign('inauditAvatar',$inauditAvatar);//审核中的头像
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

    public function delPhoto(){
        $imgid = I('post.imgid');
        if(false !==UserPhotoModel::delPhoto($imgid,$this->userid)){
            apiReturn(CodeModel::CORRECT,'删除成功');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败');
        }
    }

    public function friends(){
        $this->assign('friended',FriendsModel::getAddMeFriend($this->userid));
        $this->display();
    }

    public function chat(){
        if(IS_POST){
            $data = I('post.');
            $user = UserModel::getUser();
            //男生并且是普通会员的没有聊天权限
            //普通会员的没有聊天权限
            if( $user['level'] == UserModel::VISITOR_MEMBER){
                if($user['sex'] == UserModel::MALE){ //男生并且是普通会员的没有聊天权限
                    apiReturn(CodeModel::ERROR,'为了保证交友质量，请你升级你的会员等级才能正常聊天！');
                }else{//女生并且是普通会员的每天只能发送10条聊天消息
                    $key = 'CHAT:NV:UID:'.$user['uid'];
                    $count = cookie($key);
                    if(!$count){
                        cookie($key,0,getLTime());
                    }elseif($count<11){
                        $count++;
                        cookie($key,$count,getLTime());
                    }else{
                        apiReturn(CodeModel::ERROR,'您当前的会员等级每天只能发送10条消息！请联系客服升级你的会员等级');
                    }
                }
            }
            //接受好友后发送接受消息给申请人
            $msg['type'] = MessageModel::FRIENDS_MSG;
            $msg['message'] =$data['message'];
            $msg['uid'] =$data['uid'];
            $msg['operator'] =  $this->userid;
            if(MessageModel::addMsg($msg)){
                apiReturn(CodeModel::CORRECT,'发送成功');
            }else{
                apiReturn(CodeModel::CORRECT,'发送失败');
            }
        }else{
            $this->assign('user',UserModel::getUserById($_REQUEST['uid']));

            $chatlist = MessageModel::getChatMsg($this->userid,$_REQUEST['uid']);
            foreach($chatlist as $val){
                //阅读消息
                if($val['isread'] == MessageModel::NOREAD){
                    MessageModel::readMesUp($val['mid']);
                }
            }
            $this->assign('chatlist',MessageModel::getChatMsg($this->userid,$_REQUEST['uid']));

            $this->display();
        }
    }

    public function news(){
        if(isset($_REQUEST['type']) && $_REQUEST['type']){
            $con['type'] =$_REQUEST['type'];
        }
        $con['_string'] = '(`uid` ='.$this->userid.') or (`operator`) =0';
        $order = '`isread` desc,`createtime` desc';
        $row = 20;
        $count = D( "message" )->where($con)->count();
        $page = new \Think\Page ( $count, $row );
        $list = D( "message" )->where ( $con )->order($order)
            ->limit($page->firstRow,$page->listRows)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $this->display();
    }

    public function acceptFriends(){
        $fuid = I('post.fuid');
        if(regex($fuid,'number')){
            $adddata['uid'] = $this->userid;
            $adddata['fuid'] = $fuid;
            $adddata['status'] = FriendsModel::FRIENDS;
            if(FriendsModel::addFriends($adddata)){
                $user = UserModel::getUser();
                //给声请人发送接受好友提示消息
                $msg['type'] = MessageModel::ACCEPT_FRIENDS_MSG;
                $msg['message'] = "[{$user['nickname']}]接受了你的好友请求!";
                $msg['uid'] = $fuid;
                $msg['operator'] =  $this->userid;
                MessageModel::addMsg($msg);
                apiReturn(CodeModel::CORRECT,'添加好友成功！');
            }else{
                apiReturn(CodeModel::ERROR,'添加好友失败！');
            }
        }else{
            apiReturn(CodeModel::ERROR,'添加好友失败，请刷新重试！');
        }
    }

    public function delFriend(){
        $fuid = I('post.fuid');
        if(FriendsModel::delFriend($this->userid,$fuid)){
            apiReturn(CodeModel::CORRECT,'删除成功!');
        }else{
            apiReturn(CodeModel::ERROR,'删除失败!');
        }
    }

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


    //伴游计划
    public function escortplan(){
        if(isset($_REQUEST['u']) && $_REQUEST['u'] =='mplan'){
            $where['status'] = EscortPlanModel::NORMAL;
            $where['uid'] =$this->userid;
            $row = 20;
            $order = 'pid desc';
            $count = D( "escortplan" )->where ( $where )->count();
            $page = new \Think\Page ( $count, $row );
            $list = D( "escortplan" )->where ( $where )->
            order($order)->limit($page->firstRow,$page->listRows)->select();
            $this->assign ( "list", $list );
            $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
            $this->assign ( "page", $page->show() );
        }elseif(isset($_REQUEST['pid']) && $_REQUEST['pid']){
            $plan = EscortPlanModel::getPlanById($_REQUEST['pid']);
            $this->assign ( "plan", $plan );
        }



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
        $this->display();
    }

    public function subPlan(){
        $data = M('escortplan')->create();
        if($data){
            if(!isset($data['title']) || !$data['title']){
                apiReturn(CodeModel::ERROR,'请填写标题!');
            }
            if(!isset($data['addr']) || !$data['addr']){
                apiReturn(CodeModel::ERROR,'请填写目的地!');
            }
            if(!isset($data['startime']) || !$data['startime']){
                apiReturn(CodeModel::ERROR,'请选择出发日期!');
            }
            if(!isset($data['duration']) || !$data['duration']){
                apiReturn(CodeModel::ERROR,'请选择时长!');
            }
            if(!isset($data['payway']) || !$data['payway']){
                apiReturn(CodeModel::ERROR,'请选择支付方式!');
            }
            if(!isset($data['earnestfee']) || !$data['earnestfee']){
                apiReturn(CodeModel::ERROR,'请填写诚意金!');
            }
            if(!isset($data['budgetfee']) || !$data['budgetfee']){
                apiReturn(CodeModel::ERROR,'请填写费用预算!');
            }
            if(!isset($data['contentcn']) || !$data['contentcn']){
                apiReturn(CodeModel::ERROR,'请填写计划说明!');
            }
            $data['uid'] = $this->userid;
            if($pid = EscortPlanModel::addPlan($data)){
                apiReturn(CodeModel::CORRECT,'发布成功','/index/plan.hmtl?pid='.$pid);
            }else{
                apiReturn(CodeModel::ERROR,'发布失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'发布失败，请刷新重试');
        }
    }

    public function topic(){
        if(isset($_REQUEST['tid']) && $_REQUEST['tid']){
            $this->assign('topic',TopicModel::getTopicByid($_REQUEST['tid']));
        }
        $this->assign('userid',$this->userid);
        $this->assign('club',ClubModel::getClub());
        $this->display();
    }

    public function subPost(){
        $cid = I('post.cid');
        $title = I('post.title');
        $message = I('post.message');
        if(!regex($cid,'number')){
            apiReturn(CodeModel::ERROR,'请选择分类');
        }
        if(!$title){
            apiReturn(CodeModel::ERROR,'请填写标题');
        }
        if(!$message){
            apiReturn(CodeModel::ERROR,'请填写内容');
        }
        $tid = I('post.tid');
        $data = I('post.');
        if(regex($tid,'number')){
            $topic = TopicModel::getTopicByid($_REQUEST['tid']);
            if($topic['uid'] != $this->userid){
                apiReturn(CodeModel::ERROR,'该帖子不是你的，你无权修改');
            }
            if(false !== TopicModel::modifyTopic($tid,$data)){
                apiReturn(CodeModel::CORRECT,'修改成功');
            }else{
                apiReturn(CodeModel::ERROR,'修改失败');
            }
        }else{
            $user = UserModel::getUser();
            $data['uid'] = $this->userid;
            $data['nickname'] = $user['nickname'];
            if(TopicModel::addTopic($data)){
                apiReturn(CodeModel::CORRECT,'提交成功，请耐心等待审核');
            }else{
                apiReturn(CodeModel::ERROR,'发布失败');
            }
        }
    }


    public function deltopic(){
        $tid = I('post.tid');
        if(regex($tid,'number')){
            if(false !== TopicModel::delTopic($tid,$this->userid)){
                apiReturn(CodeModel::CORRECT,'删除成功');
            }else{
                apiReturn(CodeModel::ERROR,'删除失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'删除失败，请刷新重试');
        }
    }
}
?>