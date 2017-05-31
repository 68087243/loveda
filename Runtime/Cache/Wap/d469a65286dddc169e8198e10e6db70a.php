<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="Robots" content="noindex,nofollow,noarchive" />
    <title>爱大叔--<?php echo ($user["nickname"]); ?></title>
    
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
    var URL="/Wap/User";
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

<div class="space_porfile">
    <div class="user_noavatar tc" <?php if(isset($user['uid']) && $user['uid']): ?>onclick="window.location.href='/user/info.html?uid=<?php echo ($user['uid']); ?>'"<?php endif; ?>>
        <img id="picture" src="http://www.lovehou.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>" class="user_noavatar_img"/>
    </div>
    <div class="user_name clof font16 tc"><span><?php echo ($user["nickname"]); ?></span>&nbsp;

        <a href="" class="level level_1 clof" tab="usergroup">
            <span>L1</span><em class="size_x" style="">新手上路</em>
        </a>
    </div>
</div>
<div class="line10"></div>
<div class="topqlin ">
    <ul class="tc">
        <li class="tq_favorite fl" onclick="window.location.href='/user/favorite.html'">
            <img src="http://www.lovehou.com/Public/static/image/page/w_user/compose.png" alt=""/>
            <div class="clo9">收藏</div>
        </li>
        <li class="tq_notice fl">
            <img src="http://www.lovehou.com/Public/static/image/page/w_user/message.png" alt=""/>
            <div class="clo9 relative">短消息 <?php if($msgrow['chat'] > 0): ?><span class="badge pull-right absolute" style="right: 1px;top: -5px"><?php echo ($msgrow["chat"]); ?></span><?php endif; ?></div>
        </li>
        <li class="tq_notice fl" onclick="window.location.href='/user/message.html'">
            <img src="http://www.lovehou.com/Public/static/image/page/w_user/news.png" alt=""/>
            <div class="clo9 relative">提醒<?php if($msgrow['tit'] > 0): ?><span class="badge pull-right absolute" style="right:1px;top: -5px"><?php echo ($msgrow["tit"]); ?></span><?php endif; ?></div>
        </li>
        <li class="tq_setting fl">
            <img src="http://www.lovehou.com/Public/static/image/page/w_user/set_leading.png" alt=""/>
            <div class="clo9">设置</div>
        </li>
    </ul>
</div>
<div class="clr line10"></div>
<div class="line10"></div>
<div class="user_item">
    <ul class="container">
        <li onclick="window.location.href='/user/setup.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_hearts_b.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;个人设置</li>
        <li onclick="window.location.href='/user/info.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_spades_r.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;个人信息</li>
        <li onclick="window.location.href='/user/setup.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_hearts_g.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;活动</li>
        <li onclick="window.location.href='/user/photo.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_diamonds_g.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;照片</li>
        <li onclick="window.location.href='/user/utopic.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_diamonds.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;帖子</li>
        <li onclick="window.location.href='/user/friends.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_hearts.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;好友</li>
    <!--    <li onclick="window.location.href='/user/setup.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_spades_g.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;评论
            <span class="badge pull-right " style="position: relative;top: 10px;"><?php echo ($msgrow["topic"]); ?></span>
        </li>-->
        <li onclick="window.location.href='/user/guestbook.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_user/card_diamonds_b.png" width="23" alt=""/>&nbsp;&nbsp;&nbsp;留言</li>
    </ul>
</div>
</body>
</html>