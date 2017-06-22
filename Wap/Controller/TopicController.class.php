<?php
namespace Wap\Controller;

use Common\Model\ClubModel;
use Think\Controller;
class TopicController extends BaseController {
    public function index(){
        $this->display();
    }

    public function rlist(){
        $this->display();
    }

    public function topicList(){
        $this->display('topic_list');
    }

    public function topicInfo(){
        $this->display('topic_info');
    }

    public function postTopic(){
      //  $clubid =1; $_REQUEST['clubid'];
        $club = ClubModel::getClub();
        $this->assign('club',$club);
        $this->display('post_topic');
    }

    public function  subTopic(){

    }
}