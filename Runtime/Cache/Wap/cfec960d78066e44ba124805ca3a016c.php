<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="no-js webkit safari safari9 iphone">
<head>
    <title>名叔馆</title>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="app-mobile-web-app-title" content="名叔馆">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1, user-scalable=no" media="(device-height: 568px)">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!--<link rel="shortcut icon" type="image/x-icon" href="http://www.adsvip.cn/Public/static/common/img/favicon.ico"/>-->
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/sweetalert.css"/>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/bootstrap/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/site-public.css"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/page/css/wap.landing.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/page/css/wap.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.2.2.1.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.browser.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.cookies.2.2.0.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/common.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/bootstrap/js/bootstrap-select.min.js"></script>
<!--<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>-->
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/page/js/wap.js?version=<?php echo version();?>"></script>
<script type="text/javascript">
    var URL="/Wap/Index";
    var PUBLIC = 'http://www.adsvip.cn/Public';
    var STATIC = 'http://www.adsvip.cn/Public/static';
    var UPLOAD = 'http://www.adsvip.cn/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body>
<div class="public mobile-content">
    <div id="staticLandingPage" class="startup">
        <header class="logoHeight" id="headerContainer" style="">
            <div class="backTransparent logoHeight" id="backLayer"></div>
            <div class="backLogo logoHeight" id="logoBack" style="">
                <span class="font24 relative clof" style="top: 15px;">名叔馆</span>
                <small id="tagLineText" class="clof tagline center " style="">寻找心动瞬间</small></div>
        </header>
        <div class="center neighbour-top" id="centerImg" style="">
            <div id="mainImgContainer" class="hero-image-wrapper inline position-relative" style="width: auto">
                <img id="mainImg" class="top-minus-6" src="http://www.adsvip.cn/Public/static/image/page/home/indexbg2.jpg" style="height: 446px;">
            </div>
        </div>
        <div id="landingView">
            <div id="buttonSection">
                <div id="memberText" class="center side-padding">超过 53,175,000 会员*</div>
                <div class="side-padding center neighbour-top">
                    <div id="promoteSignup" class="">
                        <a id="registerButtonMobile" href="/login/reg.html" class="btn btn-ashley btn-large btn-fullwidth">免费加入</a>
                        <a id="goToLogin" href="/login/login.html" class="btn btn-large neighbour-top btn-fullwidth">登入</a>
                    </div>
                </div>
                <div><p class="disclaimer member-legal">*自2002年起加入名叔馆的会员数量。</p></div>
            </div>
            <form id="nextLoginForm" action="/n/" method="post"><input id="access_token" type="hidden" name="access_token"></form>
        </div>
    </div>
</div>



</body>
</html>