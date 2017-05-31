<?php
namespace Common\Model;
use Think\Model;

class FavoriteModel extends Model
{
    const KEY = 'LOVEHOU:FAVORITE:';

    /**
     * 添加
     * @param $data
     * @return bool
     */
    public static function addFavorite($data){
        if(!empty($data)){
            if($id = M('favorite')->add($data)){
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getFavoriteByUidAndTid($tid,$uid){
        if($tid && $uid){
            $con['tid'] = $tid;
            $con['fuid'] = $uid;
            return  M('favorite')->where($con)->find();
        }else{
            return false;
        }
    }

    public static function getFavoriteByFid($fid){
        if($fid){
            return  M('favorite')->find($fid);
        }else{
            return false;
        }
    }

    public static function delfavorite($fid,$uid){
        if(regex($fid,'number')){
            $favorite = self::getFavoriteByFid($fid);
            if(!$favorite){
                apiReturn(CodeModel::ERROR,'删除目标不存在！');
            }
            if($favorite['fuid'] !=$uid){
                apiReturn(CodeModel::ERROR,'该帖子不是你的，你无权操作');
            }
            $con['fid'] = $fid;
            return D('favorite')->where($con)->delete();
        }else{
            return false;
        }
    }


}
