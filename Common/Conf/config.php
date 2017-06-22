<?php
$staticConfig = include 'static.php';
$selfConfig = include DEPLOY_ENV."/config.php";
//移动端验证（从移动端进入的自动跳转到移动页面）
if((isFromWeixin() || isMobile())){
    if(isEnterWap()){
        $staticConfig['DEFAULT_MODULE']= 'Wap';
    }
}
return array_merge($staticConfig,$selfConfig);
?>