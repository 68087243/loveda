<?php
namespace Common\Model;

use Think\Model;

class HabbyModel extends Model {

    const NORMAL = 1;//状态启用
    const KEY = 'LOVEHOU:HOTWORD:';


    /**添加banner
     * @param $data
     * @return bool|mixed
     */
    public static function addData($data){
        if(!empty($data)){
            return D('banner')->add($data);
        }else{
            return false;
        }
    }

    /**
     * 获取洗好
     * @param $type
     * @return bool
     */
    public static function getHabby($state=self::NORMAL){
        if($state == self::NORMAL){
            $key = self::NORMAL.'STATUS'. $state;
            $con['status'] = $state;
        }else{
            $key = self::NORMAL;
        }
        if(!$list = S($key)){
            return D('habby')->where($con)->order('rank desc,hid desc')->select();
        }
        return $list;
    }


    /**
     * 获取洗好
     * @param $type
     * @return bool
     */
    public static function getPairing($state=self::NORMAL){
        if($state == self::NORMAL){
            $key = self::NORMAL.'STATUS'. $state;
            $con['status'] = $state;
        }else{
            $key = self::NORMAL;
        }
        if(!$list = S($key)){
            return D('pairing')->where($con)->order('rank desc,hid desc')->select();
        }
        return $list;
    }


    /**修改banner
     * @param $id
     * @param $data
     * @return bool
     */
    public static function modifyBanner($id,$data){
        if(regex($id,'number')){
            $con['id'] = $id;
            if(D('banner')->where($con)->save($data)){
                //原有的图片与修改提交的不一致时，删除原来的
                if(isset($data['indexpic']) && $data['indexpic']){
                    $banner = D('banner')->find($id);
                    if($banner['indexpic'] != $data['indexpic']){
                        $path = substr(C('UPLOAD_PATH'),0,-8);

                        delfile($path.$banner['indexpic']);
                    }
                }
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function delBanner($id){
        if(regex($id,'number')){
            if($banner = D('banner')->find($id)){
                $con['id'] = $banner['id'];
                if(D('banner')->where($con)->delete()){
                    delfile('./Public/'.$banner['indexpic']); //删除文件
                }
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
