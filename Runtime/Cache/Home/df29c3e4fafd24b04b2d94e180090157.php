<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html class="no-js webkit safari chrome win"><head>

    <title>名叔堂-<?php echo ($user["nickname"]); ?></title>
    
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
    var URL="/Home/Member";
    var APP_PATH="";
    var PUBLIC = 'http://www.mingshut.com/Public';
    var STATIC = 'http://www.mingshut.com/Public/static';
    var UPLOAD = 'http://www.mingshut.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>



    <style>
        a:hover,a:active{text-decoration: none}
    </style>
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/page/css/icon.css?version=<?php echo version(3);?>"/>
<body marginwidth="0" marginheight="0"  style="background: #f6f8f8">
<?php $currentuser = Common\Model\UserModel::getUser();$currentuid=$currentuser['uid']; ?>
<header class="navbar public-pages" style="min-height: 35px;margin: 0">
    <div class="topbar navbar-default" style="border-bottom:#e7e7e7;">会员等级: <span class="fontb clo6">访客会员</span><span class="fr"><a href="/index/newinfo.html?id=5">说明</a>&nbsp;&nbsp;&nbsp;<a href="/login/logout.html">登出</a>&nbsp;&nbsp;</span><div class="clr"></div></div>
    <div class="" style="background: #FFffff;width: 100%">
        <div class="collapse maincontainer navbar-collapse ">
            <a href="/" class="fontb clo6" style="font-size: 50px;line-height: 65px;">
                名叔堂
            </a>
        </div>
    </div>
</header>
<header class="navbar navbar-default main-header public-pages" style="height: 40px;max-height: 40px;min-height: 40px;margin-bottom: 5px;">
    <div class="maincontainer main-nav">
        <ul id="menu" class="menu  text-center white">
            <li class="menuItem index"><a class="box-hpad box-pad-t inline selected" id="nav-search" target="main" href="/index/ulist.html"><span>搜寻</span></a></li>
            <li class="menuItem member"><a class="box-hpad box-pad-t inline" id="nav-manage-profile" target="main" href="/member/index.html"><span>简介管理</span></a></li>
            <li class="menuItem minfo"><a class="box-hpad box-pad-t inline" id="nav-view-profile" target="main" href="/member/info.html"><span>阅览简介</span></a></li>
            <li class="menuItem"><a class="box-hpad box-pad-t inline" id="nav-traveling" target="main" href="/index/topiclist.html"><span>文章论坛</span></a></li>
            <li class="menuItem"><a class="box-hpad box-pad-t inline" id="nav-richkept" target="main" href="/index/richkept.html"><span>悬赏</span></a></li>
        </ul>
    </div>
    <div class="clr"></div>
</header>
<script>
    $(function(){
        $('#menu li.menuItem a').removeClass('selected');
        var $pathname = (window.location.pathname).toLowerCase();
         (window.location.pathname).toLowerCase().indexOf('/member');
        if($pathname.indexOf('/member/info')>=0){
            $('#nav-view-profile').addClass('selected');
        }else if($pathname.indexOf('/member')>=0){
            $('#nav-manage-profile').addClass('selected');
        }else if($pathname.indexOf('/richkept')>=0){
            $('#nav-richkept').addClass('selected');
        }else if($pathname.indexOf('/topiclist')>=0){
            $('#nav-traveling').addClass('selected');
        }else{
            $('#nav-search').addClass('selected');
        }
    });
</script>
<div class="container page-content light-bg profile">
    <div class="box-center ">
        <div id="viewprofile_container" class="block box-pad-t">
            <div id="profileContainer" class="full-width">
                <div id="profileLeft" class="profileLeft pull-left">
                    <div>
                        <a href="/member/photos.html" title=" :: 将图片上载到您的简介页面或私人相簿。"  class="non-photo uploadpic male">
                            <img src="http://www.mingshut.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>" width="200" alt=""/>
                            <span class="tc clof" style="display: block;width: 200px;height: 35px;line-height: 35px;opacity: .8;position: relative; bottom: 35px;left: 0;background: #e43774;">上传相片</span>
                        </a>
                    </div>
                    <div class="profileDetailsBorder neighbour-top">
                        <div class="left-link-container">
                            <i class="material-icons md-dark md-18"></i>
                            <a class="profile-left-links font14" href="/member/index.html">编辑我的简介</a>
                        </div>
                    </div>
                </div>
                <div id="profileMiddle" class="pull-left profileMiddle ">
                    <div class="profileHeader">
                        <div>
                            <span class="collapse-margin display-name"><?php echo ($user["nickname"]); ?></span>
                            <a id="onlineStatus" href="#" data-toggle="tooltip" data-placement="bottom" class="middle inline neighbour status-online" title=" :: 此会员目前在线上。"></a>
                            <div id="caption" class="translate_me caption-msg" translated="no"><?php echo ($user["describe"]); ?></div>
                        </div>
                        <div></div>
                    </div>
                    <div class="no-border">
                        <ul class="profileDetails results-info neighbour-bottom">
                            <li><span class="profile-details-label">年龄: </span> <span class="profile-details-data"><?php echo getAge($user['birthdate']);?>岁(<?php echo get_constellation($user['birthdate']);?>)</span></li>
                            <li><span class="profile-details-label">位置: </span> <span class="profile-details-data"><?php echo getAreaByAid($user['proivce']);?>&nbsp;&nbsp;<?php echo getAreaByAid($user['city']);?></span></li>
                            <li><span class="profile-details-label">身高: </span> <span class="profile-details-data"><?php echo ($user['height']); ?>cm</span></li>
                            <li><span class="profile-details-label">体重: </span> <span class="profile-details-data"><?php echo ($user['weight']); ?>kg&nbsp;&nbsp;<?php echo getUserShape($user['shape']);?></span></li>
                            <li><span class="profile-details-label">性别: </span> <span class="profile-details-data"><?php if($user['sex'] == 1): ?>女士<?php else: ?>男士<?php endif; ?></span></li>
                        </ul>
                    </div>
                    <div class="thumbnails box-marg-t"></div>
                </div>

                <div class="clear"></div>
                <div class="profileInterest full-width " style="margin-top: 20px;">
                    <a href="/member/pairing.html" class="btn-link">通过增加您的简介 "甚麽真正打动我" 详细资料以获取通知。</a><br><br>
                    <a href="/member/hobby.html" class="btn-link">通过增加您的简介 "我在寻找甚麽" 详细资料以获取通知。</a><br><br>
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
</body>
</html>