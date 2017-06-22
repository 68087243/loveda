<?php
namespace Org\Util;
use Think\Log;

/**
 *  类描述: [微信分享类,获取需要分享的token和密钥]
 */
class WxJsSdk{

    const SHARE_TOKEN_KEY = "SHARE_TICKET_KEY";
    const SHARE_TICKET_KEY = "WX_SHARE";

    private $appId;  //appId
    private $appSec;  //appSec

    /**
     *  公共号里面的appId 和密钥
     * @param type $appId
     * @param type $appSec
     */

    public function __construct($appId='', $appSec=''){
        if(empty($appId) || empty($appSec)){
            $this->appId = C('WECHAT_APPID');
            $this->appSec =C('WECHAT_APPSECRET');
        }else{
           $this->appId = $appId;
           $this->appSec = $appSec;
        }
    }

    /**
     *  获取密钥
     * @param type $noncestr 随机字符串
     * @param type $timestamp 时间戳
     * @param type $url 链接地址
     * @return type
     */
    public function getSignPacket(){
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        Log::record("httprequest","getSignPacket url:".$url,Log::INFO);
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        $apiTicket =$this->getApiTicket();
        Log::record("httprequest","$apiTicket:".json_encode($apiTicket),Log::INFO);
        $bindUrl = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",$apiTicket,$nonceStr, $timestamp,$url);
        $sign = sha1($bindUrl);
        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "sign" => $sign,
            "rawString" => $bindUrl
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for($i = 0; $i < $length; $i++){
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     *  获取微信Token
     * @param type $forceUpdate 是否忽略缓存强制更新， true 强制更新 
     * @return type
     * @throws BackException
     */
    private function getWxToken($forceUpdate = false){
        if($forceUpdate){
            $url = "https://api.weixin.qq.com/cgi-bin/token?"
                    . "grant_type=client_credential&appid=%s&secret=%s";
            $url = sprintf($url, $this->appId, $this->appSec);
            $HttpRequest=  new HttpRequest();
            $res = $HttpRequest::http_get($url);
            Log::record('wxjssdk getWxToken///',json_encode($res));
            if(!empty($res)){
                $tt = json_decode($res, true);
                if(isset($tt['access_token'])){
                    $token = $tt['access_token'];
                    S(self::SHARE_TOKEN_KEY, $token, 7000);
                    return $token;
                }else{
                    Log::record('wxjssdk getWxToken',$tt['errmsg']);
                    return false;
                }
            }else{
               Log::record('wxjssdk getWxToken',"请求$url 失败");
                return false;
            }
        }
        $token = S(self::SHARE_TOKEN_KEY);
        if(!empty($token)){
            return $token;
        }else{
            $this->getWxToken(true);
        }
    }

    /**
     *  获取微信jsTicket
     * @param type $forceUpdate 是否忽略缓存强制更新，true :强制更新
     * @return type
     * @throws BackException
     */
    private function getApiTicket($forceUpdate = false){
        if($forceUpdate){
            $token = $this->getWxToken($forceUpdate);
            $url = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?"
                    . "access_token=%s&type=jsapi", $token);
            $HttpRequest=  new HttpRequest();
            $res = $HttpRequest::http_get($url);
            Log::record('wxjssdk getApiTicket///',json_encode($res));
            if(!empty($res)){
                $tt = json_decode($res, true);
                if($tt['errcode'] == 0){
                    $ticket = $tt['ticket'];
                    S(self::SHARE_TICKET_KEY, $ticket, 7000);
                }else{
                    Log::record('wxjssdk getApiTicket',$tt['errmsg']);
                    return false;
                }
            }else{
                Log::record('wxjssdk getApiTicket',"请求$url 失败");
                return false;
            }
        }
        $ticket = S(self::SHARE_TICKET_KEY);
        if(!empty($ticket)){
            return $ticket;
        }else{
            $this->getApiTicket(true);
        }
    }

}
