<?php
namespace Common\Model;

use Think\Log;
use Think\Model;

class CodeModel extends Model
{
    /* 常用 请求返回码*/
    const CORRECT = 200;      //正常返回
    const ERROR =  400;       //错误返回
    const ACCOUNT_DISABLE = 205;//账号禁用
    public static function getMessage($code){
        switch($code){
            case self::CORRECT:  return "成功";
            case self::ERROR:  return "失败";
            default: return "未知错误";
        }
    }

    public static function Glog($msg,$level=Log::INFO){
       Log::record($msg,$level);
    }


}