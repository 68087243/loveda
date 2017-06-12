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
     * 获取好友
     * @param $muid 登录UID
     * @param $uid  查询UID
     */
    public static function getFriendsByuid($uid){
        if($uid){
            $key = self::KEY.'UID:'.$uid;
            if(!$list = S($key)){
                $con['f.uid'] = $uid;
               return  D('friends')->alias('f')->join('t_member as m on m.uid = f.f_uid')
                   ->field('m.nickname,m.picture,f.*')
                   ->where($con)->order('f.fid desc')->select();
            }
            return $list;
        }else{
            return false;
        }
    }

    /**
     * 获取申请我为好友的
     * @param $muid 登录UID
     * @param $uid  查询UID
     */
    public static function getAddMeFriend($uid){
        if($uid){
            //查询所有添加我为好友但是状态为待回复的
            $con['f_uid'] = $uid;
            $con['status'] = self::REPLY_TO;
            return D('friends')->where($con)->select();
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
            $friend = D('friends')->where($con)->find();
            if($friend){
                return $friend['status'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 删除好友，双向删除
     * @param $uid
     * @param $fuid
     * @return bool
     */
    public static function delFriend($uid,$fuid){
        if($uid && $fuid){
            $con['_string'] = "(`uid`={$uid} or `uid`={$fuid}) and (`fuid`={$uid} or `fuid`={$fuid})";
            return D('friends')->where($con)->delete();
        }else{
            return false;
        }
    }

    /**
     * 拒绝好友，撤销申请
     * @param $uid
     * @param $fuid
     * @return bool
     */
    public static function refuseFriend($fid){
        if($fid){
            $con['fid'] = $fid;
            return D('friends')->where($con)->delete();
        }else{
            return false;
        }
    }

}