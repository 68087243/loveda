<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>名叔堂</title>
    
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
        select{ width: 100%; height: 34px;color: #333; background-color: #FFffff; border-radius: 4px; border-color: #B8C2CC;margin-top: 5px;}
        select:active{ background-color: #e6e6e6; border-color: #adadad;}
        .content-960.page-content.wide { padding: 30px 20px 65px;  }
    </style>
</head>
<body style="background: #f6f8f8">

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
<link rel="stylesheet" type="text/css" href="http://www.mingshut.com/Public/static/page/css/icon.css?version=<?php echo version(3);?>"/>
<div class="content-960 light-bg page-content wide">
    <div id="settingsContainer">
        <div class="left-menu-nav">
    <ul class="nav nav-pills nav-stacked list-left-nav">
        <li class=" active">
            <a id="my_information" href="/member/index.html"><i class="material-icons"></i> 个人资料</a>
        </li>
        <li class="">
            <a id="profile_options" href="/member/topic.html"><img src="http://www.mingshut.com/Public/static/image/page/home/topic.png" alt=""/> 帖子管理</a>
        </li>
        <li class="">
            <a id="perfect_match" href="/member/pairing.html"><i class="material-icons"></i> 完美配对</a>
        </li>
        <li class="">
            <a id="personal_interests" href="/member/hobby.html"><i class="material-icons"></i> 个人兴趣</a>
        </li>

        <li class="">
            <a id="contact_options" href="/member/news.html"><i class="material-icons"></i> 消息管理
                <?php if($newscount > 0): ?><span id="newsCount" class="label badge inline pull-right"><?php echo ($newscount); ?></span><?php endif; ?>
            </a>
        </li>
        <li class="">
            <a href="/member/friends.html">
                <i class="material-icons md-21"></i>
                我的好友
                <?php if($friendcount > 0): ?><span id="favoritesCount" class="label badge inline pull-right"><?php echo ($friendcount); ?></span><?php endif; ?>
            </a>
        </li>
        <li class="">
            <a id="manage_photos" href="/member/photos.html"><i class="material-icons"></i> 相片管理</a>
        </li>
    </ul>

</div>
<script>
    $(function(){
        var hash =(window.location.hash).substring(1);
        $('.member-lfet li a').each(function(){
            if($(this).attr('id') == hash){
                $('.member-lfet li a').removeClass('selected');
                $(this).addClass('selected');
            }
        })
    });
</script>

        <div class="settings-content light-bg  fr" style="width: 670px;">
            <div id="manageInformation_container" class="is-hidden" style="display: block;">
                <form onsubmit="return false;" id="myform">
                    <div id="profileInfo">
                        <div class="h1">简介资料</div>
                        <div class="form-group">
                            <label for="input_nickname" class="form_label collapse-margin">昵称</label>
                            <input name="nickname" id="input_nickname" type="text" value="<?php echo ($user["nickname"]); ?>" class="form-control"><div class="help-block">别人将通过这个昵称知道您。(不要使用您的真名)</div>
                        </div>
                        <div class="form-group">
                            <label for="input_greeting" class="form_label collapse-margin">签名介绍</label>
                            <input name="describe" id="input_greeting" type="text" value="<?php echo ($user["describe"]); ?>" class="form-control">
                            <div class="help-block">您的签名档将会显示给其他会员看到。发挥您的创意！</div>
                        </div>
                        <div class="form-group">
                            <label for="input_greeting" class="form_label collapse-margin">出生日期</label>
                            <input name="birthdate" id="birthdate" type="text" value="<?php echo ($user["birthdate"]); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="height" class="form_label collapse-margin block">身高</label>
                            <select id="height" name="height">
                                <?php
 for($i=125;$i<220;$i++){ ?>
                                <option value="<?php echo ($i); ?>" <?php if($user['height'] == $i): ?>selected<?php endif; ?>><?php echo ($i); ?>cm</option>
                                <?php
 } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form_label collapse-margin block">所在城市</label>

                            <select name="proivce" onchange="checkeSupsort($(this).val(), $('#myform select[name=city]'));" style="width: 49%;">
                                <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($user['proivce'] == $vo['aid']): ?>selected<?php endif; ?>  value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <select name="city" style="width: 49%;">
                                <option value="">请选择</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="weight" class="form_label collapse-margin block">体重</label>
                            <select id="weight" name="weight">
                                <?php
 for($i=36;$i<140;$i++){ ?>
                                <option value="<?php echo ($i); ?>" <?php if($user['weight'] == $i): ?>selected<?php endif; ?>><?php echo ($i); ?>kg</option>
                                <?php
 } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shape" class="form_label collapse-margin block">体型</label>
                            <select id="shape" name="shape">
                                <option value="1" <?php if($user['shape'] == 1): ?>selected<?php endif; ?>>苗条</option>
                                <option value="2" <?php if($user['shape'] == 2): ?>selected<?php endif; ?>>匀称</option>
                                <option value="3" <?php if($user['shape'] == 3): ?>selected<?php endif; ?>>肌肉发达</option>
                                <option value="4" <?php if($user['shape'] == 4): ?>selected<?php endif; ?>>平均/中等</option>
                                <option value="5" <?php if($user['shape'] == 5): ?>selected<?php endif; ?>>结实有型</option>
                                <option value="6" <?php if($user['shape'] == 6): ?>selected<?php endif; ?>>微胖</option>
                                <option value="7" <?php if($user['shape'] == 7): ?>selected<?php endif; ?>>魁梧</option>
                                <option value="8" <?php if($user['shape'] == 8): ?>selected<?php endif; ?>>丰满(性感/曲线动人)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="smoking" class="form_label collapse-margin block">吸烟习惯</label>
                            <select id="smoking" name="smoking">
                                <option value="1" <?php if($user['shape'] == 1): ?>selected<?php endif; ?>>保密</option>
                                <option value="2" <?php if($user['shape'] == 2): ?>selected<?php endif; ?>>从不</option>
                                <option value="3" <?php if($user['shape'] == 3): ?>selected<?php endif; ?>>偶尔</option>
                                <option value="4" <?php if($user['shape'] == 4): ?>selected<?php endif; ?>>经常</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marriage" class="form_label collapse-margin block">婚姻状况</label>
                            <select id="marriage" name="marriage">
                                <option value="0">保密</option>
                                <option <?php if($user['marriage'] == '未婚'): ?>selected<?php endif; ?> value="未婚">未婚</option>
                                <option <?php if($user['marriage'] == '离异'): ?>selected<?php endif; ?> value="离异">离异</option>
                                <option <?php if($user['marriage'] == '丧偶'): ?>selected<?php endif; ?> value="丧偶">丧偶</option>
                                <option <?php if($user['marriage'] == '非单身'): ?>selected<?php endif; ?> value="非单身">非单身</option>
                            </select>
                        </div>
                    </div>
                    <div id="accountInfo">
                        <div class="h1">帐户资料</div>

                        <div class="panel panel-note">
                            <div class="panel-body">
                                <span class="uppercase">备注：&nbsp;</span><span>*</span>标出的栏位未在您的简介中公开，将永远不会向其他会员公开。
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_account" class="form_label collapse-margin">用户账号<span class="pink">*</span></label>
                            <input name="account" id="input_account" type="text" value="<?php echo ($user["account"]); ?>" class="form-control">
                            <div class="help-block">这是您登录网站使用的用户名称。</div>
                        </div>
                        <div class="form-group">
                            <label class="form_label collapse-margin">手机号<span class="pink">*</span></label>
                            <input name="tel" value="<?php echo ($user["tel"]); ?>" id="input_tel" type="text" class="form-control" placeholder=>
                        </div>
                        <div class="form-group">
                            <label class="form_label collapse-margin">QQ<span class="pink">*</span></label>
                            <input  value="<?php echo ($user["qqid"]); ?>" id="input_qq" type="text" name="qqid" class="form-control" placeholder=>
                        </div>
                        <div class="form-group">
                            <label class="form_label collapse-margin">微信<span class="pink">*</span></label>
                            <input  value="<?php echo ($user["wchat"]); ?>" id="input_wx" type="text" name="wchat" class="form-control" placeholder=>
                        </div>

                        <div class="form-group">
                            <label for="input_existing_pw" class="form_label">现有密码<span class="pink">*</span></label>
                            <input name="oldpassword" id="input_existing_pw" type="password" value="<?php echo (msubstr($user["password"],0,12)); ?>" class="form-control">
                            <div class="help-block">更新密码请求</div>
                        </div>
                        <div class="form-group">
                            <label for="input_password" class="form_label collapse-margin">密码<span class="pink">*</span></label>
                            <input name="password" id="input_password" type="password" value="" class="form-control">
                            <div class="help-block">必须至少5个字符长</div>

                            <label for="input_confirm_pw" class="form_label collapse-margin">密码确认<span class="pink">*</span></label>
                            <input name="confirm_pw" id="input_confirm_pw" type="password" value="" class="form-control">
                            <div class="help-block">请重新输入您的密码</div>
                        </div>
                    </div>
                    <div id="footerInfo">
                        <div class="update_button">
                            <div class="pull-left padding-top-30">
                                <button type="submit" class="submitButton btn btn-primary btn-med uppercase" onclick="sub();">提交</button>
                            </div>
                        </div>
                    </div>
                </form>
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
<script src="http://www.mingshut.com/Public/static/common/js/jquery.lhgcalendar.min.js"></script>
<script>
    $('#birthdate').calendar({
        format: 'yyyy-MM-dd',
        btnBar: false
    });
    checkeSupsort('<?php echo ($user["proivce"]); ?>', $('#myform select[name=city]'));
    $('#myform select[name=city] option').each(function(){
        if('<?php echo ($user["city"]); ?>' == $(this).val()){
            $(this).attr('selected',true);
        }
    })

    function sub(){
        var data = $('#myform').serialize();
        $.post('/member/info.html',data,function(data){
            if(data.code ==200){
                clearpop(data.message,'','self');
            }else{
                clearpop(data.message);
            }
        })
    }
</script>
</body>
</html>