<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>爱大叔--伴游计划</title>
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
    var URL="/Home/Member";
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
<div class="container ">
    <div class="fl" style="width: 200px;">
        <div style="border: 1px solid #F1F1F1;">
    <div class="u_l_info tc" style="padding-top: 10px;background: #F8F8F8">
        <div>
            <img width="150" src="http://www.lovehou.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>"/>
        </div>
        <div class="green"><?php echo ($user["nickname"]); ?></div>

        <ul class="member-lfet bgf tl">
            <li><a href="/member/index.html" id="index" class="selected">基本资料</a></li>
            <li><a href="/member/address.html#topic" id="topic">文章</a></li>
            <li><a href="/member/escortplan.html#banyou" id="banyou">伴游计划</a></li>
            <li><a href="/member/wallet.html#news" id="news">消息</a></li>
            <li><a href="/member/favorite.html?type=1#friends" id="friends">我的好友</a></li>
            <li><a href="/member/favorite.html?type=2#vip" id="vip">会员升级</a></li>
            <li><a href="/member/wishlist.html#lyb" id="lyb">留言板</a></li>
        </ul>
    </div>
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

    </div>
    <div class="fr" style="width: 980px;border: 1px solid #F1F1F1">
        <div class="form-group font20 r_nav_tit" >计划列表</div>
        <ul class="right_top_nav fontb clo3">
            <li onclick="window.location.href='?u=splan'" <?php if((!isset($_REQUEST['u']) || $_REQUEST['u'] == 'info') and !isset($_REQUEST['f'])): ?>class="selected"<?php endif; ?> >发布计划</li>
            <li>|</li>
            <li onclick="window.location.href='?u=mplan'" <?php if((isset($_REQUEST['u']) and $_REQUEST['u'] == 'photo') or isset($_REQUEST['f'])): ?>class="selected"<?php endif; ?>>我的计划</li>
            <li>|</li>
            <li onclick="window.location.href='?u=oplan'" <?php if(isset($_REQUEST['u']) && $_REQUEST['u'] == 'chatway'): ?>class="selected"<?php endif; ?>>关注的计划</li>
        </ul>
        <div class="clr"></div>
        <div class="content bordert-d">
            <?php if(!isset($_REQUEST['u']) or $_REQUEST['u'] == 'splan'): ?><div id="myinfos ">
                    <style>
    #myform input[type=text]{width: 400px;}
</style>
<h3 style="margin:30px 100px;color: #7CE0D8">我的计划 <span class="fontn font14 clo6">(*为必填)</span></h3>
<form role="form" class="regform" id="myform" onsubmit="return false;" style="padding-bottom: 50px;">
    <input type="hidden" name="uid" value="<?php echo ($user["uid"]); ?>"/>
    <div class="form-group">
        <div class="fg-l tr fl">标题：</div>
        <div class="fg-r fr"> <span class="red fl">*</span><input type="text" name="title" class="form-control fl" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">目的地：</div>
        <div class="fg-r fr">
            <span class="red fl">*</span>
            <select name="proivce"  class="fl" onchange="checkeSupsort($(this).val(), $('#myform select[name=city]'));" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
                <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <select name="city" class="fl" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
            </select>
           <input type="text" style="width: 200px" class="form-control fl" name="addr" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">开始日期：</div>
        <div class="fg-r fr"><span class="red fl">*</span><input type="text"  class="form-control fl" name="startime" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">共几天：</div>
        <div class="fg-r fr">
            <span class="red fl">*</span>
            <select name="duration" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
                <option value="1">3天</option>
                <option value="2">5天</option>
                <option value="3">7天</option>
                <option value="4">一个月</option>
                <option value="5">三个月</option>
                <option value="6">长期有效</option>
            </select>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">诚意金：</div>
        <div class="fg-r fr">
            <span class="red fl">*</span>
            <input type="text"  class="form-control fl" name="earnestfee" />
            <span class="fl">元/天</span>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">费用预算：</div>
        <div class="fg-r fr">
            <span class="red fl">*</span>
            <input type="text" class="form-control fl" name="budgetfee" />
            <span class="fl">元/天</span>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">支付方式：</div>
        <div class="fg-r fr">
            <span class="red fl">*</span>
            <select name="payway" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
                <option value="1">现金</option>
                <option value="2">微信</option>
                <option value="3">QQ</option>
                <option value="4">支付宝</option>
                <option value="5">PayPal</option>
                <option value="6">银行卡</option>
                <option value="7">其他</option>
            </select>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group" >
        <div class="fg-l tr fl">计划说明：</div>
        <div class="fg-r fr">
            <span class="red fl">*</span>
            <textarea name="contentcn"  id="contentcn"></textarea>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group" ><h3 style="margin:30px 100px;color: #7CE0D8">对伴游的要求 <span class="fontn font14 clo6">(选填)</span></h3></div>
    <div class="form-group">
        <div class="fg-l tr fl">服务内容：</div>
        <div class="fg-r fr">
            <input type="text"  class="form-control" name="demand" />
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">年龄：</div>
        <div class="fg-r fr">
            <select name="height" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
                <?php
 for($i=15;$i<80;$i++){ ?>
                <option <?php if($user['age'] == $i): ?>selected<?php endif; ?> value="<?php echo ($i); ?>"><?php echo ($i); ?></option>
                <?php
 } ?>
            </select>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">身高：</div>
        <div class="fg-r fr">
            <select name="height" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
                <?php
 for($i=145;$i<210;$i++){ ?>
                <option value="<?php echo ($i); ?>"><?php echo ($i); ?> cm</option>
                <?php
 } ?>
            </select>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">学历：</div>
        <div class="fg-r fr">
            <select name="education" style="width: 100px;height: 32px;">
                <option value="">请选择</option>
                <option value="1">初中及以下</option>
                <option value="2">中专</option>
                <option value="3">高中</option>
                <option value="4">专科</option>
                <option value="5">本科</option>
                <option value="6">硕士</option>
                <option value="7">博士</option>
            </select>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">体重：</div>
        <div class="fg-r fr">
            <input type="text" class="form-control fl" name="weight" />
            <span class="fl">kg</span>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">兴趣爱好：</div>
        <div class="fg-r fr">
            <input type="text"  class="form-control fl" name="hobby" />
        </div>
        <div class="clr"></div>
    </div>

    <button type="submit" style="margin-left: 100px;" class=" fl btn clof btn-success " onclick="subPlan();">发布计划</button>
    <button type="submit" style="margin-left: 100px;" class=" fl btn btn-default" onclick="window.history.back(-1);">取消</button>
</form>
<link rel="stylesheet" href="http://www.lovehou.com/Public/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/upload.js?<?php echo version();?>"></script>

<script>
    upload.prototype.createContent("#contentcn",'pyplan',670);
    window.subBlock=false;
    function subPlan(){
        if(subBlock){
            return false;
        }
        var title = $('#myform input[name=title]').val();
        var addr = $('#myform input[name=addr]').val();
        var startime = $('#myform input[name=startime]').val();
        var duration = $('#myform select[name=duration]').val();
        var payway = $('#myform select[name=payway]').val();
        var earnestfee = $('#myform input[name=earnestfee]').val();
        var budgetfee = $('#myform input[name=budgetfee]').val();
        var contentcn = $('#myform textarea[name=contentcn]').val();
        if(!title){
            clearpop('请填写标题！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!addr){
            clearpop('请填写目的地！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!startime){
            clearpop('请选择出发日期！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!duration){
            clearpop('请选择时长！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!payway){
            clearpop('请选择支付方式！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!earnestfee){
            clearpop('请填写诚意金！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!budgetfee){
            clearpop('请填写费用预算！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!contentcn){
            clearpop('请填写计划说明！');
            subBlock = false;//解除阻塞
            return false;
        }

        subBlock = true;//阻塞
        var $data = $("#myform").serialize();
        $.post('/home/member/subPlan.html', $data, function (data) {
            subBlock = false;//解除阻塞
            if (data.code == 200) {
                clearpop(data.message, '',data.data);
            } else {
                clearpop(data.message);
            }
        })
    }

</script>
                </div><?php endif; ?>
            <?php if(isset($_REQUEST['u']) and $_REQUEST['u'] == 'chatway'): ?><div id="contactways">
                    <div class="form-group font20 r_nav_tit">联系方式 <span class="clof">Basic Information</span></div>
<form class="regform" id="contactway" onsubmit="return false;" style="padding-bottom: 50px;">
    <input type="hidden" name="uid" value="<?php echo ($user["uid"]); ?>"/>
    <div style="margin-top: 50px;"></div>
    <div class="form-group">
        <div class="fg-l tr fl">手机号码：</div>
        <div class="fg-r fr"><input type="text" value="<?php echo ($user["tel"]); ?>" class="form-control fr" name="tel" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">邮箱：</div>
        <div class="fg-r fr"><input type="text" value="<?php echo ($user["email"]); ?>" class="form-control fr" name="email" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">QQ：</div>
        <div class="fg-r fr"><input type="text" value="<?php echo ($user["qqid"]); ?>" class="form-control fr" name="qqid" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">微信：</div>
        <div class="fg-r fr"><input type="text" value="<?php echo ($user["wechat"]); ?>" class="form-control fr" name="wechat" /></div>
        <div class="clr"></div>
    </div>
    <button type="submit" style="margin-left: 100px;" class=" fl btn clof btn-blue" onclick="contactway();">修改</button>
</form>
<script>
    window.subBlock = false;
    function contactway(){
        if(subBlock){
            return false;
        }
        var $data={
            uid:$("#contactway input[name=uid]").val(),
            email:$("#contactway input[name=email]").val(),
            tel:$("#contactway input[name=tel]").val(),
            qqid:$("#contactway input[name=qqid]").val(),
            wechat:$("#contactway input[name=wechat]").val()
        }
        subBlock = true;//阻塞
        $.post('/home/member/modifyuser.html', $data, function (data) {
            subBlock = false;//解除阻塞
            if (data.code == 200) {
                clearpop(data.message);
            } else {
                clearpop(data.message);
            }
        })
    }
</script>
                </div><?php endif; ?>
            <?php if((isset($_REQUEST['u']) and $_REQUEST['u'] == 'photo') or isset($_REQUEST['f'])): ?><div id="photos">
                    <?php $photolist = Common\Model\UserPhotoModel::getUserPhoto($user['uid']); $con['uid'] =$user['uid']; $con['type'] = Common\Model\UserPhotoModel::AVATAR_TYPE; $con['status'] = Common\Model\UserPhotoModel::IN_AUDIT; $inauditAvatar = Common\Model\UserPhotoModel::getUserPhotoByCon($con); ?>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="form-group font20 r_nav_tit" >照片管理 <span class="clof">Photo Management</span></div>
<ul class=" avatar_nav" >
    <li onclick="window.location.href='?f=avatar'"  <?php if(!isset($_REQUEST['f']) || $_REQUEST['f'] == 'avatar'): ?>class="selected"<?php endif; ?>>修改头像</li>
    <li>|</li>
    <li  onclick="window.location.href='?f=photo'" <?php if(isset($_REQUEST['f']) && $_REQUEST['f'] == 'photo'): ?>class="selected"<?php endif; ?>>我的相册</li>
</ul>
<div class="content bordert-d clr ">
    <div <?php if(!isset($_REQUEST['f']) || $_REQUEST['f'] == 'avatar'): ?>class="u_l_info"<?php else: ?> class="u_l_info hide"<?php endif; ?> id="avater" style="margin-top: 20px;" >
    <div class="photo_item fl relative" >
        <span class="absolute hide delimg" onclick="delimg('<?php echo ($inauditAvatar[0]["id"]); ?>')" style="top: 0;right: 5px;cursor: pointer" ><span class="del_ico "></span></span>
        <?php if(empty($inauditAvatar)): ?><img class="avater" width="150" style="border: 1px solid #D1D1D1" src="http://www.lovehou.com/Public<?php echo ($user["picture"]); ?>"/>
            <?php else: ?>
            <img class="avater" width="150" style="border: 1px solid #D1D1D1" src="http://www.lovehou.com/Public<?php echo ($inauditAvatar[0]['img']); ?>"/><?php endif; ?>
        <?php if(!empty($inauditAvatar) and $inauditAvatar[0]['status'] == 0): ?><div class="absolute clof tc fontb" style="width: 150px;height: 30px;;background: #000000;opacity: .5;bottom: 0;">审核中</div><?php endif; ?>
    </div>
    <div class="clr"></div>
    <div>
        <span class="upavatar_btn clof" onclick="$('#file').click();upavatar();"><img src="http://www.lovehou.com/Public/static/image/page/home/cloud_upload.png" width="20" alt=""/>上传</span>
            <span class="upavatar_btn clof" onclick="uploadPhoto($('#avater .avater').data('path'),'',2);"><img src="http://www.lovehou.com/Public/static/image/page/home/disk.png" width="15" alt=""/>保存</span>
    </div>
    <div class="clo9 " style="padding: 20px 0;">
        请选用清晰的本人近照，不要上传多人合影，合成图片，明显照片，卡通宠物或其他色情低俗违法图片，个人形象照只允许上传真实个人生活照片，其他照片一律删除!
        <p>为了保证形象照的真实性，审核由客服人员人工审核(20 小时内)，请耐心等候。如果稀有加快审核进程，请联系客服优先审核</p>
    </div>
</div>
<div id="photo" <?php if(isset($_REQUEST['f']) && $_REQUEST['f'] == 'photo'): else: ?> class="u_l_info hide"<?php endif; ?> >
<?php if(empty($photolist)): ?><div class="tc nophoto"  >
        <img src="http://www.lovehou.com/Public/static/image/page/home/happy_Face.png" alt=""/>
        <div class="cloc">你还没有上传相片</div>
    </div>
    <?php else: ?>
    <?php if(is_array($photolist)): $i = 0; $__LIST__ = $photolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="photo_item fl relative" id="row_<?php echo ($vo["id"]); ?>">
            <span class="absolute hide delimg" onclick="delimg('<?php echo ($vo["id"]); ?>')" style="top: 0;right: 5px;cursor: pointer" ><span class="del_ico "></span></span>
            <img src="http://www.lovehou.com/Public<?php echo ($vo["img"]); ?>" width="100%" alt=""/>
            <?php if($vo['status'] == 0): ?><div class="absolute clof tc fontb" style="width: 180px;height: 30px;;background: #000000;opacity: .5;bottom: 0;">审核中</div><?php endif; ?>
        </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
<div class="clr tc"><button class="btn clof btn-blue" onclick="if(parseInt($('#photocount'))>=12){clearpop('上传照片上限');return;};$('#pfile').click();upphoto();">上传照片</button> <span class="clo9">最多上传12张，当前已上传 <span id="photocount"><?php echo count($photolist); ?></span>张</span></div>
</div>
</div>

<input type="file" id="file" class="hide"/>
<input type="file" id="pfile" class="hide"/>
<div id="pic"  style="display: none;;">
    <div class="fullbg" onclick="$('#pic').hide()"></div>
    <div class="pop center" style="width: 500px;left: 50%;margin-left: -250px;">
        <div id="clipArea" style="height: 300px;"></div>
        <button id="clipBtn" class="btn store_btn " style="width:25%;margin: 2% 0;">完成</button>
    </div>
</div>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/hammer.js"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/iscroll-zoom.js"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.photoClip.min.js"></script>
<script>
    $(function() {
        $('.photo_item').mouseover(function(){
            $('.photo_item .delimg').removeClass('hide');
        })
        $('.photo_item ').mouseout(function(){
            $('.photo_item .delimg').addClass('hide');
        })
        $('.photo_item .delimg span').mouseover(function(){
            $(this).addClass('del_red_ico');
            $('.photo_item .delimg').removeClass('hide');
        })
        $('.photo_item .delimg span').mouseout(function(){
            $(this).removeClass('del_red_ico');
        })
    })
    function upavatar(){
        $("#clipArea").photoClip({
            width: 300,
            height: 300,
            file: "#file",
            view: "#view",
            ok: "#clipBtn",
            loadStart: function() {
                console.log("照片读取中");
            },
            loadComplete: function() {
                $('#pic').show()
            },
            clipFinish: function(dataURL) {
                uploadPicByBase64('avatar',dataURL);
            }
        });
    }
    function upphoto(){
        $("#clipArea").photoClip({
            width: 250,
            height: 312,
            file: "#pfile",
            view: "#view",
            ok: "#clipBtn",
            loadStart: function() {
                console.log("照片读取中");
            },
            loadComplete: function() {
                $('#pic').show()
            },
            clipFinish: function(dataURL) {
                uploadPicByBase64('photo',dataURL);
            }
        });
    }

    function uploadPhoto(img,thumb,type){
        if(!img){
            clearpop('请选择图片');
            return false;
        }
        $.post('/home/member/uploadPhoto.html',{img:img,thumb:thumb,type:type},function(data){
            if(data.code == 200){
              //  clearpop(data.message,'','self');
            }else{
                clearpop(data.message);
            }
        })
    }

    function uploadPicByBase64(scope,stream){
        var uploadPhp = DOMAIN+'/Public/uploadForKindeditor.php';
        var uploadJson = uploadPhp+"?scope="+scope+"&callback="+DOMAIN+"&isbase64=true&isaj=1";
        $.post(uploadJson,{stream:stream},function(data){
            if(data.code==100){
                var img = data.data.url.img;
                var thumb = data.data.url.thumb;
                if(stream== 'photo'){
                    uploadPhoto(img,thumb,1);
                }else{
                    $('#avater .avater').attr('src',PUBLIC+img);
                    $('#avater .avater').data('path',img);
                }
                $('#pic').hide()
            }else{
                clearpop('上传失败');
            }
        },'json')
    }

    function delimg(imgid){
        $.post('/member/delPhoto.html',{imgid:imgid},function(data){
            clearpop(data.message);
            if(data.code ==200){
                $('#row_'+imgid).remove();
            }
        })
    }
</script>
                </div><?php endif; ?>

        </div>
    </div>
    <div class="clr"></div>
</div>
<script>


</script>
</body>
</html>