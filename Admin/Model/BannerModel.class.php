<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

class BannerModel extends Model {
    const PC_BANNER = 1;//网站banner
    const WX_BANNER = 2;//微信banner
    const NORMAL = 1;//状态启用

    /**
     * 根据类型获取banner
     * @param $type
     * @return bool
     */
    public static function getBannerByType($type,$state=self::NORMAL){
        if(regex($type,'number')){
            $con['type'] = $type;
            if($state == self::NORMAL){
                $con['status'] = $state;
            }
            return D('banner')->where($con)->order('rank desc')->select();
        }else{
            return false;
        }
    }

    /**添加banner
     * @param $data
     * @return bool|mixed
     */
    public static function addBanner($data){
        if(!empty($data)){
            return D('banner')->add($data);
        }else{
            return false;
        }
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
