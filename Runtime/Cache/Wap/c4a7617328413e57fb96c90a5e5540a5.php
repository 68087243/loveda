<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    
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
    var URL="/Wap/Index";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body>
    <div class="header clearfix">
    <ul class=" top-head">
        <li class="avatar fl" <?php if(!empty($user)): ?>onclick="window.location.href='/user/index.html'"<?php else: ?> onclick="window.location.href='/login/login.html'"<?php endif; ?> >
            <img id="picture" src="http://www.lovehou.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>" class="user_noavatar_img"/>
        </li>
        <li class="tc fl top-htit">
            <span class="fontb font24">爱大叔</span>
        </li>
        <li class="fl search_ico" onclick="window.location.href='/index/search.html'">
            <span class="search_ico_1">
            <span class="search_ico_2">
            </span>
            </span>
        </li>
    </ul>
    <div class="clr"></div>
</div>
<div style="height: 50px;"></div>

    <div class="top-nav">
        <ul class="tc">
            <?php if(is_array($club)): $i = 0; $__LIST__ = $club;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li onclick="window.location.href='/index/infolist.html?cid=<?php echo ($vo["cid"]); ?>'"><?php echo ($vo["clubname"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="clr"></div>
    <div class="clearfix borderb-d bordert-d">
        <div class="column">
            <div class="carousel slide" id="carousel-991335">
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel-991335">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-991335">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-991335">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="" src="http://www.lovehou.com/Public/static/image/b1.png" />
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.lovehou.com/Public/static/image/b1.png" />
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.lovehou.com/Public/static/image/b1.png" />
                    </div>
                </div>
                <a class=" hide carousel-control" href="#carousel-991335" id="next" data-slide="next"></a>
            </div>
        </div>
    </div>
    <div class="area_item borderb-d">
        <ul class="tc">
            <?php if(is_array($proivce)): $i = 0; $__LIST__ = $proivce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i == 1): ?><li onclick="window.location.href='/index/infolist.html?aid=<?php echo ($vo["aid"]); ?>'"><img src="http://www.lovehou.com/Public/static/image/page/w_index/music.png" width="40" alt=""/><div><?php echo ($vo["name"]); ?></div></li>
                    <?php elseif($i == 2): ?>
                    <li onclick="window.location.href='/index/infolist.html?aid=<?php echo ($vo["aid"]); ?>'"><img src="http://www.lovehou.com/Public/static/image/page/w_index/note.png" width="40" alt=""/><div><?php echo ($vo["name"]); ?></div></li>
                    <?php elseif($i == 3): ?>
                    <li onclick="window.location.href='/index/infolist.html?aid=<?php echo ($vo["aid"]); ?>'"><img src="http://www.lovehou.com/Public/static/image/page/w_index/chat.png" width="40" alt=""/><div><?php echo ($vo["name"]); ?></div></li>
                    <?php elseif($i == 4): ?>
                    <li onclick="window.location.href='/index/infolist.html?aid=<?php echo ($vo["aid"]); ?>'"><img src="http://www.lovehou.com/Public/static/image/page/w_index/yes.png" width="40" alt=""/><div><?php echo ($vo["name"]); ?></div></li>
                    <?php elseif($i == 5): ?>
                    <li onclick="window.location.href='/index/infolist.html?aid=<?php echo ($vo["aid"]); ?>'"><img src="http://www.lovehou.com/Public/static/image/page/w_index/picture.png" width="40" alt=""/><div><?php echo ($vo["name"]); ?></div></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="line10"></div>
    <div class="recommend bordert-d ">
        <div class="r_title fontb font16 borderb-d">推荐图片 <span class="fr">...</span></div>
        <div class="r_box container">
            <div class="r-b-l fl r-b"><img src="http://www.lovehou.com/Public/static/image/b2.png" alt=""/></div>
            <div class="r-b-r fr r-b"><img src="http://www.lovehou.com/Public/static/image/b3.png" alt=""/></div>
        </div>
        <div class="clr"></div>
    </div>
    <link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="footer bordert-d">
    <ul style="position: relative;z-index: 10000">
        <li onclick="window.location.href='/'" class="foot_home home_ico tc">
            <span class="home_b_ico1 home_ico1">
            <span class="home_b_ico2 home_ico2"></span>
            </span>首页
        </li>
        <li onclick="window.location.href='/index/rlist.html'" class="foot_chat"><img src="http://www.lovehou.com/Public/static/image/page/w_index/chat_b.png" class="f_ico"  alt=""/><div>论坛</div></li>
        <li class="foot_center" onclick="window.location.href='/user/index.html'" ><img src="http://www.lovehou.com/Public/static/image/page/w_index/compass.png" style="position: relative;top: -10px;" width="80" alt=""/></li>
        <li class="foot_flower" onclick="window.location.href='/index/richkept.html'"><img src="http://www.lovehou.com/Public/static/image/page/w_index/flower_b.png" class="f_ico"  alt=""/><div>富豪包养</div></li>
        <li class="foot_vip"><img src="http://www.lovehou.com/Public/static/image/page/w_index/group_b.png" class="f_ico"  alt=""/><div>加入VIP</div></li>
    </ul>
    <div class="foot-arc"></div>
</div>
<script>
    $(function(){
        var pathinfo =(window.location.pathname).toLowerCase();
        if(pathinfo=='/index/' || pathinfo=='/index' || pathinfo.length < 3){
            $('.foot_home .home_ico1').removeClass('home_b_ico1');
            $('.foot_home .home_ico1').addClass('home_r_ico1');
            $('.foot_home .home_ico2').removeClass('home_b_ico2');
            $('.foot_home .home_ico2').addClass('home_r_ico2');
            $('.footer .foot_home div').addClass('dred');
        }else if(pathinfo.indexOf('rlist')>0 || pathinfo.indexOf('topic')>0){
            $('.footer .foot_chat img').attr('src',STATIC+'/image/page/w_index/chat_r.jpg');
            $('.footer .foot_chat div').addClass('dred');
        }else if((pathinfo.indexOf('cart'))>0 || (pathinfo.indexOf('shop'))>0 || (pathinfo.indexOf('cashier'))>0){

        }else{

        }
    })
</script>
    <script>
        $(function(){
            $('.recommend .r_box img').attr('width',$('.recommend .r_box .r-b').width());
        })
        setInterval(function(){ $('#next').click();},3000);
    </script>
</body>
</html>