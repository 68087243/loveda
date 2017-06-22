<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="webkit safari chrome win">
<head>
    <title>名叔馆 | 注册</title>
    
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8">
<meta name="description" content="名叔馆">
<meta name="keywords" content="名叔馆">
<meta property="og:title" content="名叔馆">
<meta property="og:description" content="名叔馆">
<meta property="og:type" content="website">
<meta property="og:url" content="http://www.mingshut.com/">
<meta name="copyright" content="名叔馆. 2013-2017">
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
    var URL="/Home/Index";
    var APP_PATH="";
    var PUBLIC = 'http://www.mingshut.com/Public';
    var STATIC = 'http://www.mingshut.com/Public/static';
    var UPLOAD = 'http://www.mingshut.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <style>
        .main-header .menu-nav-section .public-nav li a{font-size: 14px;;}
        .landing-footer-section{position: relative; border-top: 1px solid #eee; padding: 0 0 0 20px ; bottom: 0; height: 100px; width: 100%;}
        .landing-footer-section span, .landing-footer-section .copyright-section p a , .landing-footer-section .footer-navs li a{font-size: 12px; font-family: Helvetica,Arial,sans-serif; font-weight: 100;color: #454545; margin-bottom: 8px;}
    </style>
</head>
<body style="background: #f6f8f8">
<header class="navbar navbar-default main-header public-pages">
    <div class="menu-nav-section pull-right">
        <div class="navbar-collapse" id="main-public-nav">
            <ul class="nav navbar-nav public-nav pull-left">
                <li class="pull-left"><a href="/" title="首页">首页</a></li>
                <li class="pull-left"><a href="/login/index.html" title="登录">登录</a></li>
                <li class="pull-left"><a href="/index/newinfo.html?id=3" title="常见问题">常见问题</a></li>
                <li class="pull-left"><a href="/index/newinfo.html?id=1" rel="nofollow" title="联络我们">联络我们</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="main-content container" style="min-height: 559px;">
    <div id="content">
        <div id="container" class="box-pad-lg light-bg">
            <?php if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'sm'): ?><div style="height: 50px;line-height: 50px;text-indent: 10px;" class="font24"><?php echo ($info["title"]); ?><span class="font12 clo9">&nbsp;&nbsp;<?php echo ($info["createtime"]); ?></span></div>
                <div><?php echo ($info["message"]); ?></div>
            <?php else: ?>
                <div style="height: 50px;line-height: 50px;text-indent: 10px;" class="font24"><?php echo ($info["title"]); ?><span class="font12 clo9">&nbsp;&nbsp;<?php echo ($info["addtime"]); ?></span></div>
                <div><?php echo (htmlspecialchars_decode($info["content"])); ?></div>
                <!--<p><span class="font14 clo3">阅读：<?php echo ($info["hits"]); ?></span></p>--><?php endif; ?>
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
</body>
</html>