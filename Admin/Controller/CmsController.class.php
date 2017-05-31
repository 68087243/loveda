<?php

namespace Admin\Controller;

use Common\Model\AreaModel;
use Common\Model\BannerModel;
use Common\Model\ClubModel;
use Common\Model\CodeModel;
use Common\Model\ContentModel;
use Common\Model\HotWordModel;
use Common\Model\TopicModel;
use Common\Model\UserPhotoModel;

class CmsController extends BaseController {
	public function index() {
	}

	/**
	 * 内容管理
	 */
	public function content() {
        if (!empty($_REQUEST['keyword'])) {
            if (is_number ($_REQUEST['keyword'] )) {
                $where ['id'] = $_REQUEST['keyword'];
            }else{
                $where['_string'] = "`title` like '%{$_REQUEST['keyword']}%' or `content` like '%{$_REQUEST['keyword']}%'";
            }
        }
        if (!empty($_REQUEST['type'])) {
            $where ['type'] = $_REQUEST['type'];
        }
        if (is_number($_REQUEST['status'])) {
            $where ['status'] = $_REQUEST['status'];
        }
        $order ='rank desc ,id desc';
        $count = M ( "content" )->where ( $where )->count();
        $row = 20;
        $page = new \Think\Page ( $count, $row );
        $list = M ( "content" )->where ( $where )->limit($page->firstRow,$page->listRows)->order($order)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
		$this->display();
	}

    public function modifyContent(){
        if(IS_POST){
            $data = M('content')->create();
            $id = I('post.id',0,'int');
            if($data){
                if($id>0){
                    if(false !== ContentModel::modifyContent($id,$data)){
                        apiReturn(CodeModel::CORRECT,'修改成功');
                    }else{
                        apiReturn(CodeModel::ERROR,'修改失败');
                    }
                }else{
                    if(ContentModel::addContent($data)){
                        apiReturn(CodeModel::CORRECT,'添加成功');
                    }else{
                        apiReturn(CodeModel::ERROR,'添加失败');
                    }
                }
            }else{
                apiReturn(CodeModel::ERROR,'添加失败,请刷新重试');
            }
        }else{
            if( isset($_REQUEST['id']) && $_REQUEST['id']){
                $info = ContentModel::getContentById( $_REQUEST['id']);
                $this->assign ( "info", $info);
            }

            $this->display();
        }
    }

    public function delContent(){
        ContentModel::delContent( $_REQUEST['id']);
        redirect ( '/admin/cms/content' );
    }

    public function banner(){
        $banner = BannerModel::getBanner();
        $this->assign ( "banner", $banner );
        $this->display ();
    }

    public function modifyBanner(){
        $id = I('post.id');
        $data =$_POST;// 去除空值
        if(!empty($data)){
            if(regex($id,'number') ){
                if(BannerModel::modifyBanner($id,$data)){
                    apiReturn(CodeModel::CORRECT,'编辑成功');
                }else{
                    apiReturn(CodeModel::ERROR,'编辑失败'.M()->_sql());
                }
            }elseif($data['indexpic']){
                if(BannerModel::addBanner($data)){
                    apiReturn(CodeModel::CORRECT,'添加成功');
                }else{
                    apiReturn(CodeModel::ERROR,'添加失败');
                }
            }
        }else{
            apiReturn(CodeModel::ERROR,'操作失败，请刷新重试');
        }
    }

    public function setBanner(){
        $field = I('post.field');
        if(!empty($field)){
            $id = I('post.id');
            if(regex($id,'number') ){
                $data = array();
                $data[$field] = I('post.val');
                if(BannerModel::modifyBanner($id,$data)){
                    apiReturn(CodeModel::CORRECT,'操作成功');
                }else{
                    apiReturn(CodeModel::ERROR,'操作失败');
                }
            }
        }else{
            apiReturn(CodeModel::ERROR,'操作失败，请刷新重试');
        }
    }

    public function delBanner(){
        $id = I('post.id');
        if(regex($id,'number')){
            if(BannerModel::delBanner($id)){
                apiReturn(CodeModel::CORRECT,'删除成功');
            }
        }
        apiReturn(CodeModel::CORRECT,'删除失败');
    }

    public function hotword(){
        $this->assign ( "list",  HotWordModel::getAll());
        $this->display ();
    }

    public function modifyHot(){
        $id = I('post.id',0,'int');
        $data = $_POST;
        if($id >0){
            if(false !== HotWordModel::modifyHot($id,$data)){
                apiReturn(CodeModel::CORRECT,'修改成功');
            }else{
                apiReturn(CodeModel::ERROR,'修改失败');
            }
        }else{
            if(HotWordModel::addHot($data)){
                apiReturn(CodeModel::CORRECT,'添加成功');
            }else{
                apiReturn(CodeModel::ERROR,'添加失败');
            }
        }
    }


    public function topic(){
        $keyword = $_REQUEST['keyword'];
        if($keyword){
            $con['_string'] = "title like '%{$keyword}%' or message like '%{$keyword}%' or nickname like '%{$keyword}%' or uid = $keyword' ";
        }
        if(isset($_REQUEST['type']) && $_REQUEST['type']){
            $con['type'] = $_REQUEST['type'];
        }
        if(isset($_REQUEST['status']) && $_REQUEST['status']){
            $con['status'] = $_REQUEST['status'];
        }else{
            $con['status'] = array('neq',TopicModel::DEL);
        }
        $count = M('topic')->alias('t')->where($con)->count();
        $order ='rank desc ,tid desc';
        $row = 20;
        $page = new \Think\Page ( $count, $row );
        $list = M('topic')->where($con)->limit($page->firstRow,$page->listRows)->order($order)->select();
        $this->assign ( "list", $list );
        $page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
        $this->assign ( "page", $page->show() );
        $this->display ();
    }

    public function topicinfo(){
        $tid = $_REQUEST['tid'];
        $topic = TopicModel::getTopicByTid($tid);
        $club = ClubModel::getClub();
        $this->assign ( "club",$club);
        $this->assign ( "info",$topic);
        $this->display ();
    }

    public function modifyTopic(){
        $data = I('post.');
        if(!$data['title']){
            apiReturn(CodeModel::ERROR,'标题必填');
        }
        if(!$data['message']){
            apiReturn(CodeModel::ERROR,'内容不能为空');
        }
        if(intval($data['tid']) >0){
            if(false!== TopicModel::modifyTopic($data['tid'],$data)){
                apiReturn(CodeModel::CORRECT,'修改成功');
            }else{
                apiReturn(CodeModel::CORRECT,'修改失败');
            }
        }
        apiReturn(CodeModel::ERROR,'只支持修改,或刷新重试');
        dump($_REQUEST);
    }
}


?>