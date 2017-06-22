<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="Robots" content="noindex,nofollow,noarchive" />
    <title>名叔馆--登录</title>
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
<!--<link rel="shortcut icon" type="image/x-icon" href="http://www.mingshut.com/Public/static/common/img/favicon.ico"/>-->
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/sweetalert.css"/>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/bootstrap/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/site-public.css"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/page/css/wap.landing.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/page/css/wap.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.2.2.1.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.browser.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.cookies.2.2.0.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/common.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/bootstrap/js/bootstrap-select.min.js"></script>
<!--<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>-->
<script type="text/javascript" src="http://www.mingshut.com/Public/static/page/js/wap.js?version=<?php echo version();?>"></script>
<script type="text/javascript">
    var URL="/Wap/Login";
    var PUBLIC = 'http://www.mingshut.com/Public';
    var STATIC = 'http://www.mingshut.com/Public/static';
    var UPLOAD = 'http://www.mingshut.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


<body pagename="login" style="overflow-x:hidden;">
<style>
    input[type=checkbox]{width: 15px;}
    header{background-color: #231f20;background-image: none;height:50px;line-height: 50px;}
</style>
<header class="relative tc font24"> 名叔馆</header>
<div class="container">
    <form role="form" id="loginbox" onsubmit="return false;">
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label><input type="text" name="username" class="form-control" id="exampleInputEmail1" />
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label><input type="password" name="password" class="form-control" id="exampleInputPassword1" />
        </div>
        <div class="checkbox">
            <label><input type="checkbox" class="relative" style="margin-top: -8px; margin-left: 0;" name="autologin" />记住登录</label>
            <span class="fr borderb-d tc font12 cloc"><a href="/login/reg.html">去注册！</a></span>
        </div>
        <a id="registerButtonMobile" href="javascript:void(0);" class="btn btn-ashley btn-large btn-fullwidth">登录</a>
        <!--<a id="goToLogin" href="/login/login.html" class="btn btn-large neighbour-top btn-fullwidth">忘记密码</a>-->
    </form>
</div>
<div data-role="footer" class="footer-public ui-footer tc" style="margin-top: 30px;padding: 5px 0" role="contentinfo">
    <div class="memberFooterCopyright force-ltr"> © 2013 - 2017.</div>
    <div class="memberFooterCopyright"> <a href="/" target="_top" class="ui-link">名叔馆 官方网站</a> </div>
    <div class="memberFooterCopyright">  </div>
</div>
<script>
    $('#registerButtonMobile').click(function(){
        $.post('/login/login', $('#loginbox').serialize(), function(data){
            if (data.code == 200) {
                clearpop(data.message,'',data.data);
            }else if (data.code == 205) { //賬號被禁用
                alert(data.message);
            }else{
                clearpopj(data.message);
            }
        });
    })
</script>
</body>
</html>