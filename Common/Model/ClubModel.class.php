<?php
namespace Common\Model;

use Think\Model;

class ClubModel extends Model
{
    const NORMAL = 1;//状态正常
    const KEY = 'LOVEHOU:CLUB';

    /**
     * 获取分类
     * @return mixed|string
     */
    public static function getClub(){
        if(!$list = S(self::KEY)){
            $where['status'] = self::NORMAL;
            $list =  M('club')->where($where)->select();
            S(self::KEY,$list,86400*7);
        }
        return $list;
    }

    /**
     * 获取分类
     * @return mixed|string
     */
    public static function getClubById($clubid){
        $key =  self::KEY.':ID'.$clubid;
        if(!$list = S($key)){
            $list =  M('club')->find($clubid);
            S($key,$list,86400*7);
        }
        return $list;
    }

}