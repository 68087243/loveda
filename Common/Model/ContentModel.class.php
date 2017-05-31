<?php
namespace Common\Model;
use Think\Model;

class ContentModel extends Model
{
    const NORMAL = 1;//状态正常
    const KEY = 'LOVEHOU:CONTENT';
    const PUBLIC_FUNDING = 2;
    const NWES = 1;
    const RECOMMEND = 1;

    /**
     *
     * @return mixed|string
     */
    public static function addContent($data){
        $where['status'] = self::NORMAL;
        if($id = M('content')->add($data)){
            $key = self::KEY.'TPYE:'.self::PUBLIC_FUNDING;
            S($key,null);
            $key = self::KEY.'TPYE:'.self::NWES;
            S($key,null);
            return $id;
        }else{
            return false;
        }

    }

    public static function getContentById($id){
       return M('content')->find($id);
    }

    public static function modifyContent($id,$data){
        if($id && !empty($data)){
            $con['id'] = $id;
            return M('content')->where($con)->save($data);
        }else{
            return false;
        }
    }

    public static function delContent($id){
        if($id){
            $con['id'] = $id;
            if(M('content')->where($con)->delete()){
                $key = self::KEY.'TPYE:'.self::PUBLIC_FUNDING;
                S($key,null);
                $key = self::KEY.'TPYE:'.self::NWES;
                S($key,null);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 获取推荐文章
     * @param int $limit
     * @return mixed|string
     */
    public static function getHotContent($limit=10,$type=ContentModel::NWES){
        $key =  self::KEY.'TPYE:'.$type;
        if(!$list = S($key)){
            $con['recommend'] = self::RECOMMEND;
            $con['type'] = $type;
            $list =  M('content')->where($con)->limit(0,$limit)->select();
            S($key,$list,86400*7);
        }
        return $list;
    }

}