<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="webkit safari chrome win">
<head>
    <title>名叔馆--帖子列表</title>
    
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
    var URL="/Home/Index";
    var APP_PATH="";
    var PUBLIC = 'http://www.adsvip.cn/Public';
    var STATIC = 'http://www.adsvip.cn/Public/static';
    var UPLOAD = 'http://www.adsvip.cn/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <link rel="stylesheet" href="https://static-cdn.ashleymadison.com/v4/fonts/material-icons/material-icons.css" />
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
        }else if($pathname.indexOf('/topiclist')>=0){
            $('#nav-traveling').addClass('selected');
        }else{
            $('#nav-search').addClass('selected');
        }
    });
</script>
<div class="go-to-z-top fix-top-left simple-box-filled box-pad-xsm box-bdr-b text-center" style="background: #f6f8f8;border-bottom: 2px solid #D9D9D9">
    <form id="frmQuickSearch2" name="frmQuickSearch2" action="" method="GET" target="main" class=''>
        <input type="hidden" name="" value="1">
           <!-- <span id="tdAgeMin">
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
        </span>-->
        <span id="tdLocation">
            <span id="dLocation">
            <select id="area" name="aid" class="selectpicker col-1 search-select">
                <option value="">全部地区</option>
                <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>" <?php if($_REQUEST['priovce'] == $vo['aid']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </span>
        </span>

        <button class="btn btn-default search-btn" id="quickSearchButton" type="submit">搜寻</button>
    </form>
</div>
<style>
    .topic-itme{padding: 0 30px;width: 750px;cursor: pointer}
    .topic-itme:hover,.topic-itme:active{background: #F8F8F8}
</style>
<div class="container page-content profile light-bg " style="width: 960px;">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="topic-itme "  style="margin-bottom:40px;border-bottom: 1px dashed #cccccc;">
                <div class="topic_tit clo3 font16 fontb">
                        <span class="red">
                            <?php if($vo['city']): ?>[<?php echo getAreaByAid($vo['city']);?>]
                                <?php elseif($vo['proivce']): ?>
                                [<?php echo getAreaByAid($vo['proivce']);?>]<?php endif; ?>
                        </span>
                    <?php echo ($vo["title"]); ?> <span class="clo6 font12 fontn">(<?php echo timeTran($vo['createtime']);?>)</span>
                </div>
                <div class="topic_content font14 clo6 " style="padding-bottom:30px ;"  >
                   <div id="contenttext"> <?php echo (htmlspecialchars_decode($vo["message"])); ?></div>
                    <?php if($vo['sex'] != 1): if(is_array($vo['img'])): $i = 0; $__LIST__ = $vo['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i; if($img): ?><img src="http://www.adsvip.cn/Public/<?php echo ($img); ?>" style="max-width: 100%"  alt=""/><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                </div>
                <div class="topic_u_info">
                    <div class="clo9 fl topic-c-time font12">  <a href="/index/topic.html?tid=<?php echo ($vo["tid"]); ?>">阅读</a>(<?php echo ($vo["read"]); ?>)
                        &nbsp;<a href="/index/topic.html?tid=<?php echo ($vo["tid"]); ?>">评论</a>(<?php echo ($vo["comments"]); ?>)
                    </div>
                    <div class="clo9 fr topic-c-time font12"> <a href="/index/topic.html?tid=<?php echo ($vo["tid"]); ?>">阅读全文&gt;&gt;</a></div>
                    <div class="clr"></div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="full-width tc box-pad-lg" style="margin: 20px 0">
        <?php echo ($page); ?>
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