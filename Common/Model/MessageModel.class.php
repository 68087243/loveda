<?php
namespace Common\Model;

use Think\Model;

class MessageModel extends Model
{

    const TOPIC_MSG=1;//帖子评论发送消息
    const ADD_FRIENDS_MSG=2;//添加好友发送消息
    const ACCEPT_FRIENDS_MSG=3;//接受添加好友
    const FRIENDS_MSG=4;//好友消息
    const SYSTEM_MSG=5;//系统消息
    const GUEST_MSG=6;//留言消息

    const NOREAD=1;//未读消息
    const READ_MSG = 0;//已读
    const KEY = 'LOVEHOU:MESSAGE:';

    public static function addMsg($data){
        if(!empty($data)){
            if(D('message')->add($data)){
                S(self::KEY.'TYPE:'.self::SYSTEM_MSG,null);//清除系统消息缓存
                return  true;
            }
        }else{
            return false;
        }
    }

    public static function getMsgByMid($mid){
        return D('message')->find($mid);
    }

    /**
     *获取系统消息
     * @return mixed|string
     */
    public static function getSystemMsg(){
        $key = self::KEY.'TYPE:'.self::SYSTEM_MSG;
        if(!$list = S($key)){
            $con['type'] =self::SYSTEM_MSG;
            $list = D('message')->where($con)->select();
            S($list,86400*30);
        }
        return $list;
    }

    /**
     * 获取用户消息
     * @param $uid
     * @return mixed|string
     */
    public static function getMsgByUid($uid,$type=null){
        if($type==self::FRIENDS_MSG){ //只获取聊天消息
            $con['type'] =$type;
        }else{
            //获取非聊天消息
            $con['type'] = array('neq',self::FRIENDS_MSG);
        }
        //和用户消息系统消息
        $con['_string'] = '(`uid` ='.$uid.') or (`operator`) =0';
        $order = '`isread` desc,`createtime` desc';
        return D('message')->where($con)->order($order)->select();
    }

    /**
     * 获取用户所有未读消息条数
     * @param $uid
     * @return mixed|string
     */
    public static function getNewMsgNumByUid($uid){
        $con['isread'] = self::NOREAD;
        $con['type'] = array('neq',self::FRIENDS_MSG);
        $con['_string'] ="`uid` ={$uid} or `operator` =0";//指定接收人，或者是系统发的消息
        $data['tit'] = D('message')->where($con)->count();//系统，评论，好友
        $con0['isread'] = self::NOREAD;
        $con0['type'] = array('eq',self::TOPIC_MSG);
        $data['topic'] = D('message')->where($con0)->count();//评论
        $con1['isread'] = self::NOREAD;
        $con1['type'] = self::FRIENDS_MSG;
        $con1['uid'] = $uid;
        $data['chat'] = D('message')->where($con1)->count();
        return $data;
    }

    /**
     * 获取信息后修改读取状态
     * @param $mid
     * @return bool
     */
    public static function readMesUp($mid){
        if(regex($mid,'number')){
            $savedata['readtime'] = date('Y-m-d H:i:s');
            $savedata['isread'] = MessageModel::READ_MSG;
            $con['mid'] = $mid;
            return D('message')->where($con)->save($savedata);
        }else{
            return false;
        }
    }
}