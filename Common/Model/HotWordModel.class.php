<?php
namespace Common\Model;

use Think\Model;

class HotWordModel extends Model
{

    const NORMAL=1;//
    const TYPE_USER=2;//用户热词
    const TYPE_TOPIC=1;//帖子
    const KEY = 'LOVEHOU:HOTWORD:';

    public static function addHot($data){
        if(!empty($data)){
            if(D('hot_word')->add($data)){
                S(self::KEY,null);
                S(self::KEY.'TYPE:'.self::TYPE_USER,null);
                S(self::KEY.'TYPE:'.self::TYPE_TOPIC,null);
                return  true;
            }
        }else{
            return false;
        }
    }

    public static function modifyHot($id,$data){
        if($id && !empty($data)){
            $con['id'] = $id;
            return D('hot_word')->where($con)->save($data);
        }else{
            return false;
        }
    }

    /**
     * 根据热词类型获取热词
     * @param int $type
     */
    public static function getHotWordByType($type=self::TYPE_TOPIC){
        $con['type'] = $type;
        $con['status'] = self::NORMAL;
       return D('hot_word')->where($con)->select();
    }

    /**
     *获取所有
     * @return mixed|string
     */
    public static function getAll(){
        $key = self::KEY;
        if(!$list = S($key)){
            $list =  D('hot_word')->select();
            S($list,86400*30);
        }
        return $list;
    }


}