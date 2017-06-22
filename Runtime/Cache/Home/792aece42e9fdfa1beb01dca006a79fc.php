<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="webkit safari chrome win">
<head>
    <title>名叔堂 | 登录</title>
    
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8">
<meta name="description" content="名叔堂">
<meta name="keywords" content="名叔堂">
<meta property="og:title" content="名叔堂">
<meta property="og:description" content="名叔堂">
<meta property="og:type" content="website">
<meta property="og:url" content="http://www.mingshut.com/">
<meta name="copyright" content="名叔堂. 2013-2017">
<meta name="type" content="adsvip.com">
<meta name="robots" content="index,follow">
<meta name="distribution" content="global">

<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/sweetalert.css"/>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/bootstrap/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/site-public.css"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/page/css/home.css?version=<?php echo version(2);?>"/>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/common/css/cent-ie7.css"/>
<![endif]-->
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.2.2.1.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.browser.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/jquery.cookies.2.2.0.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/common/js/common.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/bootstrap/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="http://www.mingshut.com/Public/static/page/js/home.js?1"></script>
<script type="text/javascript">
    var URL="/Home/Login";
    var APP_PATH="";
    var PUBLIC = 'http://www.mingshut.com/Public';
    var STATIC = 'http://www.mingshut.com/Public/static';
    var UPLOAD = 'http://www.mingshut.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <style>
        .col-centered {float: none;margin: 20px auto 120px; background: #f6f8f8;  width: 400px; height: auto; border-radius: 3px;box-shadow: 0 12px 15px 0 rgba(0,0,0,.3); }
        .smallprint { font-size: 12px; color: #454545;padding: 10px 0; text-align: center;width: 280px;margin-left: 50px; }
        .main-header .menu-nav-section .public-nav li a{font-size: 14px;;}
        select{font-weight: 400; color: #454545; border: 1px solid #b8c2cc;border-radius: 3px; background-color: #fff;width: 100%; height: 33px;font-size: 14px; font-family: Helvetica,Arial,sans-serif;}
        .submitBtn{display: block;color: #FFF;font-size: 14px; position: relative; width: 278px;height: 37px -moz-border-radius: 10px;  -webkit-border-radius: 10px; border-radius: 3px; cursor: pointer;border: 1px solid #1693D5; background: #1693D5; text-transform: uppercase;margin: 0 auto 10px 50px; text-indent: 0;}

        .landing-footer-section{position: relative; border-top: 1px solid #eee; padding: 0 0 0 20px ; bottom: 0; height: 100px; width: 100%;}
        .landing-footer-section span, .landing-footer-section .copyright-section p a , .landing-footer-section .footer-navs li a{font-size: 12px; font-family: Helvetica,Arial,sans-serif; font-weight: 100;color: #454545; margin-bottom: 8px;}
    </style>
</head>
<body>
<header class="navbar navbar-default main-header public-pages">
    <div class="menu-nav-section pull-right">
        <div class="navbar-collapse" id="main-public-nav">
            <ul class="nav navbar-nav public-nav pull-left">
                <li class="pull-left"><a href="/" title="首页">首页</a></li>
                <li class="pull-left"><a href="/login/register.html" title="注册">注册</a></li>
                <li class="pull-left"><a href="/index/newinfo.html?id=3" title="常见问题">常见问题</a></li>
                <li class="pull-left"><a href="/index/newinfo.html?id=1" rel="nofollow" title="联系我们">联系我们</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="main-content container">
    <div id="content" >
        <div class="content">
            <div class="col-centered  col-centered col-xs-5 login-extra-padding">
                <h1 class="text-center" style="padding-top: 10px;">登录</h1>
                <form role="form" onsubmit="return false;" id="loginform" name="lost-pass-form" class="forgotpwd-form">
                    <div class="form-group pure-g">
                        <label for="exampleInputUsername1">用户名</label>
                        <input type="text" class="form-control" name="username" id="exampleInputUsername1" />
                    </div>
                    <div class="form-group pure-g">
                        <label for="exampleInputPwd1">密码</label>
                        <input type="password" name="userpwd" class="form-control" id="exampleInputPwd1" />
                    </div>


                    <input type="submit" id="submitBtn" class="submitBtn" onclick="login();" value="登录">
                </form>
                <div class="smallprint">
                    <!--<p class="login-box-link text-center"><a href="">忘记用户名称或密码？</a></p>-->
                    <hr class="login-box-divider">
                    <a href="/login/register.html"><p class="btn btn-default" style="padding:6px 125px;">注册</p></a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="footer-private tc">
    <div class="content-960" style="margin-top: 15px">
        <a class="memberFooterLinks" href="/index/newinfo.html?id=3">条款和条件</a>
        <a class="memberFooterLinks" href="/index/newinfo.html?id=4">隐私政策</a>
        <!--<a class="memberFooterLinks" href="https://www.ashleymadison.com/app/private/contact.p?">回报不当使用</a>-->
        <a class="memberFooterLinks" href="/index/newinfo.html?id=1">联系我们</a>
        <p><span class="memberFooterCopyright force-ltr"> © 2013 - 2017  </span></p>
    </div>
</div>
<script src="http://www.mingshut.com/Public/static/common/js/jquery.lhgcalendar.min.js"></script>
<script>
    $('#exampleInputBirthdate1').calendar({
        format: 'yyyy-MM-dd',
        minDate: '%y-%M-%d',
        btnBar: false
    });
</script>
</body>
</html>