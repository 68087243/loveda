<?php
namespace Common\Model;
use Think\Model;

class AreaModel extends Model
{
    const KEY = 'LOVEHOU:AREA:';


    public static function getAreaAll(){
        return D('area')->select();
    }

    public static function getAreaByid($id){
        if(regex($id,'number')){
            return M('area')->find($id);
        }else{
            return false;
        }
    }
    /**
     *  获取该地区，地理位置描述 如 四川，  四川 成都，
     * @param type $areaId 区域Id
     */
    public static function getAreaDesc($areaId){
        $area = D("area")->find($areaId);
        if(!empty($area)){
            $pro = D("area")->find($area["parentid"]);
            if(!empty($pro)){
                $address = $pro["name"]." ".$area["name"]."  ";
            }else{
                $address = $area["name"]." ";
            }
            return $address;
        }
        return null;
    }

    //通过area_id 获取province_id  city_id
    public static function getPCId($areaId){
        if($areaId){
            $area = array("provinceId"=>0,"cityId"=>0);
            $city = D('area')->find($areaId);
            if($city['parentid']!=0){
                $area['cityId'] = $city['aid'];
                $area_id = $city['parentid'];
                $province = D('Area')->find($area_id);
                $area['provinceId'] = $province['aid'];
            }else{
                $area['provinceId'] = $city['aid'];
            }
            return $area;
        }
    }

    public static function getAreaChildById($areaId){
        return D('area')->where(array('parentid'=>$areaId))->select();
    }

    public static function getAreaNameById($areaId){
        $res = D('area')->where(array('aid'=>$areaId))->find();
        return $res;
    }
}
