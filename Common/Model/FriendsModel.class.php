<?php
namespace Common\Model;

use Think\Model;

class FriendsModel extends Model
{
    const REPLY_TO = 1;//待回复
    const FRIENDS = 2;//好友
    const KEY = 'LOVEHOU:FRIENDS:';

    /**
     * 添加朋友
     * @param $data
     * @return bool
     */
    public static function addFriends($data){
        if(!empty($data)){
            if(D('friends')->add($data)){
                $userkey = self::KEY.'UID:'.$data['uid'];
                $touserkey = self::KEY.'UID:'.$data['t_uid'];
                S($userkey,null);
                S($touserkey,null);
                return true;
            }else{
                return false;
            }
        }else{
            return false; 
        }
    }

    /**
     * 判断是否是好友关系
     * @param $muid 登录UID
     * @param $uid  查询UID
     */
    public static function isfriend($muid,$uid){
        if($muid && $uid){
            $con['uid'] = $muid;
            $con['f_uid'] = $uid;
            if(D('friends')->where($con)->find()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}