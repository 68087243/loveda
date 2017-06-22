<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="Robots" content="noindex,nofollow,noarchive" />
    <title>名叔馆--注册</title>
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



</head>
<body pagename="reg">
<style>
    header{background-color: #231f20;background-image: none;height:50px;line-height: 50px;}
</style>
<header class="relative tc font24"> 名叔馆</header>
<div class="container bodyf">
    <form role="form" id="regbox" class="clo3" style="margin-top: 10px;" onsubmit="return false;">
        <!--<div id="box_1">-->
            <!--<div class="form-group tc" style="margin-bottom: 0">-->
                <!--<ul class="relative" style="line-height: 41px; top: 10px;">-->
                    <!--<li class="fl"><label for="radio1" class="clo6"><input type="radio" id="radio1" name="sex" value="1"/>我是女生</label></li>-->
                    <!--<li class="fl"><label for="radio2" class="clo6"><input type="radio" id="radio2" name="sex" value="2"/>我是男生</label></li>-->
                <!--</ul>-->
            <!--</div>-->
            <!--<div class="font12 orange relative fr" id="sextit" style="top: -20px;right: 30px;display: none">选择后不可更改</div>-->
            <div class="form-group">
                <span class="fontb">用户名</span><input type="text" name="nickname" class="form-control"  />
            </div>
            <div class="form-group">
                <span class="fontb">密码</span><input type="password" name="password" placeholder="5-18个字符" class="form-control"  />
            </div>
            <div class="form-group">
                <span class="fontb">确认密码</span><input type="password" name="repassword" placeholder="重复上面的密码" class="form-control"  />
            </div>
            <div class="form-group">
                <span class="fontb">性别</span>
                <div>
                    <select name="sex" id="sex">
                        <option value="1">女生</option>
                        <option value="2">男生</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <span class="fontb">邮箱</span><input type="text" name="email" placeholder="请输入你的邮箱"  class="form-control"  />
            </div>
            <div class="form-group">
                <span class="fontb">QQ</span><input type="text" name="qqid" placeholder="请输入你的QQ"  class="form-control"  />
            </div>
            <div class="form-group">
                <span class="fontb">城市</span>
                <div>
                    <select name="priovce" id="priovce" class="fl" style="width: 49%;" onchange="checkeSupsort($(this).val(), $('#regbox select[name=city]'));">
                        <option value="">请选择省</option>
                        <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select name="city" class="fl" id="city" style="width: 49%;">
                        <option value="">请选择城市</option>
                    </select>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="form-group">
                <span class="fontb">微信</span><input type="text" name="qqid" placeholder="请输入你的微信号"  class="form-control"  />
            </div>
            <div class="form-group">
                <div class="next_btn tc clof" onclick="subReg();">注册</div>
            </div>
            <div class="checkbox  font12 cloc">
                <span style="margin-left: 10%;display: none" onclick="$('#box_2').addClass('hide');$('#box_1').removeClass('hide');$(this).hide();" id="up">&lt;&lt;上一步</span>
                <span class="fr borderb-d tc "><a href="/login/login.html"><span class="clo9">已有账号,</span>去登录</a>！</span>
                <div class="clr"></div>
            </div>
    </form>
</div>
<div data-role="footer" class="footer-public ui-footer tc" style="padding: 5px 0" role="contentinfo">
    <div class="memberFooterCopyright force-ltr"> © 2013 - 2017.</div>
    <div class="memberFooterCopyright"> <a href="/" target="_top" class="ui-link">名叔馆 官方网站</a> </div>
    <div class="memberFooterCopyright">  </div>
</div>
<script>
//    $("#regbox").idealforms();
//    $('.idealforms_select_menu').css({'max-height': '120px'});

    /*阻塞标志，防止重复提交；预设不阻塞*/
    window.subBlock=false;
    function subReg(){
        if(subBlock){
            return false;
        }
        if(!$('#regbox input[name=nickname]').val()){
            clearpop('请输入用户名');
            $('#regbox input[name=nickname]').focus();
            subBlock = false;
            return false;
        }
        var password = $('#regbox input[name=password]').val();
        if(!password){
            clearpop('请输入密码');
            $('#regbox input[name=password]').focus();
            subBlock = false;
            return false;
        }
        if(password.length <4){
            clearpop('密码位数不能小于4');
            $('#regbox input[name=password]').focus();
            subBlock = false;
            return false;
        }
        if(password != $('#regbox input[name=repassword]').val()){
            clearpop('两次密码输入不一致');
            $('#regbox input[name=repassword]').focus();
            subBlock = false;
            return false;
        }
        var $email = $('#regbox input[name=email]').val()
        if($email && !regex($email,'email')){
            clearpop('邮箱格式不正确');
            $('#regbox input[name=email]').focus();
            subBlock = false;
            return false;
        }
        subBlock = true;
        $.post('/login/reg', $('#regbox').serialize(), function(data){
            subBlock = false;
            if (data.code == 200) {
                clearpop(data.message,'',data.data);
            }else{
                clearpopj(data.message);
            }
        });
    }
</script>
</body>
</html>