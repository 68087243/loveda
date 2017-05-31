<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>爱大叔--注册</title>
    <meta name="keywords" content="<?php echo ($keywords); ?>" />
    <meta name="description" content="<?php echo ($description); ?>" />
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
    var URL="/Home/Login";
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
<div class="container">
    <!--<div style="height: 70px;">-->
        <!--<div class="clof tc regtopboll">1</div>-->
    <!--</div>-->
    <div class="row clearfix">
        <div class="reg-left fl" style="border: 1px solid #EDEDED;padding-bottom: 30px; border-top: 2px solid #EDEDED;">
            <form role="form" class="regform" id="myform" onsubmit="return false;">
                <div class="form-group font24" style="width: 600px;height: 60px;color: #53BCB0;line-height: 60px;border-bottom: 1px solid #EDEDED">个人基本信息</div>

                    <div class="form-group">
                        <div class="fg-l tr fl">手机号码：</div>
                        <div class="fg-r fr"><span class="red">*</span><input type="text" placeholder="请输入手机号注册" class="form-control fr" name="tel" /></div>
                        <div class="clr"></div>
                    </div>
                    <div class="form-group">
                        <div class="fg-l tr fl">昵称：</div>
                        <div class="fg-r fr"><span class="red">*</span><input type="text" name="nickname" placeholder="" class="form-control fr" /></div>
                        <div class="clr"></div>
                    </div>
                    <div class="form-group">
                        <div class="fg-l tr fl">密码：</div>
                        <div class="fg-r fr"><span class="red">*</span><input name="password" maxlength="18" type="text" placeholder="字母数字组合4-18"  class="form-control fr"/></div>
                        <div class="clr"></div>
                    </div>
                    <div class="form-group">
                        <div class="fg-l tr fl">所在城市：</div>
                        <div class="fg-r fr">
                            <span class="red">*</span>
                            <select name="proivce" onchange="checkeSupsort($(this).val(), $('.regform select[name=city]'));" style="width: 100px;height: 32px;">
                                <option value="">请选择</option>
                                <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <select name="city" style="width: 100px;height: 32px;">
                                <option value="">请选择</option>
                            </select>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="form-group">
                        <div class="fg-l tr fl">注册类型：</div>
                        <div class="fg-r fr">
                            <span class="red">*</span>
                            <label for="sex2" style="cursor: pointer" class="clo3 fontn"><input class="rtop2" type="radio" name="sex" id="sex2" value="2"/>实力大叔(男) </label><br/>
                            <label for="sex1" style="cursor: pointer" class="fontn clo3"><input class="rtop2" style="margin-left: 9px;;" type="radio" name="sex" id="sex1" value="1"/>美女萝莉(女)</label>
                            <span class="red font12 hide" id="tit">(注册后不可更改)</span>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="form-group hide" id="bwh">
                        <div class="fg-l tr fl">三围：</div>
                        <div class="fg-r fr">
                            <span class="red fl">*&nbsp;</span>
                            <input type="text" name="bust" value="<?php echo ($user["bust"]); ?>" placeholder="胸围/cm" class="form-control fl" style="width: 100px;"/>
                            <input type="text" name="waist" value="<?php echo ($user["waist"]); ?>" placeholder="腰围/cm" class="form-control fl"  style="width: 100px;margin-left: 4px;"/>
                            <input type="text" name="hip"  value="<?php echo ($user["hip"]); ?>" placeholder="臀围/cm" class="form-control fl"  style="width: 100px;margin-left: 4px;"/>
                        </div>
                        <div class="clr"></div>
                    </div>
                <button type="submit" style="margin-left: 100px;" class=" fl btn clof btn-blue" onclick="reg();">注册</button>
                <div class="fr"><a href="/login/index.html" class="clo6">已有账号，去登录</a></div>
            </form>
        </div>
        <div class="reg-right fr" style="width: 380px;;">
            <div><img src="http://www.lovehou.com/Public/static/image/page/home/reg_r_t.jpg" width="100%" alt=""/></div>

            <div class="panel panel-default" style="margin-top: 50px;background: #E8F7FF">
                <div class="panel-body">
                    <ul class="clo6">
                        <li style="border-bottom:1px dashed #cccccc"><img src="" alt=""/>通过付费模式，极大的提高了约会的成功率和速度</li>
                        <li style="border-bottom:1px dashed #cccccc"><img src="" alt=""/>女生可以得到更加对等的回报</li>
                        <li style="border-bottom:1px dashed #cccccc"><img src="" alt=""/>通过收费门槛，过滤没有实力和诚意的用户</li>
                        <li style="border-bottom:1px dashed #cccccc"><img src="" alt=""/>可以利用你的魅力和闲暇时间赚取收入</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="absolute" style="bottom: 0;width: 100%">
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

<script>
    $('.regform input[name=sex]').change(function(){

        $('#tit').removeClass('hide');
        if($(this).val()==1){ //女性显示三围
            $('#bwh').removeClass('hide');
        }else{
            $('#bwh').addClass('hide');
        }
    });

    /*阻塞标志，防止重复提交；预设不阻塞*/
    window.subBlock=false;
    function reg(){
        if(subBlock){
            return false;
        }
        var tel = $('.regform input[name=tel]').val();
        var password = $('.regform input[name=password]').val();
        var sex = $('.regform input[name=sex]:checked').val();
        var nickname = $('.regform input[name=nickname]').val();
        var priovce = $('.regform select[name=proivce]').val();
        var city = $('.regform select[name=city]').val();
        var bust = $('.regform input[name=bust]').val();
        var waist = $('.regform input[name=waist]').val();
        var hip = $('.regform input[name=hip]').val();
        if(!regex(tel,'mob')){
            clearpop('电话号码格式不正确');
            subBlock = false;//解除阻塞
            return false;
        }
        if(password.length<5||password.length>18){
            clearpop('密码长度应为4-18为');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!sex){
            clearpop('请选择性别！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!nickname){
            clearpop('请填写昵称！');
            subBlock = false;//解除阻塞
            return false;
        }
        if(!priovce || !city){
            clearpop('请选择所在城市！');
            subBlock = false;//解除阻塞
            return false;
        }

        if(sex==1){ //女性三围
            if(!bust){
                clearpop('请填写你的胸围！');
                subBlock = false;//解除阻塞
                return false;
            }
            if(!waist){
                clearpop('请填写你的腰围！');
                subBlock = false;//解除阻塞
                return false;
            }
            if(!hip){
                clearpop('请填写你的臀围！');
                subBlock = false;//解除阻塞
                return false;
            }
        }

        subBlock = true;//阻塞
        var $data = $("#myform").serialize();
        $.post('/home/login/reg.html', $data, function (data) {
            subBlock = false;//解除阻塞
            if (data.code == 200) {
                clearpop(data.message, '',data.data);
            } else {
                clearpop(data.message);
            }
        })
    }
</script>
</body>
</html>