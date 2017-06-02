<?php

namespace Home\Controller;


use Common\Model\AreaModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\EscortPlanModel;
use Common\Model\TopicModel;
use Common\Model\UserModel;
use Common\Model\UserPhotoModel;
Use \Think\Controller;

class MemberController extends BaseController {

	public function index() {
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
        $this->display();
	}

    public function modifyuser(){
        $uid = $this->userid;   dump($uid);
        $data = D('member')->create();
        $data=array_filter($data);
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

    public function uploadPhoto(){
        $type = I('post.type');
        $data = M('member_photo')->create();
        if($type ==UserPhotoModel::AVATAR_TYPE){ //头像
            $con['uid'] =$this->userid;
            $con['type'] =$type;
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
    //伴游计划
    public function escortplan(){
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
                apiReturn(CodeModel::CORRECT,'发布成功');
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