<?php
namespace Home\Controller;
use Common\Model\AreaModel;
use Common\Model\BannerModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\ContentModel;
use Common\Model\EscortPlanModel;
use Common\Model\FormModel;
use Common\Model\MessageModel;
use Common\Model\ReplyModel;
use Common\Model\TopicModel;
use Common\Model\UserModel;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(isset($_REQUEST['od'])){
            $order =$_REQUEST['od']. ' desc';
        }else{
            $order = 'logintime desc';
        }
        $where['status'] = array('neq',UserModel::NOUSERSTATE);
        $row = 10;
        $count = M ( "member" )->where ( $where )->count();
        $page = new \Think\Page ( $count, $row );
        $userlist = D ( "member" )->where ( $where )->order($order)->limit($page->firstRow,$page->listRows)->select();
        $this->assign ( "userlist", $userlist );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );

        $this->assign ( "nvsheng",TopicModel::getTopicByCid(2));
        $this->assign ( "dashu",TopicModel::getTopicByCid(1));
        $this->assign ( "gongyi",ContentModel::getHotContent(5,ContentModel::PUBLIC_FUNDING));
        $this->assign ( "hotcontent",ContentModel::getHotContent(10));
        $this->assign ( "bannerlist",BannerModel::getBannerByType(BannerModel::PC_BANNER));
        $this->display();
    }

    public function richkept(){
        if (!empty($_REQUEST['feestar']) && empty($_REQUEST['feeend'])) { //如果只有开始
            $where['budgetfee'] = array("egt",$_REQUEST['feestar']);
        }
        if (empty($_REQUEST['feestar']) && !empty($_REQUEST['feeend'])) { //如果只有结束
            $where['budgetfee'] = array("elt",$_REQUEST['feeend']);
        }
        if(!empty($_REQUEST['feestar']) && !empty($_REQUEST['feeend'])){  //如果有开始和结束
            $where['budgetfee'] = array(array("egt",$_REQUEST['feestar']),array("elt",$_REQUEST['feeend']));
        }

        if (!empty($_REQUEST['startime']) && empty($_REQUEST['startime'])) { //如果只有开始时间
            $where['startime'] = array("egt",$_REQUEST['startime']." 00:00:00");
        }
        if (empty($_REQUEST['startime']) && !empty($_REQUEST['startime'])) { //如果只有结束时间
            $where['startime'] = array("elt",$_REQUEST['startime']." 23:59:59");
        }
        if(!empty($_REQUEST['startime']) && !empty($_REQUEST['startime'])){  //如果有开始和结束时间
            $where['startime'] = array(array("egt",$_REQUEST['startime']." 00:00:00"),array("elt",$_REQUEST['startime']." 23:59:59"));
        }

        if(!empty($_REQUEST['keyword'])){
            $where['_string'] = "`title` like '%{$_REQUEST['keyword']}%' or `title` like '%{$_REQUEST['keyword']}%' or `cityname` like '%{$_REQUEST['keyword']}%' or `proivcename` like '%{$_REQUEST['keyword']}%'or `contentcn` like '%{$_REQUEST['keyword']}%'"; // 标题，内容，位置
        }
        $where['status'] = EscortPlanModel::NORMAL;
        $row = 20;
        $order = 'pid desc';
        $count = D( "escortplan" )->where ( $where )->count();
        $page = new \Think\Page ( $count, $row );
        $list = D( "escortplan" )->where ( $where )->
            order($order)->limit($page->firstRow,$page->listRows)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $this->assign ( "content", ContentModel::getHotContent());
        $this->display();
    }

    public function rkinfo(){
        $id = $_REQUEST['id'];
        $con['status'] =TopicModel::NORMAL;
        $con['type'] = TopicModel::TYPE_RICHKEPT;
        $con['tid'] =$id;
        $this->assign ( "info",  D('topic')->where($con)->find());
        $this->assign ( "content", ContentModel::getHotContent());
        $this->display();
    }


    public function newinfo(){
        $info = ContentModel::getContentById($_REQUEST['id']);
        if(!empty($info) && $info['status'] == ContentModel::NORMAL){
            $this->assign ( "info",$info);
        }
        $this->assign ( "content", ContentModel::getHotContent());
        $this->display();
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
        $order = 'pid desc';
        $this->assign ( "list", EscortPlanModel::getPlanBySort($order,10));
        $rcon['r.tid'] = $_REQUEST['pid'];
        $rcon['r.type'] = ReplyModel::PLAN;
        $rcount = M('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
            ->where($rcon)->count();
        $row = 12;
        $page =  new \Think\Page($rcount,$row);
        $reply = M('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
            ->where($rcon)->field('r.*,m.picture')->limit($page->firstRow,$page->listRows)
            ->order ( 'r.pid desc' )->select();
        foreach($reply as &$val){
            if($val['message'] && strpos($val['message'],'@')!==false){
                $arr =  explode(' ',$val['message']);
                $username = mb_substr($arr[0],1);
                $touser = UserModel::getuserByUsername($username);
                $touserlink = "<a href='/user/userinfo.html?uid={$touser['uid']}'>@{$touser['nickname']}&nbsp;</a>";
                $val['message'] = $touserlink.mb_substr($val['message'],(strlen($username)+2));
            }
        }
        $this->assign('reply',$reply);
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $this->display();
    }

    //计划列表
    public function planlist(){
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
        $this->assign ( "content", ContentModel::getHotContent());
        $this->assign('priovce',$priovce);
        $this->assign('city',$city);
        $this->display();
    }

    //生成验证码
    public function verify(){
        verify();
    }

    //发布需求
    public function subform(){
        $tel = I('post.tel');
        $note = I('post.note');
        $type = I('post.type','2','int');
        if(!$note){
            if($type ==1){
                apiReturn(CodeModel::ERROR,'请填写你需要什么！');
            }else{
                apiReturn(CodeModel::ERROR,'请填写你的意见！');
            }
        }
        if(regex($tel,'mob')){
            $user = UserModel::getUser();
            $data['type'] =  $type;
            $data['note'] =  $note;
            $data['addip'] =  getRealIp();
            $data['tel'] =  $tel;
            if($user){
                $data['uid'] =  $user['uid'];
            }
            if(FormModel::addForm($data)){
                apiReturn(CodeModel::CORRECT,'提交成功！');
            }
        }else{
            apiReturn(CodeModel::ERROR,'手机号码格式不正确');
        }
    }
    //帖子列表
    public function topiclist(){
        $keyword = $_REQUEST['keyword'];
        if($keyword){
            $con['_string'] = "t.title like '%{$keyword}%' or t.nickname like '%{$keyword}%' or t.message like '%{$keyword}%' ";
        }

        if(isset($_REQUEST['aid']) && $_REQUEST['aid']){
            $con['_string'] = "m.proivce ={$_REQUEST['aid']} or m.city ={$_REQUEST['aid']}";
        }
        if(isset($_REQUEST['cid']) && $_REQUEST['cid']){
            $con['c.cid'] = $_REQUEST['cid'];
        }
        $con['t.status'] = TopicModel::NORMAL;
        $count = M('topic')->alias('t')
            ->join('t_club as c on t.cid = c.cid')
            ->join('t_member as m on m.uid = t.uid')
            ->where($con)->count();
        $row = 12;
        $page = new \Think\Page ( $count, $row );
        $order = 't.rank desc,t.tid desc';
        $list = M('topic')->alias('t')->join('t_club as c on t.cid = c.cid')
            ->join('t_member as m on m.uid = t.uid')->where($con)
            ->field('t.*,c.clubname,m.picture as avatar,m.level,m.sex,m.city,m.proivce')
            ->limit($page->firstRow,$page->listRows)->order($order)->select();
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
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
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
        $this->assign('club', ClubModel::getClub());
        $this->display();
    }

    public function topic(){
        $tid = $_REQUEST['tid'];
        if($tid){
            $topic = TopicModel::getTopicByTid($_REQUEST['tid']);
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
            $rcon['r.tid'] = $tid;
            $rcon['r.type'] = ReplyModel::TOPIC;
            $rcount = M('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
                ->where($rcon)->count();
            $row = 12;
            $page =  new \Think\Page($rcount,$row);
            $reply = M('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
                ->where($rcon)->field('r.*,m.picture')->limit($page->firstRow,$page->listRows)
                ->order ( 'r.pid desc' )->select();
            foreach($reply as &$val){
                if($val['message'] && strpos($val['message'],'@')!==false){
                    $arr =  explode(' ',$val['message']);
                    $username = mb_substr($arr[0],1);
                    $touser = UserModel::getuserByUsername($username);
                    $touserlink = "<a href='/user/userinfo.html?uid={$touser['uid']}'>@{$touser['nickname']}&nbsp;</a>";
                    $val['message'] = $touserlink.mb_substr($val['message'],(strlen($username)+2));
                }
            }
            $this->assign('reply',$reply);
            $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
            $this->assign ( "page", $page->show() );
        }
        $this->assign ( "content", ContentModel::getHotContent());
        $this->display();
    }

    public function subPlanReply(){
        $data = I('post.');
        $user = UserModel::getUser();
        if(empty($user)){
            apiReturn(CodeModel::ERROR,'请先登录');
        }
        if(!$data['message']){
            apiReturn(CodeModel::ERROR,'回复内容不能为空！');
        }
        $user = UserModel::getUser();
        $replydata['tid'] = $data['pid'];
        $replydata['uid'] = $user['uid'];
        $replydata['nickname'] = $user['nickname'];
        $replydata['message'] = $data['message'];
        $replydata['type'] = ReplyModel::PLAN;
        if(ReplyModel::addReply($replydata)){
            //留言后给主人发送提示消息
            $msg['type'] = MessageModel::GUEST_MSG;
            $msg['message'] = "【{$user['nickname']}】评论了你的伴游计划!";
            $msg['uid'] =  $data['uid'];
            $msg['operator'] =  $user['uid'];
            $msg['tid'] =   $data['tid'];
            MessageModel::addMsg($msg);
            apiReturn(CodeModel::CORRECT,'留言成功');
        }
    }

    public function charitable(){
        $con['status'] = ContentModel::NORMAL;
        $con['type'] = ContentModel::PUBLIC_FUNDING;
        $count = M('content')->where($con)->count();
        $row = 12;
        $page = new \Think\Page ( $count, $row );
        $order = 'rank desc,id desc';
        $list = M('content')->where($con)->limit($page->firstRow,$page->listRows)->order($order)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $this->assign ( "content", ContentModel::getHotContent());
        $this->display();
    }
}