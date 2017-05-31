<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>爱大叔--<?php echo ($info["title"]); ?></title>
    <link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/bootstrap/css/bootstrap.min.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/home.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.2.2.1.min.js?version=<?php echo version(2);?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/bootstrap/js/bootstrap.min.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/common.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/page/js/home.js?version=<?php echo version();?>"></script>

<script type="text/javascript">
    var URL="/Home/Index";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <style>
        table{border: 1px solid #E4E4E4}
        table tr th:first-child,table tr td:first-child{text-indent: 10px;}
    </style>
</head>
<body>
<?php $user = Common\Model\UserModel::getUser();$currentuid=$user['uid']; ?>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="bgf navbar-fixed-top">
    <div class="container  borderb-d">
        <nav class="navbar" role="navigation">
            <div class="collapse navbar-collapse relative" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="height: 85px;">
                    <li class="active">
                       <a href="/">
                           <!--<img src="http://www.lovehou.com/Public/static/image/logo.png" width="190"  alt=""/>-->
                           <span class="fontb clo6" style="font-size: 50px;line-height: 65px;">爱大叔</span>
                       </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav top_bar navbar-right" style="height: 40px;">
                    <li class="dropdown ">
                        <?php if($user['uid']): ?><a href="/member/index.html"  style="height: 40px;" class="dropdown-toggle clo6" data-toggle="dropdown">
                                <img src="http://www.lovehou.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>" width="25" class="user_noavatar_img"/>
                                <?php echo (msubstr($user["nickname"],0,9,'UTF-8',true)); ?>&nbsp;
                                <strong class="caret"></strong>
                            </a>
                        <?php else: ?>
                            <a href="/login/index.html" class="dropdown-toggle clo3" data-toggle="">
                               登录/注册
                            </a><?php endif; ?>
                        <ul class="dropdown-menu" style="min-width: 100px;">
                            <li>
                                <a href="/member/index.html">个人中心</a>
                            </li>
                            <li>
                                <a href="#">帖子文章</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/login/logout.html">退出登录</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="clo6 "><img src="http://www.lovehou.com/Public/static/image/page/home/location.png" width="15" alt=""/>设位置</a>
                    </li>
                    <li>
                        <a href="#" class="clo6" style="padding: 4px 0"><img src="http://www.lovehou.com/Public/static/image/page/home/mail.png" width="28" alt=""/>消息</a>
                    </li>
                </ul>
                <form onsubmit='return false;' id="searchForm" class="absolute nav navbar-nav navbar-right" style="top: 50px;right: 0" >
                        <select name="proivce" onchange="checkeSupsort($(this).val(), $('#searchForm select[name=city]'));"  style="width: 80px;height: 32px;">
                            <option value="">请选择</option>
                            <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <select name="city" style="width: 80px;height: 32px;">
                            <option value="">请选择</option>
                        </select>
                        <select name="ren" style="width: 80px;height: 32px;">
                            <option value="1">游伴</option>
                            <option value="2">游客</option>
                        </select>
                        <img src="http://www.lovehou.com/Public/static/image/page/home/search_flat.png" width="31" alt=""/>
                    </ul>
                </form>
            </div>
        </nav>

        <nav class="navbar navhead" role="navigation">
            <div class="collapse navbar-collapse relative" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav " style="height: 30px;width: 100%">
                    <li class="selected">
                        <a href="#" class="clo6">首页</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">找美女</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">找土豪</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">养成计划</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">公益资助</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div style="height: 140px;"></div>
<div class="container" style="margin-top: 30px;padding: 0 0 50px 0 ;">
    <div class="fl column" style="width: 910px;">
        <div style="height: 50px;line-height: 50px;text-indent: 10px;" class="font24"><?php echo ($info["title"]); ?><span class="font12 clo9"><?php echo ($info["createtime"]); ?></span></div>
        <div><?php echo ($info["message"]); ?></div>
    </div>
    <div class="fr column" style="width: 295px;">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: #7EE0D9" >
                <span class="panel-title fontb clo3">文章</span>
                <div class="clr"></div>
            </div>
            <div class="panel-body" style="background: #F9F9F9">
                <ul class="clo6">
                    <?php if(is_array($content)): $i = 0; $__LIST__ = $content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="borderb-d" style="padding: 5px 0;">
                            <div> <a href="/index/newinfo.html?id=<?php echo ($vo["id"]); ?>" class="clo3"><?php echo (msubstr($vo['title'],0,25)); ?></a></div>
                            <div class="font12 clo6" style="height: 20px;;"><?php echo timeTran($vo['addtime']);?></div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<footer style="width: 100%">
    <div class="footline"></div>
    <div class="footitem">
        <ul class=" container">
            <li class="fl tc">
                <p>新手上路</p>
            </li>
            <li class="fl tc">
                <p>网站条款</p>
            </li>
            <li class="fl tc">
                <p>联系我们</p>
            </li>
            <li class="fl tc">
                <p>关于我们</p>
            </li>
            <li class="fl tc">
                <p>友情链接</p>
            </li>
        </ul>
    </div>
    <div class="footline"></div>
    <div class="footitem" style="height: 50px;line-height: 50px;">
        <div class=" tc">Copyright 2013-2017</div>
    </div>
</footer>

<script src="http://www.lovehou.com/Public/static/common/js/jquery.lhgcalendar.min.js"></script>
<script>

</script>
<script>
    $('#pp_startime').calendar({
        format: 'yyyy-MM-dd',
        minDate: '%y-%M-%d',
        btnBar: false
    });
    $('#seachstime').calendar({
        format: 'yyyy-MM-dd',
        btnBar: false
    });
    $('#seachetime').calendar({
        format: 'yyyy-MM-dd',
        btnBar: false
    });
</script>

</body>
</html>