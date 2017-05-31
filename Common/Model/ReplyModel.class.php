<?php
namespace Common\Model;
use Think\Model;

class ReplyModel extends Model
{
    const TOPIC = 1;//帖子回复
    const GUESBOOK = 2;//留言板回复
    const PLAN = 3;//伴游回复
    const KEY = 'LOVEHOU:REPLY:';

    /**
     * 添加
     * @param $data
     * @return bool
     */
    public static function addReply($data){
        if(!empty($data)){
            if($id = M('reply')->add($data)){
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
