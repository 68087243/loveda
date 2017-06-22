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
<meta property="og:url" content="http://www.adsvip.cn/">
<meta name="copyright" content="名叔馆. 2013-2017">
<meta name="type" content="adsvip.com">
<meta name="robots" content="index,follow">
<meta name="distribution" content="global">

<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/sweetalert.css"/>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/bootstrap/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/site-public.css"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/page/css/home.css?version=<?php echo version(2);?>"/>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="http://www.adsvip.cn/Public/static/common/css/cent-ie7.css"/>
<![endif]-->
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.2.2.1.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.browser.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/jquery.cookies.2.2.0.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/common/js/common.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/bootstrap/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="http://www.adsvip.cn/Public/static/page/js/home.js?1"></script>
<script type="text/javascript">
    var URL="/Home/Login";
    var APP_PATH="";
    var PUBLIC = 'http://www.adsvip.cn/Public';
    var STATIC = 'http://www.adsvip.cn/Public/static';
    var UPLOAD = 'http://www.adsvip.cn/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <style>
        .col-centered {float: none;margin: 20px auto 120px; background: #f6f8f8;  width: 450px; height: auto; border-radius: 3px;box-shadow: 0 12px 15px 0 rgba(0,0,0,.3); }
        .smallprint { font-size: 12px; color: #454545;padding: 10px 0 0; text-align: center;width: 280px;margin-left: 77px; }
        .main-header .menu-nav-section .public-nav li a{font-size: 14px;;}
        select{font-weight: 400; color: #454545; border: 1px solid #b8c2cc;border-radius: 3px; background-color: #fff;width: 100%; height: 33px;font-size: 14px; font-family: Helvetica,Arial,sans-serif;}
        .submitBtn{display: block;color: #FFF;font-size: 14px; position: relative; width: 278px;height: 37px -moz-border-radius: 10px;  -webkit-border-radius: 10px; border-radius: 3px; cursor: pointer;border: 1px solid #1693D5; background: #1693D5; text-transform: uppercase;margin: 0 auto 10px 77px; text-indent: 0;}

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
                <li class="pull-left"><a href="/login/index.html" title="登录">登录</a></li>
                <li class="pull-left"><a href="/index/newinfo.html?id=3" title="常见问题">常见问题</a></li>
                <li class="pull-left"><a href="/index/newinfo.html?id=1" rel="nofollow" title="联络我们">联络我们</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="main-content container">
    <div id="content" >
        <div class="content">
            <div class="col-centered  col-centered col-xs-5 login-extra-padding">
                <h1 class="text-center" style="padding-top: 10px;">注册</h1>
                <form role="form" onsubmit="return false;" id="myform" name="lost-pass-form" class="forgotpwd-form">
                    <div class="form-group pure-g">
                        <label for="exampleInputUsername1">用户名</label>
                        <input type="text" class="form-control" name="account" placeholder="用于网站登录" id="exampleInputUsername1" />
                    </div>
                    <div class="form-group pure-g">
                        <label for="exampleInputPwd1">密码</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPwd1" />
                    </div>
                    <div class="form-group pure-g">
                        <label for="exampleInputCode1">邮递区号</label>
                        <input type="text" class="form-control" name="zip_code" id="exampleInputCode1" />
                    </div>
                    <div class="form-group pure-g">
                        <label for="exampleInputIntroduce1">签名介绍</label>
                        <input type="text" class="form-control" name="describe" id="exampleInputIntroduce1" />
                    </div>
                    <div class="form-group pure-g">
                        <label for="height">性别</label>
                        <select id="sex" name="sex" class=" ">
                            <option value="0">请选择</option>
                            <option value="-1">-------------------------</option>
                            <option value="1">女</option>
                            <option value="2">男</option>
                        </select>
                    </div>
                    <div class="form-group pure-g">
                        <label for="exampleInputBirthdate1">出生日期</label>
                        <input type="text" class="form-control" name="birthdate" id="exampleInputBirthdate1" />
                    </div>
                    <div class="form-group pure-g">
                        <label for="height">身高</label>
                        <select id="height" name="height" class=" ">
                            <option value="0">请选择</option>
                            <option value="-1">-------------------------</option>
                            <?php
 for($i=125;$i<220;$i++){ ?>
                            <option value="<?php echo ($i); ?>"><?php echo ($i); ?>cm</option>

                            <?php
 } ?>
                        </select>
                    </div>
                    <div class="form-group pure-g">
                        <label for="weight">体重</label>
                        <select id="weight" name="weight">
                            <option value="0">请选择</option>
                            <option value="-1">-------------------------</option>
                            <?php
 for($i=36;$i<140;$i++){ ?>
                            <option value="<?php echo ($i); ?>"><?php echo ($i); ?>kg</option>

                            <?php
 } ?>
                        </select>
                    </div>
                    <div class="form-group pure-g">
                        <label for="shape">体型</label>
                        <select id="shape" name="shape">
                            <option value="0">请选择</option>
                            <option value="-1">-----</option>
                            <option value="1">苗条</option>
                            <option value="2">匀称</option>
                            <option value="3">肌肉发达</option>
                            <option value="4">平均/中等</option>
                            <option value="5">结实有型</option>
                            <option value="6">微胖</option>
                            <option value="7">魁梧</option>
                            <option value="8">丰满(性感/曲线动人)</option>
                        </select>
                    </div>
                    <div class="smallprint">
                        我确认我已经年满18岁并已阅读及同意 名叔馆 的<a href="/app/public/privacy.p" target="_blank">隐私政策</a> 和 <a href="/app/public/tandc.p" target="_blank">条款和条件</a>.
                    </div>
                    <input type="submit" id="submitBtn" class="submitBtn" value="注册">
                </form>
                <div class="smallprint">
                    <p>adsvip.cn将定期通知您所在地区的潜在或新的配对和任何您可能会感兴趣的服务更新。</p>
                    <br><p>我们不执行任何犯罪背景调查</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-private tc">
    <div class="content-960" style="margin-top: 15px">
        <a class="memberFooterLinks" href="/index/newinfo.html?id=3">条款和条件</a>
        <a class="memberFooterLinks" href="/index/newinfo.html?id=4">隐私政策</a>
        <a class="memberFooterLinks" href="https://www.ashleymadison.com/app/private/contact.p?">回报不当使用</a>
        <a class="memberFooterLinks" href="/index/newinfo.html?id=2">联系我们</a>
        <p><span class="memberFooterCopyright force-ltr"> © 2013 - 2017  </span></p>
    </div>
</div>
<script src="http://www.adsvip.cn/Public/static/common/js/jquery.lhgcalendar.min.js"></script>
<script>
    $('#exampleInputBirthdate1').calendar({
        format: 'yyyy-MM-dd',
        minDate: '%y-%M-%d',
        btnBar: false
    });
    /*阻塞标志，防止重复提交；预设不阻塞*/
    window.subBlock=false;
    function reg(){
        if(subBlock){
            return false;
        }
        var account = $('#myform input[name=account]').val();
        var password = $('#myform input[name=password]').val();
        var zip_code = $('#myform input[name=zip_code]').val();
        var describe = $('#myform input[name=describe]').val();
        var height = $('#myform select[name=height]').val();
        var weight = $('#myform select[name=weight]').val();
        var shape = $('#myform select[name=shape]').val();
        if(!account){
            $('#myform input[name=account]').focus();
            clearpop('请填写用户名');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!password){
            $('#myform input[name=password]').focus();
            clearpop('请输入你的密码');
            subBlock = false;//解除阻塞
            return false;
        }
        if(password.length<5||password.length>18){
            $('#myform input[name=password]').focus();
            clearpop('密码长度应为4-18位');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!zip_code){
            clearpop('请输入的你邮编地址！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!height){
            clearpop('请选择你的身高！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!weight){
            clearpop('请选择你的体重！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!shape){
            clearpop('请选择你的体型！');
            subBlock = false;//解除阻塞
            return false;
        }
        subBlock = true;//阻塞
        var $data = $("#myform").serialize();
        $.post('/login/reg.html', $data, function (data) {
            subBlock = false;//解除阻塞
            if (data.code == 200) {
                clearpop(data.message,'','/index/ulist.html');
            } else {
                clearpop(data.message);
            }
        })
    }
</script>
</body>
</html>