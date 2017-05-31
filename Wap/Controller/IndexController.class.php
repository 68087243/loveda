<?php
namespace Wap\Controller;

use Common\Model\AreaModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\FavoriteModel;
use Common\Model\HotWordModel;
use Common\Model\ReplyModel;
use Common\Model\TopicModel;
use Common\Model\UserModel;
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
        $areas =  AreaModel::getAreaAll();
        $priovce = array();
        $city = array();
        foreach ($areas as $area) {
            if ($area["parentid"] == 0 && $area["parentid"] !== null) {
                array_push($priovce, $area);
            }
//            elseif ($area["parentid"] > 0) {
//                array_push($city, $area);
//            }
        }
        $this->assign("proivce", $priovce);
//        $this->assign("city", $city);
        $this->assign("user",UserModel::getUser());
        $club = ClubModel::getClub();
        $this->assign('club',$club);
        $this->display();
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
        $data['list'] = $list;
        $data['count'] = $count;
        apiReturn(CodeModel::CORRECT,'',$data);
    }

    public function topicList(){
        $this->display('topic_list');
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
        $data = I('post.');
        $data['uid'] = $user['uid'];
        $data['nickname'] = $user['nickname'];
        if(!isset($data['cid']) || !$data['cid']){
            apiReturn(CodeModel::ERROR,'请选择分类');
        }
        if(!$data['title']){
            apiReturn(CodeModel::ERROR,'请填写标题');
        }
        if(!$data['message']){
            apiReturn(CodeModel::ERROR,'请填写内容');
        }

        if(false !== $tid = TopicModel::addTopic($data)){
            apiReturn(CodeModel::CORRECT,'发布成功','/index/topicInfo.html?tid='.$tid);
        }else{
            apiReturn(CodeModel::ERROR,'发布失败');
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
            $con['tid'] = $tid;
            if(false!== M('topic')->where($con)->setInc('likeit',1)){
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
            $offset = 40;
            $star = $p * $offset;
            $con['status'] = array('neq',TopicModel::DEL);
            $con['type'] = TopicModel::TYPE_RICHKEPT;
            $list = M('topic')->where($con)->order('rank desc,tid desc')
                ->limit($star, $offset)->select();
            $this->assign('list',$list);
            apiReturn(CodeModel::CORRECT, '', $list);
        }
        $this->assign('headtitle','富豪包养');
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