<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>爱大叔</title>
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
                <!--<form onsubmit='return false;' id="searchForm" class="absolute nav navbar-nav navbar-right" style="top: 50px;right: 0" >
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
                </form>-->
            </div>
        </nav>

        <nav class="navbar navhead" role="navigation">
            <div class="collapse navbar-collapse relative" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav fl " style="height: 30px;width: 100%;">
                    <li>
                        <a href="/index/richkept.html" class="clo6"><img src="http://www.lovehou.com/Public/static/image/page/home/pin_green.png" width="15" alt=""/>&nbsp;&nbsp;&nbsp;悬赏任务</a>
                    </li>
                    <li class="selected">
                        <a href="/" class="clo6">首页</a>
                    </li>
                    <li>
                        <a href="javascript:if(confirm('你没有权限，请升级你的会员等级'))window.location.href='/'" class="clo6">找美女</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">找土豪</a>
                    </li>
                    <li class="planitem">
                        <a href="/index/planlist.html" class="clo6">养成计划</a>
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
<script>
    var  $pathname = window.location.pathname.toLowerCase();
    if($pathname.indexOf('/plan')>0){
        $('.navbar-nav li').removeClass('selected');
        $('.navbar-nav li.planitem').addClass('selected');
    }
</script>
<div class="container">
    <div class="row clearfix" style="margin-top: 5px;">
        <div class="fl column" style="width:920px ;">
            <div class="carousel slide" id="carousel-128668">
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#carousel-128668">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-128668">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-128668" class="active">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item">
                        <img alt="" src="http://www.lovehou.com/Public/static/image/page/home/default.png" />
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.lovehou.com/Public/static/image/page/home/default1.png" />
                    </div>
                    <div class="item active">
                        <img alt="" src="http://www.lovehou.com/Public/static/image/page/home/default2.png" />
                    </div>

                </div> <a class="left carousel-control" href="#carousel-128668" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-128668" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <div class="fr column" style="width: 300px;;">
            <div class="bgy tc" style="height: 35px;line-height: 35px;cursor: pointer"><img src="http://www.lovehou.com/Public/static/image/page/home/crown.png" style="right: 5px;" class="fr rtop2" width="30px" alt=""/>会员升级</div>
            <div class="bgy tc" style="margin-top: 5px;height: 40px;line-height: 40px;">客服微信</div>
            <div class="tc bgb" style="margin-top: 5px;height: 55px;line-height: 55px;">客服微信</div>
            <div class="tc qr-index">
                <img src="http://www.lovehou.com/Public/static/image/page/home/qr.png" width="200" alt=""/>
                <div>微信客服</div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 30px;">
    <div class="row clearfix">
        <div class="fl column" style="width: 295px;">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #C6F2EF" >
                    <span class="panel-title clof">找萝莉</span><a class="fr clo6" href="/index/topiclist.html?cid=2">更多&gt;&gt;</a>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <ul class="clo6">
                        <?php if(is_array($nvsheng)): $i = 0; $__LIST__ = $nvsheng;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?><li class="borderb-d" style="padding: 5px 0;">
                                    <img src="http://www.lovehou.com/Public<?php echo ((isset($vo["avatar"]) && ($vo["avatar"] !== ""))?($vo["avatar"]):'/static/image/noavatar_middle.gif'); ?>" width="65" class="fl"/>
                                    <div class="fr" style="width: 195px;line-height: 35px;">
                                        <div class="font16 clo6"><?php if(isset($vo['title']) && $vo['title']): echo (msubstr($vo['title'],0,18)); else: echo (msubstr($vo['message'],0,12)); endif; ?></div>
                                        <div class="font12 clo9"><?php echo date('Y/m/d-H/i',strtotime($vo['createtime']));?></div>
                                    </div>
                                    <div class="clr"></div>
                                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #C6F2EF" >
                    <span class="panel-title clof">公益资助</span><a class="fr clo6" href="#">更多&gt;&gt;</a>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <ul class="clo6">
                        <?php if(is_array($gongyi)): $i = 0; $__LIST__ = $gongyi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?><li style="border-bottom:1px dashed #cccccc">
                                    <?php if(isset($vo['title']) && $vo['title']): echo (msubstr($vo['title'],0,18)); else: echo (msubstr($vo['message'],0,12)); endif; ?>
                                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #C6F2EF" >
                    <span class="panel-title clof">热门文章</span><span class="fr">更多&gt;&gt;</span>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <ul class="clo6">
                        <?php if(is_array($hotcontent)): $i = 0; $__LIST__ = $hotcontent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?><li class="borderb-d" style="padding: 5px 0;">
                                    <span style="display: inline-block;width: 10px;height: 10px ;background: #ffff00;border-radius: 10px;;"></span>&nbsp;
                                    <?php if(isset($vo['title']) && $vo['title']): echo (msubstr($vo['title'],0,18)); else: echo (msubstr($vo['message'],0,12)); endif; ?>
                                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" style="background: #C6F2EF" >
                    <span class="panel-title clof">网站优势</span>
                </div>
                <div class="panel-body">
                    <ul class="clo6">
                        <li style="border-bottom:1px dashed #cccccc">通过付费模式，极大的提高了约会的成功率和速</li>
                        <li style="border-bottom:1px dashed #cccccc">女生可以得到更加对等的回报</li>
                        <li style="border-bottom:1px dashed #cccccc">通过收费门槛，过滤没有实力和诚意的用户</li>
                        <li style="border-bottom:1px dashed #cccccc">可以利用你的魅力和闲暇时间赚取收入</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="fr column" style="width: 922px;"  id='userlist'>
            <div class="clearfix">
                <div class="fl column"  style="width: 615px;">
                    <div class="panel panel-default" style="background: #C6F2EF">
                        <div class="panel-title hotlost font24 fontb">精选推荐</div>
                        <div class="panel-body">
                            <div class="carousel slide" id="carousel-1286681">
                                <ol class="carousel-indicators">
                                    <li data-slide-to="0" data-target="#carousel-1286681">
                                    </li>
                                    <li data-slide-to="1" data-target="#carousel-1286681">
                                    </li>
                                    <li data-slide-to="2" data-target="#carousel-1286681" class="active">
                                    </li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item">
                                        <img alt="" src="http://www.lovehou.com/Public/static/image/page/home/d1.png" />
                                    </div>
                                    <div class="item">
                                        <img alt="" src="http://www.lovehou.com/Public/static/image/page/home/d2.png" />
                                    </div>
                                    <div class="item active">
                                        <img alt="" src="http://www.lovehou.com/Public/static/image/page/home/d1.png" />
                                    </div>
                                </div> <a class="left carousel-control" href="#carousel-1286681" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-1286681" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fr column"  style="width: 295px;">

                    <div class="panel panel-default" style="margin-bottom: 10px;">
                        <div class="panel-heading" style="background: #C6F2EF" >
                            <span class="panel-title clof">找大叔</span><a class="fr clo6" href="/index/topiclist.html?cid=1">更多&gt;&gt;</a>
                            <div class="clr"></div>
                        </div>
                        <div class="panel-body">
                            <ul class="clo6">
                                <?php if(is_array($dashu)): $i = 0; $__LIST__ = $dashu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?><li class="borderb-d" style="padding: 5px 0;">
                                            <img src="http://www.lovehou.com/Public<?php echo ((isset($vo["avatar"]) && ($vo["avatar"] !== ""))?($vo["avatar"]):'/static/image/noavatar_middle.gif'); ?>" width="65" class="fl"/>
                                            <div class="fr" style="width: 195px;line-height: 35px;">
                                                <div class="font16 clo6"><?php if(isset($vo['title']) && $vo['title']): echo (msubstr($vo['title'],0,18)); else: echo (msubstr($vo['message'],0,12)); endif; ?></div>
                                                <div class="font12 clo9"><?php echo date('Y/m/d-H/i',strtotime($vo['createtime']));?></div>
                                            </div>
                                            <div class="clr"></div>
                                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #C6F2EF" >
                            <span class="panel-title clof">找富婆</span><a class="fr clo6" href="/index/topiclist.html?cid=4">更多&gt;&gt;</a>
                            <div class="clr"></div>
                        </div>
                        <div class="panel-body">
                            <ul class="clo6">
                                <?php if(is_array($fupo)): $i = 0; $__LIST__ = $fupo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?><li class="borderb-d" style="padding: 5px 0;">
                                            <img src="http://www.lovehou.com/Public<?php echo ((isset($vo["avatar"]) && ($vo["avatar"] !== ""))?($vo["avatar"]):'/static/image/noavatar_middle.gif'); ?>" width="65" class="fl"/>
                                            <div class="fr" style="width: 195px;line-height: 35px;">
                                                <div class="font16 clo6"><?php if(isset($vo['title']) && $vo['title']): echo (msubstr($vo['title'],0,18)); else: echo (msubstr($vo['message'],0,12)); endif; ?></div>
                                                <div class="font12 clo9"><?php echo date('Y/m/d-H/i',strtotime($vo['createtime']));?></div>
                                            </div>
                                            <div class="clr"></div>
                                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clearfix" >
                <div class="nav px_nav bordert-d" >
                    <ul class="tc">
                        <li <?php if(!isset($_REQUEST['od']) || $_REQUEST['od'] == 'logintime'): ?>class="cloc"<?php endif; ?> onclick="window.location.href='?od=logintime#userlist'">最近登录</li>
                        <li <?php if(isset($_REQUEST['od']) && $_REQUEST['od'] == 'uid'): ?>class="cloc"<?php endif; ?> onclick="window.location.href='?od=uid#userlist'">人气排序</li>
                        <li <?php if(isset($_REQUEST['od']) && $_REQUEST['od'] == 'regtime'): ?>class="cloc"<?php endif; ?> onclick="window.location.href='?od=regtime#userlist'">最新注册</li>
                    </ul>
                </div>
                <div class=" clr userlist">
                    <ul class="clo6">
                        <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="borderb-d" style="padding: 5px 0;">
                                <img src="http://www.lovehou.com/Public<?php echo ((isset($vo["avatar"]) && ($vo["avatar"] !== ""))?($vo["avatar"]):'/static/image/noavatar_middle.gif'); ?>" width="100" class="fl"/>
                                <div class="fr" style="width: 810px;line-height: 22px;">
                                    <div class=""><span class="fontb"><?php echo ($vo["nickname"]); ?></span> <span></span><span></span><span></span></div>
                                    <?php if($vo['hobby']): ?><div class="cloc"><?php echo ($vo["hobby"]); ?></div><?php endif; ?>
                                    <div class="clo9">性别: <span class="green"> <?php if($vo['sex'] == 1): ?>女<?php else: ?>男<?php endif; ?></span> 城市: <span class="green"><?php echo getAreaByAid($vo['proivce']);?>&nbsp;&nbsp;<?php echo getAreaByAid($vo['city']);?></span> 年龄: <span class="green">25岁</span> 身高: <span class="green"><?php echo ((isset($vo['height']) && ($vo['height'] !== ""))?($vo['height']):0); ?>cm</span></div>
                                    <div class="cloc"><?php echo ((isset($vo['describe']) && ($vo['describe'] !== ""))?($vo['describe']):'暂无描述'); ?></div>
                                </div>
                                <div class="clr"></div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div><?php echo ($page); ?></div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
</div>
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
                <p><a href="/index/newinfo.html?id=2" class="clo3">联系我们</a></p>

            </li>
            <li class="fl tc">
                <p><a href="/index/newinfo.html?id=1" class="clo3">关于我们</a></p>
            </li>
        </ul>
    </div>
    <div class="footline"></div>
    <div class="footitem" style="height: 50px;line-height: 50px;">
        <div class=" tc">Copyright 2013-2017</div>
    </div>
</footer>
<div class="feedback font18 tc clof" onclick="showfeedback();">
    意见反馈
</div>
<div id="feedback" style="display: none;">
    <form role="form" class="regform" style="width: 460px;" id="myform" onsubmit="return false;">
        <input type="hidden" name="type" value="1"/>
        <div class="form-group">
            <label for="tel" class="clo6">联系方式 </label><input type="text" placeholder="请填写您的手机号" class="form-control" name="tel" id="tel" />
        </div>
        <div class="form-group">
            <label for="info" class="clo6">你需要 </label><input type="text" name="note" placeholder="请用一句话概括您要做什么" id="info" class="form-control " />
        </div>
        <br/>
        <div class="form-group tc">
            <input type="submit" onclick="subfeedback();" class="clof" style="border: none;background: #FB7D24;width: 400px;height:40px;border-radius: 4px;;" value="立即提交" />
        </div>
    </form>
</div>
<script>
    function showfeedback(){
        getMask().maskShow({"tit": "意见反馈","width":500, "cont": "#feedback"});
    }
    function subfeedback(){
        $.post('/home/index/subform.html',{tel:$('#feedback input[name=tel]').val(),note:$('#feedback input[name=note]').val()},function(data){
           clearpop(data.message);
            if(data.code ==200){
                $('#feedback input[name=note]').val('');
                $('#feedback input[name=tel]').val('');
            }
        })
    }
</script>
</body>
</html>