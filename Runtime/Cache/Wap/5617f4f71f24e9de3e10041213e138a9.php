<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="Robots" content="noindex,nofollow,noarchive" />
    <title>爱大叔--登录</title>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<!--<link rel="shortcut icon" type="image/x-icon" href="http://www.lovehou.com/Public/static/common/img/favicon.ico"/>-->
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/bootstrap/css/bootstrap.min.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/wap.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.2.2.1.min.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/bootstrap/js/bootstrap.min.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/common.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/page/js/wap.js?version=<?php echo version();?>"></script>
<script type="text/javascript">
    var URL="/Wap/Login";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


<body pagename="login" style="overflow-x:hidden;">
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="clearfix header">
    <ul class="user_header top-head container">
        <li class="fl" onclick="window.history.back(-1)"><span class="back"></span></li>
        <li class="tc fl top-htit">
            <span class="font24 clof"><?php echo ((isset($headtitle) && ($headtitle !== ""))?($headtitle):'个人中心'); ?></span>
        </li>
        <li class="fr" onclick="openside();"><span class="menu"></span></li>
    </ul>
    <div class="clr"></div>
</div>
<div style="height: 50px;"></div>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="imui_side b_f" onclick="openside();">
    <div class="side_user font14 clof cl">
        <?php if(!empty($user)): ?><a href="/user/index.html" >
                <?php if($user['picture']): ?><img src="http://www.lovehou.com/Public/<?php echo ($user['picture']); ?>">
                    <?php else: ?>
                    <img src="http://www.lovehou.com/Public/static/image/noavatar_middle.gif"><?php endif; ?>
            </a>
            <h3 class="font16"><?php echo ($user["nickname"]); ?></h3>
            <p><a href="/login/logout.html" class="clof fr font12">退出</a></p>
            <?php else: ?>
            <p class="font18"><a href="/login/login.html" style="text-decoration: inherit" class="clof fr font20">请登录</a></p><?php endif; ?>
    </div>
    <div class="side_nv size_16">
        <ul id="sidearea">
            <li>
                <a href="/">
                    <div class="font16 fontb">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_home.png" width="40" style="margin-left: 10px;" />
                        <span class="relative s_rowname" >首页</span>
                    </div>
                    <div class="clr "></div>
                </a>
            </li>
            <li>
                <a href="/">
                    <div class="font16 fontb">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_chat.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >论坛</span>
                    </div>
                </a>
            </li>
            <li>
                <?php if($user['sex'] == 1): ?><a href="/index/rlist.html?cid=1">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/f_boy.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >找大叔</span>
                    </a>
                <?php else: ?>
                    <a href="/index/rlist.html?cid=2">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_girl.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >找萝莉</span>
                    </a><?php endif; ?>
            </li>
            <li>
                <a href="/">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_service.png" width="40" style="margin-left: 10px;"/>
                    <span class="relative s_rowname" >服务指南</span>
                </a>
            </li>
            <li>
                <a href="/">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_index/aboutus.png" width="40" style="margin-left: 10px;"/>
                    <span class="relative s_rowname" >联系我们</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="imui_sidebg" onclick="openside();"></div>

<div class="container">
    <form role="form" id="loginbox" onsubmit="return false;">
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label><input type="text" name="username" class="form-control" id="exampleInputEmail1" />
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label><input type="password" name="password" class="form-control" id="exampleInputPassword1" />
        </div>
        <div class="checkbox">
            <label><input type="checkbox" style="position: relative;top: 2px;" name="autologin" />记住登录</label>
            <span class="fr borderb-d tc font12 cloc"><a href="/login/reg.html">去注册！</a></span>
        </div>
        <button type="submit" class="btn fr btn-default">登录</button>
    </form>
</div>
<script>
    $('#loginbox').submit(function(){
        $.post('/login/login', $('#loginbox').serialize(), function(data){
            if (data.code == 200) {
                clearpop(data.message,'','/');
            }else if (data.code == 205) { //賬號被禁用
                alert(data.message);
            }else{
                clearpop(data.message);
            }
        });
    })
</script>
</body>
</html>