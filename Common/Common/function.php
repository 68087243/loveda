<?php

function getAreaByAid($aid){
    $area = \Common\Model\AreaModel::getAreaByid($aid);
    if($area){
        return $area['name'];
    }
    return false;
}


/**
 * 自定义标签调用|TP专用
 *
 * @param unknown $name
 * @param string $value
 * @return Ambigous <mixed, void, boolean>|string
 */
function lbl($name, $value = null) {
    $cachename = 'label_' . $name;
    $cache = S ( $name );
    if ($value == null) {
        if (! $cache) {
            $where = array ();
            $where ['status'] = 1;
            $where ['name'] = $name;
            $db = M ( 'label' )->where ( $where )->find ();
            if ($db) {
                $cache = $db ['info'];
                S ( $cachename, $cache );
            }
        }
    } else {
        S ( $cachename, $value );
        $cache = $value;
    }
    return $cache;
}


function timeTran($time) {
    $nowTime = date("Y-m-d H:i:s", time());
    $nowTime = strtotime($nowTime);
    $showTime = strtotime($time);
    $dur = $nowTime - $showTime;
    if ($dur < 0) {
        return $time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//3天内
                        return floor($dur / 86400) . '天前';
                    } elseif($dur < 30758400) {//一年以内
                        return date('m月d H点',$showTime);
                    }else{
                        return date('Y年m月d',$showTime);
                    }
                }
            }
        }
    }
}

function lastRecent($lastTime){
    $data = time()-strtotime($lastTime);
    $time = floor($data/86400);
    return $time;
}

function sock_post($url,$para){
    $query = http_build_query($para);
    $info = parse_url($url);
    $fp = fsockopen($info["host"], 80, $errno, $errstr, 1);
    if(isset($info["query"])){
        $head = "POST  ".$info['path']."?".$info["query"]." HTTP/1.0\r\n";
    }else{
        $head = "POST  ".$info['path']." HTTP/1.0\r\n";
    }
    $head .= "Host: ".$info['host']."\r\n";
    $head .= "Referer: http://".$info['host'].$info['path']."\r\n";
    $head .= "Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n";
    $head .= "Content-Length: ".strlen(trim($query))."\r\n";
    $head .= "\r\n";
    $head .= trim($query);
    $write = fputs($fp,$head);
}

function getApiKey($data,$key){
    ksort($data);
    $str = '?';
    foreach ($data as $k=> $v) {
        $str.= $k.'='.$v.'&';
    }
    $str.=$key;
   return md5(md5($str));
}

function isToday($time){
    $nowTime = date('Y-m-d', time());
    if(substr($time, 0, 10)==$nowTime){
        return true;
    }else{
        return false;
    }
}

function sign($amount){
    if($amount<=0){
        return $amount;
    }else{
        return "+".$amount;
    }
}

function useSex($sex){
    switch($sex){
        case "0":$data = "女"; break;
        case "1":$data = "男"; break;
        case "":$data = "未完善"; break;
    }
    return $data;
}

function resPayline($state){
    if($state==RestaurantModel::PAYONLINE){
        return '<span class="res_span res_span3">付</span>';
    }else{
        return "";
    }
}

/**
 * 获取权限对象
 * @return RoleSession
 */
function ROLE(){
    return RoleSession::getInstance();
}

function float_fee($float){
    if(empty($float)){
        return 0;
    }else{
        return (float)round($float,2);
    }
}

function serivceState($state){
    if($state==1){
        return "<span class='green'>启用</span>";
    }
    return "<span class='red'>未启用</span>";
}

function cdkdueTime($duetime){
    switch($duetime){
        case 3 :return "3天"; break;
        case 7 :return "7天"; break;
        case 10 :return "10天"; break;
        case 30 :return "1个月"; break;
        case 90 :return "3个月"; break;
        case 180 :return "6个月"; break;
        case 360 :return "1年"; break;
        case 1080:return "3年"; break;
        case 1800:return "5年"; break;
        case 3600:return "10年"; break;
    }
}

//获取年龄下拉选项框
function getYearOption($year){
    $options = '';
    for($i = 1960; $i<=2000; $i++){
        if($i==$year){
            $options .="<option value=".$i." selected='selected'>".$i."</option>";
        }else{
            $options .="<option value=".$i.">".$i."</option>";
        }
    }
    return $options;
}

//获取年龄
function getYear($birth){
    if($birth){
        $year = date('Y', time())-$birth;
        return $year;
    }else{
        return "未设置";
    }
}

/**
 *
 * @param type $source  源数字
 * @param type $key   键值
 * @param type $filter  过滤器
 * @param type $filterMethod 过滤函数 如 htmlspecialchars,strip_tags
 *    require email url currency
 * @return type
 */
function V($value, $filterMethod = ""){
    $filterMethod = $filterMethod?$filterMethod:C('DEFAULT_FILTER');
    if(!empty($filterMethod)&&$value){
        $filters = explode(',', $filterMethod);
        foreach($filters as $filter){
            if(function_exists($filter)){
                $value = $filter($value); // 参数过滤
            }else{
                Log::record("V : $filter function not exist", Log::ERR);
                return false;
            }
        }
    }
    return $value;
}

/**
 *
 * @param type $value
 *          验证的值
 * @param string $rule
 *           用于验证的表达式
 * @return boolean
 * true 值匹配表达式，反之不匹配
 *
 */
function regex($value, $rule){
    $validate = array(
        'require'=>'/.+/',
        'email'=>'/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
        'url'=>'/^http:\/\/[A-Za-z0-9|-]+\.[A-Za-z0-9|-]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/',
        'currency'=>'/^\d+(\.\d+)?$/',
        'number'=>'/^\d+$/',
        'zip'=>'/^[1-9]\d{5}$/',
        'integer'=>'/^[-\+]?\d+$/',
        'double'=>'/^[-\+]?\d+(\.\d+)?$/',
        'english'=>'/^[A-Za-z]+$/',
        'time'=>'/^[0-9]{4}-[0-9]{2}-[0-9]{1,2}\s+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}$/', // 2012-03-13 11:09:11
        'date'=>'/^[0-9]{4}-[0-9]{2}-[0-9]{1,2}$/',
        'tel'=>'/^(\d{11})|((\d{3}-\d{8})|(8\d{10})|(9\d{9})|(\d{7})|(\d{4}-\d{7}))$/',
        'qq'=>'/^\d{6,11}$/',
        'short_url'=>'/^[0-9A-Za-z]+$/', // 短域名
        'short_tel'=>'/^(\d){3,6}$/',
        'china'=>'/^[\x{4e00}-\x{9fa5}]+$/u',
        'mob_tel'=>'/^(\d{10,11})|((\d{3}-\d{8})|(8\d{10})|(9\d{9})|(\d{7})|(\d{4}-\d{7}))$/', //移动电话
        'mob'=>'/^\d{10,11}$/', //手机
    );
    // 检查是否有内置的正则表达式
    if(isset($validate[strtolower($rule)])) $rule = $validate[strtolower($rule)];
    return preg_match($rule, $value)===1;
}

function wap($url, $data = array()){
    if (!is_array($data)) {
        $data = array();
    }
    return  R($url,$data);
}

//过滤表单字段
function post_var($data=array(),$post){
    $reData = array();
    foreach($data as $k=>$v){
        $reData[$v]= $post[$v];
    }
    return $reData;
}

//拆分以逗号连接的字符串
function explodeOrderContent($str){
    $content = str_replace(",","<br />",$str);
    return $content;
}

//获取当前地址url
function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

function error($message='404', $jumpUrl='', $waitSecond = 3){
    $view = Think::instance('View');
    $view->assign(array(
        'message' => $message,
        'waitSecond' => $waitSecond,
    ));
    if (empty($jumpUrl)) {
        if ($_SERVER['HTTP_REFERER'] == $_SERVER['HTTP_HOST']) {
            return ;
        }
        $jumpUrl = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/';
    }
    session('PUSH_ERROR', $view->fetch(APP_PATH .'/Public/statichtml/topError.tpl'));
    redirect($jumpUrl);
}

function apiReturn($code = \Common\Model\CodeModel::CORRECT,$msg="", $data = array()){
    $result['code'] = $code;
    if(empty($msg)){
        $msg = \Common\Model\CodeModel::getMessage($code);
    }
    $result['message'] = $msg;
    $result['data'] = $data;
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($result));
}

//订单序号处理  长度超过3位 改成*123的格式 例如:4785212=>*212
function sequenceStr($sequence){
    return mb_strlen($sequence) >= 4 ? "*".substr($sequence,-3) : $sequence;
}

/**
 *  获取随机字符串，包含大写字母和数字
 * @return string
 */
function getRandStr($length=6){
    $hex = array('K', 'Y', 'S', '3', 'Q', 'J',
        '5', 'P', 'N', '9', 'A', 'G',
        '7', 'X', 'F', '8', '4', 'W',
        'T', '2', 'M', '1', 'I', 'C',
        'B', '6', '0', 'E', 'Z', 'L',
        'O', 'U', 'R', 'D', 'H', 'V'); //36位随机数
    $str = '';
    for($i = 0; $i<$length; $i++){
        $str.=$hex[mt_rand(0, 35)];
    }
    return $str;
}

/**
 *  获取随机字符串，包含小写字母和数字
 * @return string
 */
function getRandLowerStr($length=6){
    $hex = array('k', 'y', 's', '3', 'q', 'j',
        '5', 'p', 'n', '9', 'g', 'a',
        '7', 'x', 'w', '8', '4', 'f',
        't', '2', 'm', '1', 'i', 'c',
        'b', '6', '0', 'e', 'z', 'l',
        'o', 'u', 'r', 'd', 'h', 'v'); //36位随机数
    $str = '';
    for($i = 0; $i<$length; $i++){
        $str.=$hex[mt_rand(0, 35)];
    }
    return $str;
}

// 处理图片链接地址
function iUrl($url,$default){
    if(empty($url)){
        return $default;
    }
    if(stripos($url,"http") !== false){
        return $url;
    }else{
        $tpl = C('TMPL_PARSE_STRING');
        return $tpl['__UPLOAD__'].$url;
    }
}

/**
*  @desc 根据两点间的经纬度计算距离
*  @param float $s 第一个点的经纬度 (经度，纬度)
*  @param float $e 第二个点的经纬度 (经度，纬度)
*/
 function GetDistance($one, $tow)
 {
     $one = explode(',', $one);
     $tow = explode(',', $tow);
     $lng1 = $one[0];
     $lat1 = $one[1];
     $lng2 = $tow[0];
     $lat2 = $tow[1];
      //地球半径
    $R = 6378137;  //m
    //将角度转为狐度
    $radLat1 = deg2rad($lat1);
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);
    //结果
    $s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R;
    //精度
    $s = round($s* 10000)/10000;
    return  round($s);
 }
 
 /**
  *  把文字转换成 $length 个字，字数不够空白补全
  * @param type $text
  * @param int $length
  * @param $opt 过长是否换行显示，否则就直接返回
  * @param $padding 补全字符，默认为 " "
  */
function getTextHtml($text,$length ,$opt = false,$padding=" "){
    $nowLength = (strlen($text) + mb_strlen($text,'UTF8')) / 2;
    if($length > $nowLength){
        for($i=0;$i<$length-$nowLength;$i++){
            $text .= $padding;
        }
    }else if($opt){
        $l = intval($length);
        $str1 = mb_substr($text, 0,$l,'UTF8'); //前半部分
        $str = mb_substr($text, $l,'','UTF8');  //后半部分
        $text = $str1.'<br/>'.$str;
        // 补全后半部分
        $nowLength = (strlen($str) + mb_strlen($str,'UTF8')) / 2;
        for($i=0;$i<$length-$nowLength;$i++){
            $text .= $padding;
        }
    }
    return $text;
}
/**
 * PHP 过滤HTML代码空格,回车换行符的函数," , '
 * echo deletehtml()
 */
function deletehtml($str)
{
    $str = trim($str);
    $str = str_replace('"','',$str);
    $str=strip_tags($str," ");
    $str=preg_replace("{\t}","",$str);
    $str=preg_replace("{\r\n}","",$str);
    $str=preg_replace("{\r}","",$str);
    $str=preg_replace("{\n}","",$str);
    return $str;
}

function getFloat($f1,$pre=2){
    return round(floatval($f1),$pre);
}

//版本号
function version($v=false){
    if($v !==false){
        return $v; //自定义版本
    }else{
        return 'v.6.1-3'; //日期号
    }
}

/**
 * 二维数组排序
 * @param $arrays 规定输入的数组。
 * @param $sort_key 排序字段
 * @param int $sort_order 规定排列顺序。可能的值是 SORT_ASC 和 SORT_DESC。
 * @param int $sort_type 规定排序类型。可能的值是SORT_REGULAR、SORT_NUMERIC和SORT_STRING。
 * @return array|bool
 */
function myArraySort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
    if(is_array($arrays)){
        foreach ($arrays as $array){
            if(is_array($array)){
                $key_arrays[] = $array[$sort_key];
            }else{
                return false;
            }
        }
    }else{
        return false;
    }
    array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
    return $arrays;
}


/**
 * *
 * 重组节点
 */
function node_merge($node, $access = null, $pid = 0) {
    $arr = array ();
    foreach ( $node as $v ) {
        if (is_array ( $access )) {
            $v ["access"] = in_array ( $v ["id"], $access ) ? 1 : 0;
        }
        if ($v ['pid'] == $pid) {
            $v ['child'] = node_merge ( $node, $access, $v ['id'] );
            $arr [] = $v;
        }
    }

    return $arr;
}