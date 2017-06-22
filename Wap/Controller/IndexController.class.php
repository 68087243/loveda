<?php
namespace Wap\Controller;

use Common\Model\AreaModel;
use Common\Model\BannerModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\EscortPlanModel;
use Common\Model\FavoriteModel;
use Common\Model\FriendsModel;
use Common\Model\HotWordModel;
use Common\Model\MessageModel;
use Common\Model\ReplyModel;
use Common\Model\TopicModel;
use Common\Model\UserModel;
use Common\Model\UserPhotoModel;
use Think\Controller;
use Think\Page;
class IndexController extends Controller {
    private $offset = 10;
    public function islogin(){
        $user = UserModel::getUser();
        if(empty($user)){
            if(!UserModel::cookieLogin(UserModel::WAP)){
                redirect('/login/login');
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    public function index(){
        if(UserModel::getUser()){
            redirect('/index/ulist');
        }else{
            $this->display();
        }
    }

    public function addphoto(){
        $this->display();
    }

    public function ulist(){
        if (!empty($_REQUEST['age-s']) && empty($_REQUEST['age-e'])) { //如果只有开始
            $where['birthdate'] = array("elt",getBirthday($_REQUEST['age-s']));
        }
        if (empty($_REQUEST['age-s']) && !empty($_REQUEST['age-e'])) { //如果只有结束
            $where['birthdate'] = array("egt",getBirthday($_REQUEST['age-e']));
        }
        if(!empty($_REQUEST['age-s']) && !empty($_REQUEST['age-e'])){  //如果有开始和结束
            $where['birthdate'] = array(array("elt",getBirthday($_REQUEST['age-s'])),array("egt",getBirthday($_REQUEST['age-e'])));
        }
        if (!empty($_REQUEST['priovce'])) {
            $where['proivce'] = $_REQUEST['priovce'];
        }
        $user = UserModel::getUser();
        if($user){
            if($user['sex'] ==UserModel::FEMALE){
                $where['sex'] = UserModel::MALE;
            }else{
                $where['sex'] = UserModel::FEMALE;
            }
            $where['_string'] ="`uid` !={$user['uid']}";
        }
        $where['status'] = UserModel::NORMAL_USERS;
        $order = 'recommend desc,rank desc,uid desc';
        $list = D( "member" )->where ( $where )->order($order)->select();
        $this->assign ( "list", $list );
        $areas =  AreaModel::getAreaAll();
        $priovce = array();
        foreach ($areas as $area) {
            if ($area["parentid"] == 0 && $area["parentid"] !== null) { //排除中国和俄罗斯
                array_push($priovce, $area);
            }
        }
        $this->assign('priovce',$priovce);
        $this->display();
    }

    //用户详情
    public function uinfo(){
        $user = UserModel::getUserById($_REQUEST['uid']);
        if($user && $user['hobbyids']){
            $con['_string'] = "hid in({$user['hobbyids']})";
            $habby = D('habby')->where($con)->select();
            $habbys = '';
            foreach($habby as $val){
                if($val){
                    $habbys.=$val['name'].'   ';
                }
            }
            $this->assign('habbys',$habbys);
        }
        if($user && $user['pairingids']){
            $con['_string'] = "hid in({$user['pairingids']})";
            $pairings= D('pairing')->where($con)->select();
            $pairing = '';
            foreach($pairings as $val){
                if($val){
                    $pairing.=$val['name'].'   ';
                }
            }
            $this->assign('pairing',$pairing);
        }

        $currentuser = UserModel::getUser();
        if($currentuser['level'] > UserModel::VISITOR_MEMBER){
            $this->assign('photolist', UserPhotoModel::getUserPhoto($_REQUEST['uid']));
        }
        $this->assign('isfriends', FriendsModel::isfriend($currentuser['uid'],$_REQUEST['uid']));
        $this->assign('user', $user);
        $this->assign('headtitle', $user['nickname']);
        $this->display();
    }

    public function addFrinds(){
        $fuid = I('post.fuid');
        $currentuser = UserModel::getUser();
        if(empty($currentuser)){
            apiReturn(CodeModel::ERROR,'请先登录！');
        }
        if($currentuser['uid'] == $fuid){
            apiReturn(CodeModel::ERROR,'不能添加自己为好友！');
        }
        if(regex($fuid,'number')){
            $isfriend = FriendsModel::isfriend($currentuser['uid'],$fuid);
            if($isfriend ==FriendsModel::REPLY_TO){
                apiReturn(CodeModel::ERROR,'你已申请该会员为好友，请耐心等待回复！');
            }elseif($isfriend ==FriendsModel::FRIENDS){
                apiReturn(CodeModel::ERROR,'你与该会员已经是为好友关系！');
            }
            $adddata['uid'] = $currentuser['uid'];
            $adddata['f_uid'] = $fuid;
            if(FriendsModel::addFriends($adddata)){
                //发送提示消息
                $msg['type'] = MessageModel::ADD_FRIENDS_MSG;
                $msg['message'] = "[{$currentuser['nickname']}]申请成为你的好友！";
                $msg['uid'] = $fuid;
                $msg['operator'] =  $currentuser['uid'];
                apiReturn(CodeModel::CORRECT,'发送成功');

            }else{
                apiReturn(CodeModel::ERROR,'操作失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'操作失败,请刷新重试！');
        }
    }

    public function chat(){
        $currentuser = UserModel::getUser();
        if(IS_POST){
            $data = I('post.');
            $user = UserModel::getUser();
            if(empty($user)){
                apiReturn(CodeModel::ERROR,'请先登录！');
            }
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
            $msg['operator'] =  $currentuser['uid'];
            if(MessageModel::addMsg($msg)){
                apiReturn(CodeModel::CORRECT,'发送成功');
            }else{
                apiReturn(CodeModel::CORRECT,'发送失败');
            }
        }else{
            $tuser = UserModel::getUserById($_REQUEST['uid']);
            $this->assign('headtitle', $tuser['nickname']);
            $this->assign('currentuid',$currentuser['uid']);
            $this->display();
        }
    }

    public function getMoreReply(){
        $currentuser = UserModel::getUser();
        $uid = I('post.uid');
        if(!$uid){
            apiReturn(CodeModel::ERROR,'获取失败,请刷新重试');
        }
        $page = I('post.page');
        $chatlist = MessageModel::getChatMsg($currentuser['uid'],$uid,$page);
        foreach($chatlist as &$val){
            $val['createtime'] = timeTran($val['createtime']);
            //阅读消息
            if($val['isread'] == MessageModel::NOREAD){
                MessageModel::readMesUp($val['mid']);
            }
        }
        apiReturn(CodeModel::CORRECT,'',$chatlist);
    }

    public function news(){
        $user = UserModel::getUser();
        if(empty($user)){
            session('to','/index/news.hmtl');
            redirect('/login/login');
        }

        $user = UserModel::getUser();
        if(empty($user)){
            apiReturn(CodeModel::ERROR,'请先登录');
        }
        if(isset($_REQUEST['type']) && $_REQUEST['type']){
            $con['type'] =$_REQUEST['type'];
        }
        $con['_string'] = '(`uid` ='.$user['uid'].') or (`operator`) =0';
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

    public function getNewsInfo(){
        $user = UserModel::getUser();
        if(empty($user)){
            apiReturn(CodeModel::ERROR,'请先登录');
        }
        if($_REQUEST['type'] ==2){
            $con['_string'] = '(`uid` ='.$user['uid'].') or (`operator`) =0';
            $con['type'] = MessageModel::TOPIC_MSG;
        }elseif($_REQUEST['type'] ==3){
            $con['type'] = MessageModel::SYSTEM_MSG;
        }else{
            $con['_string'] = "`uid` ={$user['uid']} and type in(2,3,4)";
        }
        $order = '`isread` desc,`createtime` desc';
        $row = 10;
        $page = I('post.page',0,'int');
        $list = D( "message" )->where ( $con )->order($order)
            ->limit($page*$row,$row)->select();
        foreach($list as &$val){
            if($val['operator']>0){
                $operatoruser = UserModel::getUserById($val['operator']);
                $val['nickname'] =  $operatoruser['nickname'] ;
                $val['picture'] =  $operatoruser['picture'] ;
                $val['userid'] =  $operatoruser['uid'] ;
            }
            $val['createtime'] = timeTran($val['createtime']);
        }
        apiReturn(CodeModel::CORRECT,'',$list);
    }

    public function delNews(){
        $mid = I('post.mid',0,'int');
        if($mid>0){
            if(false!=MessageModel::delNews($mid)){
                apiReturn(CodeModel::CORRECT,'删除成功');
            }else{
                apiReturn(CodeModel::ERROR,'删除失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'删除失败,请刷新重试');
        }
    }

    public function topic(){
        $keyword = $_REQUEST['keyword'];
        if($keyword){
            $con['_string'] = "t.title like '%{$keyword}%' or t.message like '%{$keyword}%' ";
        }
        if(isset($_REQUEST['aid']) && $_REQUEST['aid']){
            $con['_string'] = "m.proivce ={$_REQUEST['aid']} or m.city ={$_REQUEST['aid']}";
        }
        if(isset($_REQUEST['cid']) && $_REQUEST['cid']){
            $con['c.cid'] = $_REQUEST['cid'];
        }
        $con['t.status'] =  TopicModel::NORMAL;
        $count = M('topic')->alias('t')
            ->join('t_club as c on t.cid = c.cid')
            ->join('t_member as m on m.uid = t.uid')
            ->where($con)->count();
        $page = I('post.page',0);
        $star = $page*$this->offset;
        $list = M('topic')->alias('t')->join('t_club as c on t.cid = c.cid')
            ->join('t_member as m on m.uid = t.uid')->where($con)
            ->field('t.*,c.clubname,m.picture as avatar,m.level,m.sex')
            ->limit($star,$this->offset)->select();
        foreach($list as &$val){
            if($val['picture']){
                if(strpos($val['picture'],'|')!==false){
                    $val['img'] = explode('|',$val['picture']);
                }else{
                    $val['img'][0] = explode('|',$val['picture']);
                }
            }
        }
        $this->assign ( "list", $list );

        $this->display();
    }

    //获取帖子
    public function getinfolist(){
        $keyword = $_REQUEST['keyword'];
        if($keyword){
            $con['_string'] = "t.title like '%{$keyword}%' or t.message like '%{$keyword}%' ";
        }
        if(isset($_REQUEST['aid']) && $_REQUEST['aid']){
            $con['_string'] = "m.proivce ={$_REQUEST['aid']} or m.city ={$_REQUEST['aid']}";
        }
        if(isset($_REQUEST['cid']) && $_REQUEST['cid']){
            $con['c.cid'] = $_REQUEST['cid'];
        }
        $con['t.status'] =  TopicModel::NORMAL;
        $page = I('post.page',0);
        $star = $page*$this->offset;
        $list = M('topic')->alias('t')->join('t_club as c on t.cid = c.cid')
            ->join('t_member as m on m.uid = t.uid')->where($con)
            ->field('t.*,c.clubname,m.picture as avatar,m.level,m.sex')
            ->limit($star,$this->offset)->select();
        foreach($list as &$val){
            $val['message'] = htmlspecialchars_decode($val['message'] );
            if($val['picture']){
                if(strpos($val['picture'],'|')!==false){
                    $val['img'] = explode('|',$val['picture']);
                }else{
                    $val['img'][0] = explode('|',$val['picture']);
                }
            }
        }
        apiReturn(CodeModel::CORRECT,'',$list);
    }

    //获取悬赏任务    ·
    public function getrkInfo(){
        $where['status'] = EscortPlanModel::NORMAL;
        $row = 20;
        $order = 'pid desc';
        $page = I('post.page',0);
        $list = D( "escortplan" )->where ( $where )->order($order)->limit($page*$row,$row)->select();
        foreach($list as &$val){
            $val['createtime'] = timeTran($val['createtime']);
            $val['contentcn'] = htmlspecialchars_decode($val['contentcn']);
        }
        apiReturn(CodeModel::CORRECT,'',$list);
    }


    public function topicInfo(){
        $tid =$_REQUEST['tid'];
        if(regex($tid,'number')){
            $topic = TopicModel::getTopicByTid($tid);
            $data['read'] =intval($topic['read'])+1;
            TopicModel::modifyTopic($tid,$data);
            $isself = false;
            if($topic['uid']>0){
                $tuser = UserModel::getUserById($topic['uid']);
                $topic['sex'] = $tuser['sex'];
                $user = UserModel::getUser();
                if($user){
                    $this->assign('currentuid',$user['uid']);
                    if($user['uid'] ==$topic['uid'] ){
                        $isself = true;
                    }
                }
            }
            $this->assign('isself',$isself);
            if($topic['picture']){
                if(strpos($topic['picture'],'|')!==false){
                    $topic['img'] = explode('|',$topic['picture']);
                }else{
                    $topic['img'][] = $topic['picture'];
                }
                $topic['img'] = array_filter($topic['img']);
            }
            $this->assign('topic',$topic);
        }
        $this->display('topic_info');
    }

    //获取评论
    public function getReplyByTid(){
        $tid = I('post.tid',2);
        $con['r.tid'] = $tid;
        $rcon['r.type'] = ReplyModel::TOPIC;
        $count = M('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
            ->where($con)->count();
        $page =  new Page($count,$this->offset);
        $list = M('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
            ->where($con)->field('r.*,m.picture')->limit($page->firstRow.",".$page->listRows)
            ->order ( 'r.pid asc' )->select();
        foreach($list as &$val){
            if($val['message'] && strpos($val['message'],'@')!==false){
                $arr =  explode(' ',$val['message']);
                $username = mb_substr($arr[0],1);
                $touser = UserModel::getuserByUsername($username);
                $touserlink = "<a href='/user/userinfo.html?uid={$touser['uid']}'>@{$touser['nickname']}&nbsp;</a>";
                $val['message'] = $touserlink.mb_substr($val['message'],(strlen($username)+2));
            }
        }
        apiReturn(CodeModel::CORRECT,'',$list);
    }









    public function search(){
        if(isset($_REQUEST['type'])&&$_REQUEST['type']){
            $gotword = HotWordModel::getHotWordByType($_REQUEST['type']);
        }else{
            $gotword = HotWordModel::getHotWordByType();
        }
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
        $this->assign('gotword',$gotword);
        $this->display();
    }

    public function rlist(){
        $con['_string'] = '`status` = 1';
        $count = M('topic')->where($con)->count();
        $page =  new Page($count,$this->offset);
        $list = M('topic')->where($con)->limit($page->firstRow.",".$page->listRows)
            ->order ( '`read` desc' )->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function infolist(){
        if(isset($_REQUEST['type'])){
            if($_REQUEST['type'] == 2){
                $this->assign('headtitle','搜索会员');
            }else{
                $this->assign('headtitle','搜索帖子');
            }
        }elseif(isset($_REQUEST['aid']) && $_REQUEST['aid']){
            $area = AreaModel::getAreaByid($_REQUEST['aid']);
            $this->assign('headtitle',$area['name']);
        }elseif(isset($_REQUEST['cid']) && $_REQUEST['cid']){
            $club = ClubModel::getClubById($_REQUEST['cid']);
            $this->assign('headtitle',$club['clubname']);
        }else{
            $this->assign('headtitle','全部帖子');
        }
        $this->display();
    }

    public function getUserinfolist(){
        if (!empty($_REQUEST['height_s']) && empty($_REQUEST['height_e'])) {
            $where['height'] = array("egt",$_REQUEST['height_s']);
        }
        if (empty($_REQUEST['height_s']) && !empty($_REQUEST['height_e'])) {
            $where['height'] = array("elt",$_REQUEST['height_e']);
        }
        if(!empty($_REQUEST['height_s']) && !empty($_REQUEST['height_e'])){
            $where['height'] = array(array("egt",$_REQUEST['height_s']),array("elt",$_REQUEST['height_e']));
        }

        if (!empty($_REQUEST['age_s']) && empty($_REQUEST['age_e'])) { //如果只有开始时间
            $where['age'] = array("egt",$_REQUEST['age_s']."年1月");
        }

        if (empty($_REQUEST['age_s']) && !empty($_REQUEST['age_e'])) { //如果只有结束时间
            $where['age'] = array("elt",$_REQUEST['age_e']."年12月");
        }
        if(!empty($_REQUEST['age_s']) && !empty($_REQUEST['age_e'])){  //如果有开始和结束时间
            $where['age'] = array(array("egt",$_REQUEST['age_s']."年1月"),array("elt",$_REQUEST['age_e']."年12月"));
        }

        if($_REQUEST['proivce']){
            $where['proivce'] = $_REQUEST['proivce'];
        }
        if($_REQUEST['city']){
            $where['city'] = $_REQUEST['city'];
        }
        if($_REQUEST['marriage']){
            $where['marriage'] = $_REQUEST['marriage'];
        }
        if($_REQUEST['income']){
            $where['income'] = $_REQUEST['income'];
        }
        $page = I('post.page',0);
        $field = 'uid,nickname,tel,sex,picture,proivce,city,level,income,marriage,weight,age';
        $count = M('member')->where($where)->count();
        $star = $page*$this->offset;
        $list = M('member')->where($where)->field($field)
            ->limit($star,$this->offset)->select();
        apiReturn(CodeModel::CORRECT,'',array('list'=>$list,'count'=>$count));

    }

    //计划详情
    public function plan(){
        $plan =  EscortPlanModel::getPlanById($_REQUEST['pid']);
        if($plan &&$plan['uid']){
            $puser = UserModel::getUserById($plan['uid']);
            $plan['level'] = $puser['level'];
            $plan['nickname'] = $puser['nickname'];
            $plan['sex'] = $puser['sex'];
            $plan['avatar'] = $puser['picture'];
        }
        $this->assign ( "plan", $plan);
        $this->display();
    }



    public function topicList(){
        $this->display('topic_list');
    }

    public function postTopic(){
        //未登录的先登录
        $this->islogin();
        $club = ClubModel::getClub();
        $this->assign('club',$club);
        $this->display('post_topic');
    }

    //发帖
    public function  subTopic(){
        $user = UserModel::getUser();
        if(empty($user)){
            apiReturn(CodeModel::ERROR,'请先登录');
        }
        $data = I('post.');
        $data['uid'] = $user['uid'];
        $data['nickname'] = $user['nickname'];
        if($data['type'] ==1 && (!isset($data['cid']) || !$data['cid'])){
            apiReturn(CodeModel::ERROR,'请选择分类');
        }
        if(!$data['title']){
            apiReturn(CodeModel::ERROR,'请填写标题');
        }
        if(!$data['message']){
            apiReturn(CodeModel::ERROR,'请填写内容');
        }
        if($data['type'] == 1){
            $tid = TopicModel::addTopic($data);
            $url = '/index/topicInfo.html?tid='.$tid;
        }else{
            $data['contentcn'] = $data['message'];
            $data = M('escortplan')->create($data);
            $tid = EscortPlanModel::addPlan($data);
            $url = '/index/plan.html?pid='.$tid;
        }
        if(false !== $tid){
            apiReturn(CodeModel::CORRECT,'发布成功,请耐心等待管理员审核',$url);
        }else{
            apiReturn(CodeModel::ERROR,'发布失败，请刷新重试或联系客服');
        }
    }

    //提交评论
    public function subReply(){
        $user = UserModel::getUser();
        if(empty($user)){
            apiReturn(CodeModel::ERROR,'请先登录');
        }
        $data = I('post.');
        if(!isset($data['tid']) || !$data['tid']){
            apiReturn(CodeModel::ERROR,'回复失败，请刷新重试！');
        }

        if(!isset($data['message']) || !$data['message']){
            apiReturn(CodeModel::ERROR,'请填写评论内容！');
        }

        if(strpos($data['message'],$data['touser'])>0){
            if(strlen($data['message']) == strlen($data['touser'])+2){
                apiReturn(CodeModel::ERROR,'请填写评论内容！');
            }
        }
        if(strpos($data['message'],$data['touser'])>0 && $data['touser'] == $user['nickname']){
            apiReturn(CodeModel::ERROR,'您不能 @自己！');
        }
        $data['uid'] = $user['uid'];
        $data['nickname'] = $user['nickname'];
        TopicModel::checkIfCanReply($data["tid"]);
          //UserModel::checkMemberIfCanReply();
        unset($data['touser']);
        M()->startTrans();
        if(ReplyModel::addReply($data)){
            $con['tid'] = $data["tid"];
            if(false!== M('topic')->where($con)->setInc('comments',1)){
                M()->commit();
            }else{
                M()->rollback();
            }
            apiReturn(CodeModel::CORRECT);
        }else{
            apiReturn(CodeModel::ERROR,'评论失败');
        }
    }

    //点赞
    public function likeTopic(){
        $tid = I('post.tid');
        if(regex($tid,'number')){
            $user = UserModel::getUser();
            $key = 'TOPIC:TID:'.$tid.'UID:'.$user['uid'];
            if(cookie($key)){
                apiReturn(CodeModel::ERROR,'你今天已赞过了，请明天再来');
            }
            if(empty($user)){
                apiReturn(CodeModel::ERROR,'请先登录');
            }
            $con['tid'] = $tid;
            if(false!== M('topic')->where($con)->setInc('likeit',1)){
                cookie($key,true,86400);
                apiReturn(CodeModel::CORRECT);
            }else{
                apiReturn(CodeModel::ERROR,'点赞失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'点赞失败，请刷新重试');
        }
    }

    //收藏
    public function favorite(){
        $tid = $_REQUEST['tid'];
        $user = UserModel::getUser();
        if(empty($user)){
            apiReturn(CodeModel::ERROR,'请先登录');
        }
        if(regex($tid,'number')){
            if(!$topic = TopicModel::getTopicByTid($tid)){
                apiReturn(CodeModel::ERROR,'该帖子已被删除');
            }
            if($favorite = FavoriteModel::getFavoriteByUidAndTid($tid,$user['uid'])){
                apiReturn(CodeModel::ERROR,'已收藏');
            }
            $addFave['fuid'] = $user['uid'];
            $addFave['uid'] = $topic['uid'];
            $addFave['tid'] = $topic['tid'];
            if(FavoriteModel::addFavorite($addFave)){
                apiReturn(CodeModel::CORRECT);
            }else{
                apiReturn(CodeModel::ERROR,'收藏失败');
            }
        }else{
            apiReturn(CodeModel::ERROR,'收藏失败，请刷新重试');
        }
    }

    //富豪包养
    public function richkept(){
        if (IS_POST) {
            $p = I('page', 0);
            $where['status'] = EscortPlanModel::NORMAL;
            $row = 20;
            $order = 'rank desc,pid desc';
            $star = $p * $row;
            $list = D( "escortplan" )->where ( $where )->order($order)->limit($star,$row)->select();
            $this->assign ( "list", $list );
            apiReturn(CodeModel::CORRECT, '', $list);
        }
        $this->assign('headtitle','悬赏');
        $this->display('richkept');
    }

    //ajax获取城市
    public function getArea(){
        $aid = I('post.pid');
        if(regex($aid,'number')){
            if($area = AreaModel::getAreaChildById($aid)){
                apiReturn(CodeModel::CORRECT,'',$area);
            }else{
                apiReturn(CodeModel::ERROR);
            }
        }else{
            apiReturn(CodeModel::ERROR);
        }
    }

}