<?php
function getTopicByCid($cid,$limit=0){
    if(regex($cid,'number')){
        return \Common\Model\TopicModel::getTopicByCid($cid,$limit);
    }
    return false;
}

function getTopicByHot($limit=0){
    $order ='`rank` desc,`read` desc,`likeit` desc,`comments` desc '; //后台排序，阅读 点赞，评论
    return \Common\Model\TopicModel::getTopic($order,$limit);
}

?>