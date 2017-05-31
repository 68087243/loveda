<?php
namespace Common\Model;
use Think\Model;

class EscortPlanModel extends Model
{
    const NORMAL = 1;//
    const STOP = -1;//停止
    const KEY = 'LOVEHOU:ES:PLAN:';


    /**
     * 添加
     * @param $data
     * @return bool
     */
    public static function addPlan($data){
        if(!empty($data)){
            if($id = M('escortplan')->add($data)){
                $key = self::KEY;
                S($key,null);
                $key = self::KEY."USER:ID".$data['uid'];
                S($key,null);
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getPlanById($pid){
        $con['e.pid'] = $pid;
        return D('escortplan')->alias('e')->join('t_member as m on m.uid=e.uid')
            ->field('e.*,m.sex,m.level,m.nickname,m.picture as avatar')->where($con)->find();
    }

    public static function getPlanBySort($order,$limit = 10){
        $con['status'] = self::NORMAL;
        return D('escortplan')->where($con)->limit(0,$limit)->order($order)->select();
    }

}
