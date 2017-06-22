<?php

//判断是什么手机访问
function getDeviceType(){
    //全部变成小写字母
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $type = 'other';
    //分别进行判断
    if(strpos($agent, 'iphone') || strpos($agent, 'ipad')){
        $type = 'ios';
    }
    if(strpos($agent, 'android')){
        $type = 'android';
    }
    return $type;
}

function getLTime(){
    $todayend = date('Y-m-d',strtotime('+1 day')).' 00:00:00';
    $nowtime = date('Y-m-d H:i:s');
    return strtotime($todayend)-strtotime($nowtime);
}

/**删除文件
 * @param $file
 * @return bool
 */
function delfile($file){
    $path = substr(C('UPLOAD_PATH'),0,-8);
    if(file_exists($path.$file)){
        return unlink ($path.$file);
    }
    return true;
}

/**
 * @param $str 要截取的字符串
 * @param int $start 开始位置，默认从0开始
 * @param $length 截取长度
 * @param string $charset 字符编码，默认UTF－8
 * @param bool $suffix 是否在截取后的字符后面显示省略号，默认true显示，false为不显示
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(!$str){
        return '';
    }
    if(function_exists("mb_substr")){
        if($suffix && strlen($str) > $length){
            return mb_substr($str, $start, $length, $charset)."...";
        }else{
            return mb_substr($str, $start, $length, $charset);
        }
    }elseif(function_exists('iconv_substr')) {
        if($suffix && strlen($str) > $length) {
            return iconv_substr($str, $start, $length, $charset) . "...";
        }else {
            return iconv_substr($str, $start, $length, $charset);
        }
    }
    $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
    $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
    $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix && strlen($str) > $length){
        return $slice."…";
    }
    return $slice;
}

/**
 * 支付宝客户端
 */
function isAlipay(){
    return isset($_SERVER['HTTP_USER_AGENT'])&&strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient')!==false?true:false;
}

/**
 * 程  序：iswap.php判断是否是通过手机访问
 * 版  本：Ver 1.0 beta
 * 修  改：奇迹方舟(imiku.com)
 * 最后更新：2010.11.4 22:56
 * @return boolean 是否是移动设备
 * 该程序可以任意传播和修改，但是请保留以上版权信息!
 */
function isMobile(){
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){
        return true;
    }
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if(isset($_SERVER['HTTP_VIA'])){
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap")?true:false;
    }
    //脑残法，判断手机发送的客户端标志,兼容性有待提高
    if(isset($_SERVER['HTTP_USER_AGENT'])){
        $clientkeywords = array(
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile',
            'MicroMessenger'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if(preg_match("/(".implode('|', $clientkeywords).")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if(isset($_SERVER['HTTP_ACCEPT'])){
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml')!==false)&&(strpos($_SERVER['HTTP_ACCEPT'], 'text/html')===false||(strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml')<strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
            return true;
        }
    }
    return false;
}

function isFromWeixin(){
    return isset($_SERVER['HTTP_USER_AGENT'])&&strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!==false?true:false;
}

function isIphone(){
    if(!isset($_SERVER['HTTP_USER_AGENT'])){
        return false;
    }
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if(strpos($agent, "iphone") || strpos($agent, "ipad")){
        return true;
    }
    return false;
}

function sourceDevice(){
    $useragent  = strtolower($_SERVER["HTTP_USER_AGENT"]);
    // iphone
    $is_iphone  = strripos($useragent,'iphone');
    if($is_iphone){
        return 'iphone';
    }
    // android
    $is_android    = strripos($useragent,'android');
    if($is_android){
        return 'android';
    }
    // 微信
    $is_weixin  = strripos($useragent,'micromessenger');
    if($is_weixin){
        return 'weixin';
    }
    // ipad
    $is_ipad    = strripos($useragent,'ipad');
    if($is_ipad){
        //return 'ipad';
        return 'iphone';
    }
    // ipod
    $is_ipod    = strripos($useragent,'ipod');
    if($is_ipod){
        //return 'ipod';
        return 'iphone';
    }
    // pc电脑
    $is_pc = strripos($useragent,'windows nt');
    if($is_pc){
        return 'pc';
    }
    return 'other';
}

// 处于默认分组
function isInDefautlGroup(){
    $group = getGroupName();
    if(!empty($group)){
        $group = strtolower($group);
        if(in_array($group, array("share","android", "gem","spread","spread.html","wap", "superadmin", "client", 'public_use', 'common','pad','tlogin', 'rushorder', 'spreadorder', 'resorder','api','mobile','market','kitchen'))){
            return false;
        }
    }
    return true;
}

//特殊url，不要进行wap跳转
function isInSpeciUrl(){
    $url = $_SERVER['REQUEST_URI'];
    $urlArray = array('|^/l(\d+)i(\d+)|','|^/share(\d+)|','|^/market|');
    foreach($urlArray as $v){
        if(preg_match($v,$url)){
            return true;
        }
    }
    return false;
}

// 是否跳转到wap站点
function isEnterWap(){
   if(isInSpeciUrl()){
       return false;
   }
   if(isInDefautlGroup()){
       return true;
   }
   return false;
}

function getAppName(){
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $sstmp = explode("/", $scriptName);
    return $sstmp[1];
}

// 获取当前项目分组名
//  返回 ‘’ 表示默认分组
// /android/index/user  -->android
// /index/user----> 'index'
// /food/index/user ---> 'index'
// /food/android/index/user ---->"android"
//  / ----->''
//  /?ee=ffff  ---->''
//  /food?eee=fff  ---->''
function getGroupName(){
    if(!empty($_SERVER['REQUEST_URI'])){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode("?", $uri);
        $path = $uri[0];
        $tmp = explode("/", $path);
        $curApp = getAppName();
        if(empty($tmp)||count($tmp)<2){
            return "";
        }else{
            if($tmp[1]==$curApp){
                if(!empty($tmp[2])){
                    return $tmp[2];
                }
                return "";
            }
            return $tmp[1];
        }
    }else{
        return "";
    }
}

//验证码验证
function isVerifyCorrect(){
    if(empty($_REQUEST['verify'])){
        return false;
    }
    $inVerfiy = $_REQUEST['verify'];
    $inVerfiy = strtoupper($inVerfiy);
    $verfiy = session('verify');
    if(md5($inVerfiy)==$verfiy){
        return true;
    }
    return false;
}

//获取真实IP
function getRealIp(){
    static $realip = NULL;
    if ($realip !== NULL)
    {
        return $realip;
    }
    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);
 
                if ($ip != 'unknown')
                {
                    $realip = $ip;
 
                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }
    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
    return $realip;
}

function writeLog($text) {
    file_put_contents ( "/data/www/Lovehou/code/Runtime/log.txt", date ( "Y-m-d H:i:s" ) . "  " . $text . "\r\n", FILE_APPEND );
}

//转换编码
function characet($data) {
    if (! empty ( $data )) {
        $fileType = mb_detect_encoding ( $data, array (
                'UTF-8',
                'GBK',
                'GB2312',
                'LATIN1',
                'BIG5'
        ) );
        if ($fileType != 'UTF-8') {
            $data = mb_convert_encoding ( $data, 'UTF-8', $fileType );
        }
    }
    return $data;
}

/**
 *
 * @param type $cate 日志分类 （方便筛选）
 * @param type $message 日志消息
 * @param type $level 日志级别
 */
function GLog($cate, $message)
{
    $msg = "($cate) $message";
    \Common\Model\CodeModel::Glog($msg);
}


//生成验证码
function verify()
{
    \Common\Model\ImagesModel::buildImageVerify(4, 1, "png");
}


//获取用户体型
function getUserShape($shape){
    switch($shape){
        case 1 : return '苗条';break;
        case 2 : return '匀称';break;
        case 3 : return '肌肉发达';break;
        case 4 : return '中等';break;
        case 5 : return '结实有型';break;
        case 6 : return '微胖';break;
        case 7 : return '魁梧';break;
        case 8 : return '丰满(性感/曲线动人)';break;
        default:return false;
    }
}

//获取用户体型
function getcontact($mainwink){
    switch($mainwink){
        case 1 : return '请查看我的个人简介，看看是否感兴趣联络我。如果您感兴趣请给我一个"传情"，我将会主动联络你！';break;
        case 2 : return '请在你的个人简介里贴上一张相片。或者授予金匙给我浏览私人相簿中的相片。谢谢。';break;
        case 3 : return '我收到你的讯息，我将会在升级会员套餐後尽快与你联络。';break;
        case 4 : return '你真正打动我的是...';break;
        case 5 : return '我迫不及待地想告诉你...';break;
        default:return false;
    }
}

//根据出生日期获取年龄
function getAge($birthday) {
    $age = 0;
    $year = $month = $day = 0;
    if (is_array($birthday)) {
        extract($birthday);
    } else {
        if (strpos($birthday, '-') !== false) {
            list($year, $month, $day) = explode('-', $birthday);
            $day = substr($day, 0, 2);
        }
    }
    $age = date('Y') - $year;
    if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--;
    return $age;
}

//根据年龄获取出生日期
function getBirthday($age) {
    return date('Y-m',strtotime("- $age year")).'-00';
}

//根据出生日期获取星座
function get_constellation($birthday){
    //判断的时候，为避免出现1和true的疑惑，或是判断语句始终为真的问题，这里统一处理成字符串形式
    list($birth_year,$birth_month,$birth_date) = explode('-',$birthday);
    $birth_month = strval($birth_month);
    $constellation_name = array(
        '水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座',
        '狮子座','处女座','天秤座','天蝎座)','射手座','摩羯座'
    );
    if ($birth_date <= 22){
        if ('1' !== $birth_month){
            $constellation = $constellation_name[$birth_month-2];
        }else{
            $constellation = $constellation_name[11];
        }
    } else{
        $constellation = $constellation_name[$birth_month-1];
    }
    return $constellation;
}

function getUsername($uid){
    $user = \Common\Model\UserModel::getUserById($uid);
    if($user){
        return $user['nickname'];
    }else{
        return false;
    }
}
?>