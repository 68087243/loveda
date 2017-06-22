<?php
namespace Common\Model;
use Think\Model;

class FormModel extends Model
{

    const KEY = 'LOVEHOU:FORM:';

    /**
     * 添加
     * @param $data
     * @return bool
     */
    public static function addForm($data){
        if(!empty($data)){
            if($id = M('form')->add($data)){
                $key = self::KEY;
                S($key,null);
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    public  static function getReplyByIdType($tid,$type=self::TOPIC){
        if($tid){
            $con['r.tid'] = $tid;
            $con['r.type'] = $type;
            return D('reply')->alias('r')->join('t_member as m on m.uid=r.uid')
                ->field('r.*,m.picture as avatar,m.level')
                ->where($con)->select();
        }else{
            return false;
        }
    }
}
