<?php
namespace Common\Model;
use Org\Util\String;
use Think\Model;

class UserPhotoModel extends Model
{

    const PHOTO_TYPE = 1;//相册
    const AVATAR_TYPE = 2;//头像
    const IN_AUDIT = 0;//审核中
    const AUDITED = 1;//审核通过

    public static function addImg($data){
        if(!empty($data)){
            if($id = D('member_photo')->add($data)){
                $key = 'LOVEHOU:USER:PHOTO:UID'.$data['uid']."TYPE:".self::AVATAR_TYPE;
                S($key,null);
                $key = 'LOVEHOU:USER:PHOTO:UID'.$data['uid']."TYPE:".self::PHOTO_TYPE;
                S($key,null);
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getUserPhotoByCon($con,$type = self::PHOTO_TYPE){
        if($type == self::PHOTO_TYPE){
            return  D('member_photo')->where($con)->select();
        }else{
            return  D('member_photo')->where($con)->find();
        }
    }


    public static function modifyPhoto($id,$data){
        if($id && $data){
            $con['id'] = $id;
            $rs = D('member_photo')->where($con)->save($data);
            if($rs){
                //头像审核通过将原来的头像跟换掉
                $img = D('member_photo')->find($id);
                if( $data['status'] == self::AUDITED && $img['type'] == self::AVATAR_TYPE){
                //头像审核通过，更新头像
                    $savadata['picture'] = $img['img'];
                    UserModel::modifyMember($img['uid'],$savadata);
                }
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 获取用户的照片
     * @param $uid
     * @return bool|mixed|string
     */
    public static function getUserPhoto($uid,$type=self::PHOTO_TYPE){
        if(regex($uid,'number')){
            $key = 'LOVEHOU:USER:PHOTO:UID'.$uid."TYPE:".$type;
            if(!$list = S($key)){
                $con['uid'] = $uid;
                $con['type'] = self::PHOTO_TYPE;
                $list = D('member_photo')->where($con)->order('status asc ,rank desc,id desc')->select();
                S($key,$list,86400*30);
            }
            return $list;
        }else{
            return false;
        }
    }

    /**
     * 删除用户的照片
     * @param $uid
     * @return bool|mixed|string
     */
    public static function delPhoto($imgid,$uid){
        if(regex($imgid,'number') && regex($uid,'number')){
            $img = D('member_photo')->find($imgid);
            if($img && $img['uid']!=$uid){
                apiReturn(CodeModel::ERROR,'该图片不是你的，你不能操作！');
            }else{
                if(is_file(APP_PATH.'Public'.$img['img'])){ //删除源文件
                    delfile(APP_PATH.'Public'.$img['img']);
                }
                if(is_file(APP_PATH.'Public'.$img['thumb'])){ //删除源文件
                    delfile(APP_PATH.'Public'.$img['thumb']);
                }
                $con['id'] = $imgid;
                $con['uid'] = $uid;
                if(D('member_photo')->where($con)->delete()){
                    $key = 'LOVEHOU:USER:PHOTO:UID'.$uid."TYPE:".self::AVATAR_TYPE;
                    S($key,null);
                    $key = 'LOVEHOU:USER:PHOTO:UID'.$uid."TYPE:".self::PHOTO_TYPE;
                    S($key,null);
                }
            }
            return true;
        }else{
            return false;
        }
    }
}
