<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="webkit safari chrome win">
<head>
    <title>名叔馆--悬赏任务</title>
    
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
        /*table{border: 1px solid #E4E4E4}*/
        a:hover,a:active{text-decoration: none}
        table tr th:first-child,table tr td:first-child{text-indent: 10px;}
    </style>
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
<style>
    .container.page-content {padding: 10px 30px 65px; }
    .container textarea {border-color: #cccccc;width: 860px;height: 50px;resize: none;margin-top: 20px;text-indent: 5px;}
</style>
<div class="container page-content profile light-bg bordert-d" style="width: 960px;">
    <div class="topic-itme "  style="width: 850px;margin:40px 0;border-bottom: 1px dashed #cccccc;">
        <div style="height: 50px;line-height: 50px;background: #7EE0D9;text-indent: 10px;" class="font24">悬赏列表</div>
        <form role="form" id="seachform" style="margin: 20px 0">
            <input type="text"  class="form-control fl" name="keyword" style="width: 280px;" placeholder="请输出:目的地,计划标题，内容等关键字" value="<?php echo ($_REQUEST['keyword']); ?>"/>
            <span class="fl">&nbsp;&nbsp;</span>
            <input type="text" id="seachstime"  value="<?php echo ($_REQUEST['startime']); ?>" class="form-control fl"  placeholder="选择开始日期" style="width: 100px;" name="startime"/>
            <span class="fl">&nbsp;&nbsp;</span>
            <input type="text" id="seachetime"  value="<?php echo ($_REQUEST['startime']); ?>" class="form-control fl"  placeholder="选择开始日期" style="width: 100px;" name="startime"/>
            <span class="fl">&nbsp;&nbsp;</span>
            <button type="submit" style="background: #7EE0D9" class=" btn clof " >搜索</button>
            <button onclick="getMask().maskShow({'tit': '发布需求','width':500, 'cont': '#rkbox'});return false;" class=" btn clof " >发布悬赏</button>
            <div class="clr"></div>
        </form>
        <table class="list-task" width="910">

            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr onclick="window.location.href='/index/plan.html?pid=<?php echo ($vo["pid"]); ?>'" >
                    <td class="borderb-d " style="padding:  10px 0; ">
                        <a href="/index/plan.html?pid=<?php echo ($vo["pid"]); ?>">
                            <em class="list-task-reward font18 fontb clo3">
                                <?php echo str_ireplace($_REQUEST['keyword'],'<span class="red">'.$_REQUEST['keyword'].'</span>',$vo['title']);?>
                            </em>
                            <span></span>
                            <span class="font13 clo6 fr"><?php echo timeTran($vo['createtime']);?></span>
                            <div class="clr"></div>
                        </a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="page tc"><?php echo ($page); ?></div>

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
<div id="rkbox" style="display: none;">
    <form role="form" class="regform" style="width: 460px;" id="myform" onsubmit="return false;">
        <input type="hidden" name="type" value="1"/>
        <div class="form-group">
            <label for="tel" class="clo6">联系方式 </label><input type="text" placeholder="请填写您的手机号" class="form-control" name="tel" id="tel" />
        </div>
        <div class="form-group">
            <label for="info" class="clo6">你需要 </label><input type="text" name="note" placeholder="请用一句话概括您要做什么" id="info" class="form-control " />
        </div>
        <div class="form-group">
            <em>不懂怎么发布,提交让管理员代发</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index/planpost.html">我要自己发布需求</a>
        </div>
        <div class="form-group tc">
            <input type="submit" onclick="sub();" class="clof" style="border: none;background: #FB7D24;width: 400px;height:40px;border-radius: 4px;;" value="立即提交" />
        </div>
    </form>
</div>
<script src="http://www.mingshut.com/Public/static/common/js/jquery.lhgcalendar.min.js"></script>
<script>
    $('#exampleInputBirthdate1').calendar({
        format: 'yyyy-MM-dd',
        minDate: '%y-%M-%d',
        btnBar: false
    });
    $('#exampleInputBirthdate1').calendar({
        format: 'yyyy-MM-dd',
        minDate: '%y-%M-%d',
        btnBar: false
    });

    function sub(){
        $.post('/home/index/subform.html',{tel:$('#rkbox input[name=tel]').val(),type:$('#rkbox input[name=type]').val(),note:$('#rkbox input[name=note]').val()},function(data){
            clearpop(data.message);
            if(data.code ==200){
                $('#rkbox input[name=tel]').val('');
                $('#rkbox input[name=note]').val('')
            }
        })
    }
</script>
</body>
</html>