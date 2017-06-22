<?php
namespace Org\Util;
use Think\Log;

class HttpRequest{

    public static function postUrl($url, $params = array(), $timeout = 30){
        Log::record("httprequest","post url:".$url,Log::INFO);
          //编码特殊字符
        $p = http_build_query($params);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        // 设置header
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $p);

        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 运行cURL，请求网页
        $data = curl_exec($curl);
        if($data === false){
            Log::record("httprequest","post error:".curl_error($curl),Log::ERR);
            return false;
        }else{
            Log::record("httprequest","post result:".print_r($data,true),Log::INFO);
            return $data;
        }
    }

    /**
     * GET 请求
     * @param string $url
     */
    public static  function http_get($url){
        Log::record("httprequest","get url:".$url,Log::INFO);
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }
}

?>
