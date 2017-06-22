<?php 
namespace Admin\Model;
use Think\Model;
 
class LevelModel extends Model{
    const  DISABLE = -1;
    const  NORMAL = 1;

    public static function addLevel($data){
       if($data){
           return D( "level" )->add($data);
       }else{
           return false;
       }
    }

    public static function getLevel($status=false){
        if($status){
            $con['status'] = self::NORMAL;
            return D( "level" )->where($con)->order ( 'level desc' )->select ();
        }else{
            return D( "level" )->order ( 'level desc' )->select ();
        }
    }

    public static function delLevel($id){
        $con['id'] = $id;
        return D( "level" )->where($id)->delete();
    }

    public static function modifyLevel($id,$data){
        if($id && !empty($data)){
            $con['id'] = $id;
            return D( "level" )->where($con)->save($data);
        }else{
            return false;
        }
    }
}
