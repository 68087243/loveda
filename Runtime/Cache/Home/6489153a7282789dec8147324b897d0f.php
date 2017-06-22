<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="webkit safari chrome win">
<head>
    <title>名叔馆</title>
    
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


    <link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/page/css/icon.css?version=<?php echo version(3);?>"/>
</head>
<body style="background: #f6f8f8">
<?php $currentuser = Common\Model\UserModel::getUser();$currentuid=$currentuser['uid']; ?>
<header class="navbar public-pages" style="min-height: 35px;margin: 0">
    <div class="topbar navbar-default" style="border-bottom:#e7e7e7;">会员等级: <span class="fontb clo6">访客会员</span><span class="fr"><a href="/index/newinfo.html?id=5">说明</a>&nbsp;&nbsp;&nbsp;<a href="/login/logout.html">登出</a>&nbsp;&nbsp;</span><div class="clr"></div></div>
    <div class="" style="background: #FFffff;width: 100%">
        <div class="collapse maincontainer navbar-collapse ">
            <a href="/" class="fontb clo6" style="font-size: 50px;line-height: 65px;">
                名叔馆
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
        }else{
            $('#nav-search').addClass('selected');
        }
    });
</script>
<div class="go-to-z-top fix-top-left simple-box-filled box-pad-xsm box-bdr-b text-center" style="background: #f6f8f8;border-bottom: 2px solid #D9D9D9">
    <form id="frmQuickSearch2" name="frmQuickSearch2" action="" method="POST" target="main" class=''>
        <input type="hidden" name="sid" value="">
        <input type="hidden" name="" value="1">
            <span id="tdAgeMin">
                <select class="selectpicker col-1 search-select" name="age-s">
                    <?php
 for($i=18;$i<70;$i++){ ?>
                    <option value="<?php echo ($i); ?>"<?php if($_REQUEST['age-s'] == $i): ?>selected<?php endif; ?>><?php echo ($i); ?></option>
                    <?php
 } ?>
                    <option value="70" <?php if($_REQUEST['age-s'] == 70): ?>selected<?php endif; ?>>70+</option>
                </select>
            </span>
        <span class="inline searchText">到</span>
        <span id="tdAgeMax">
             <select class="selectpicker col-1 search-select" name="age-e">
                 <?php
 for($i=18;$i<70;$i++){ ?>
                 <option value="<?php echo ($i); ?>" <?php if($_REQUEST['age-e'] == $i): ?>selected<?php endif; ?>><?php echo ($i); ?></option>
                 <?php
 } ?>
                 <option value="70" <?php if($_REQUEST['age-e'] == 70): ?>selected<?php endif; ?>>70+</option>
             </select>
        </span>
        <span id="tdLocation">
            <span id="dLocation">
            <select id="area" name="priovce" class="selectpicker col-1 search-select">
                <option value="">全部地区</option>
                <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>" <?php if($_REQUEST['priovce'] == $vo['aid']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </span>
        </span>

        <!--<span id="tdLoginStatus">-->
            <!--<select id="loginstatus" name="loginstatus" class="selectpicker col-1 search-select">-->
                <!--<option value="">全部</option>-->
                <!--<option value="1" <?php if($_REQUEST['loginstatus'] == 1): ?>selected<?php endif; ?>>目前在线</option>-->
                <!--<option value="2" <?php if($_REQUEST['loginstatus'] == 2): ?>selected<?php endif; ?>>过去8小时</option>-->
                <!--<option value="3" <?php if($_REQUEST['loginstatus'] == 3): ?>selected<?php endif; ?>>过去24小时</option>-->
                <!--<option value="4" <?php if($_REQUEST['loginstatus'] == 4): ?>selected<?php endif; ?>>过去48小时及以上</option>-->
            <!--</select>-->
        <!--</span>-->
        <button class="btn btn-default search-btn" id="quickSearchButton" type="submit">搜寻</button>
    </form>
</div>

<div class="container page-content profile light-bg" style="width: 960px;">
    <style>
        .material-icons {font-size: 19px;}
    </style>
    <div class="box-center tc ">
        <div id="resultsTable" class="light-bg content-700">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="search-results box-pad-sm results-profile block relative full-width " style="border-bottom: 1px solid #cccccc">
                    <div class="fl profile-img-links pull-left" style="width: 167px">
                        <div class="relative inline search-thumb-container tc light-bg">
                            <!--<div class="fix-bottom-right icon-private-showcase">-->
                                <!--<a href="#" data-p="47192327" class="request_showcase"><div class="material-icons md-light">&#xE897;</div></a>-->
                            <!--</div>-->
                            <a href="/index/uinfo.html?uid=<?php echo ($vo["uid"]); ?>">
                                <img alt="按一下了解简介详细资料" width="140px;" title=": 按一下了解简介详细资料" src="http://www.mingshut.com/Public<?php echo ((isset($vo["picture"]) && ($vo["picture"] !== ""))?($vo["picture"]):'/static/image/noavatar_middle.gif'); ?>" class="search-thumb middle" data-toggle="tooltip" data-placement="right">
                            </a>
                        </div>
                    </div>
                    <div class="fl profile-details box-marg-b" style="width:510px">
                        <div class="full-width">
                            <h2>
                                <a class="display-name" href="/index/uinfo.html?uid=<?php echo ($vo["uid"]); ?>"><?php echo ($vo["nickname"]); ?></a>
                                <?php if($vo['loginstatus'] == 1): ?><div class=" status-online middle inline" data-toggle="tooltip" data-placement="right" title="  此会员目前在线上。">&nbsp;</div><?php endif; ?>
                            </h2>
                        </div>
                        <div class="full-width" style="margin-top: 20px;">
                            <p class="caption-msg fontn clo9">
                                <span class="profile-details-data"><?php echo getAge($vo['birthdate']);?>岁(<?php echo get_constellation($vo['birthdate']);?>)</span>
                                <span class="profile-details-data"><?php echo getAreaByAid($vo['proivce']);?>&nbsp;&nbsp;<?php echo getAreaByAid($vo['city']);?></span>
                                <span class="profile-details-data"><?php echo ($vo['height']); ?>cm</span>
                                <span class="profile-details-data"><?php echo ($vo['weight']); ?>kg&nbsp;&nbsp;<?php echo getUserShape($vo['shape']);?></span>
                            </p>
                        </div>
                        <div class="full-width">
                            <p style="margin:10px 0 20px 0; ">签名介绍:<?php echo ($vo["describe"]); ?></p>

                            <div class="media-box fl">
                                <div class="pull-left material-icons md-dark md-18">&#xE0E1;</div>
                                <a class='media-content tm_ad_trigger search-mail-text profile-left-links' href="/member/chat.html?uid=<?php echo ($vo["uid"]); ?>">留言讯息</a>
                            </div>

                            <div class="media-box fl" style="margin-left: 20px;">
                                <div class="pull-left material-icons md-dark md-18"></div>
                                <?php if($currentuser['level'] > 1): ?><a class='media-content tm_ad_trigger search-mail-text profile-left-links' href="/index/uinfo.html?uid=<?php echo ($vo["uid"]); ?>">个人相册</a>
                                    <?php else: ?>
                                    <a class='media-content tm_ad_trigger search-mail-text profile-left-links' href="javascript:checkVip();">个人相册</a><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="full-width tc box-pad-lg" style="margin: 20px 0">
        <?php echo ($page); ?>
    </div>
</div>
<script>

    function checkVip() {
        swal({
            title: '',
            text: '你的权限不足，是否升级会员等级查看用户照片！',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "确定",
            //confirmButtonColor: "#35D374"
        }, function() {
            window.location.href='/index/newinfo.html?id=1';
        });
    };

</script>

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