<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="Robots" content="noindex,nofollow,noarchive" />
    <title>爱大叔--注册</title>
    
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
    var URL="/Wap/Login";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


<body pagename="reg">
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="clearfix header">
    <ul class="user_header top-head container">
        <li class="fl" onclick="window.history.back(-1)"><span class="back"></span></li>
        <li class="tc fl top-htit">
            <span class="font24 clof"><?php echo ((isset($headtitle) && ($headtitle !== ""))?($headtitle):'个人中心'); ?></span>
        </li>
        <li class="fr" onclick="openside();"><span class="menu"></span></li>
    </ul>
    <div class="clr"></div>
</div>
<div style="height: 50px;"></div>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="imui_side b_f" onclick="openside();">
    <div class="side_user font14 clof cl">
        <?php if(!empty($user)): ?><a href="/user/index.html" >
                <?php if($user['picture']): ?><img src="http://www.lovehou.com/Public/<?php echo ($user['picture']); ?>">
                    <?php else: ?>
                    <img src="http://www.lovehou.com/Public/static/image/noavatar_middle.gif"><?php endif; ?>
            </a>
            <h3 class="font16"><?php echo ($user["nickname"]); ?></h3>
            <p><a href="/login/logout.html" class="clof fr font12">退出</a></p>
            <?php else: ?>
            <p class="font18"><a href="/login/login.html" style="text-decoration: inherit" class="clof fr font20">请登录</a></p><?php endif; ?>
    </div>
    <div class="side_nv size_16">
        <ul id="sidearea">
            <li>
                <a href="/">
                    <div class="font16 fontb">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_home.png" width="40" style="margin-left: 10px;" />
                        <span class="relative s_rowname" >首页</span>
                    </div>
                    <div class="clr "></div>
                </a>
            </li>
            <li>
                <a href="/">
                    <div class="font16 fontb">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_chat.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >论坛</span>
                    </div>
                </a>
            </li>
            <li>
                <?php if($user['sex'] == 1): ?><a href="/index/rlist.html?cid=1">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/f_boy.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >找大叔</span>
                    </a>
                <?php else: ?>
                    <a href="/index/rlist.html?cid=2">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_girl.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >找萝莉</span>
                    </a><?php endif; ?>
            </li>
            <li>
                <a href="/">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_service.png" width="40" style="margin-left: 10px;"/>
                    <span class="relative s_rowname" >服务指南</span>
                </a>
            </li>
            <li>
                <a href="/">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_index/aboutus.png" width="40" style="margin-left: 10px;"/>
                    <span class="relative s_rowname" >联系我们</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="imui_sidebg" onclick="openside();"></div>

<div class="container">
    <form role="form" id="regbox" onsubmit="return false;">
        <div id="box_1">
            <div class="form-group tc" style="margin-bottom: 0">
                <ul class="relative" style="line-height: 41px; top: 10px;">
                    <li class="fl"><label for="radio1" class="clo6"><input type="radio" id="radio1" name="sex" value="1"/>我是女生</label></li>
                    <li class="fl"><label for="radio2" class="clo6"><input type="radio" id="radio2" name="sex" value="2"/>我是男生</label></li>
                </ul>
            </div>
            <div class="font12 orange relative fr" id="sextit" style="top: -20px;right: 30px;display: none">选择后不可更改</div>
            <div class="form-group">
                <span>用户名</span><input type="text" name="nickname" class="form-control" id="exampleInputUser1" />
            </div>
            <div class="form-group">
                <span>密码</span><input type="password" name="password" placeholder="6-18个字符" class="form-control" id="exampleInputPassword1" />
            </div>
            <div class="form-group">
                <span>确认密码</span><input type="password" name="repassword" placeholder="重复上面的密码" class="form-control" id="exampleInputPassword2" />
            </div>
            <div class="form-group">
                <span>邮箱</span><input type="text" name="email" placeholder="请输入你的邮箱"  class="form-control" id="exampleInputEmail1" />
            </div>
            <div class="form-group">
                <span>QQ</span><input type="text" name="qqid" placeholder="请输入你的QQ"  class="form-control" id="exampleInputqq" />
            </div>
            <div class="form-group">
                <div class="next_btn tc clof" onclick="checkInput();">下一步</div>
            </div>
        </div>

        <div id="box_2" class=" hide">
            <div class="form-group">
                <div style="margin-left: 5px;">身高</div>
                <div class="idealforms_select tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="height">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                         <?php
 for($i=145;$i<210;$i++){ ?>
                             <li data-value="<?php echo ($i); ?>"><?php echo ($i); ?>cm</li>
                         <?php
 } ?>
                    </ul>
                </div>
            </div>
            <div class="form-group" >
                <div style="margin-left: 5px;">年龄</div>
                <div class="idealforms_select" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="age">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu">
                        <?php
 for($i=15;$i<80;$i++){ ?>
                        <li data-value="<?php echo ($i); ?>"><?php echo ($i); ?></li>
                        <?php
 } ?>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <div style="margin-left: 5px;">最高学历</div>
                <div class="idealforms_select tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="education">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <li data-value="">请选择</li>
                        <li data-value="初中及以下">初中及以下</li>
                        <li data-value="中专">中专</li>
                        <li data-value="高中">高中</li>
                        <li data-value="专科">专科</li>
                        <li data-value="本科">本科</li>
                        <li data-value="硕士">硕士</li>
                        <li data-value="博士">博士</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <div style="margin-left: 5px;">婚姻状况</div>
                <div class="idealforms_select tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="marriage">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <li data-value="">请选择</li>
                        <li data-value="未婚">未婚</li>
                        <li data-value="离异">离异</li>
                        <li data-value="丧偶">丧偶</li>
                        <li data-value="非单身">非单身</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <div style="margin-left: 5px;">月收入</div>
                <div class="idealforms_select tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="income">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <li data-value="">请选择</li>
                        <li data-value="3000元以下">3000元以下</li>
                        <li data-value="3001元-5000元">3001元-5000元</li>
                        <li data-value="5001元-8000元">5001元-8000元</li>
                        <li data-value="8001元-12000元">8001元-12000元</li>
                        <li data-value="12001元-20000元">12001元-20000元</li>
                        <li data-value="20001元-50000元">20001元-50000元</li>
                        <li data-value="50001元以上">50001元以上</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <div style="margin-left: 5px;">城市&nbsp;&nbsp;</div>
                <div class="idealforms_select fl" style="width:50%;min-width: 100px;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="proivce">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu">
                        <li data-value="0">请选择省</li>
                        <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="idealforms_select fl" style="width:50%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="city">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu">
                        <li data-value="0">请选择城市</li>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
            <div class="form-group tc">
                <div class=" next_btn clof" onclick=" $('#regbox').submit();" >注册</div>
            </div>
        </div>
        <div class="checkbox  font12 cloc">
            <span style="margin-left: 10%;display: none" onclick="$('#box_2').addClass('hide');$('#box_1').removeClass('hide');$(this).hide();" id="up">&lt;&lt;上一步</span>
            <span class="fr borderb-d tc ">已有账号,去<a href="/login/login.html">登录</a>！</span>
            <div class="clr"></div>
        </div>
    </form>
</div>
<script>
    $("#regbox").idealforms();
    $('.idealforms_select_menu').css({'max-height': '120px'});
    $('#regbox input[name=sex]').click(function(){
        $('#sextit').show();
    })
    /*阻塞标志，防止重复提交；预设不阻塞*/
    window.subBlock=false;
    $('#regbox').submit(function(){
        if(subBlock){
            return false;
        }
        subBlock = true;
        $.post('/login/reg', $('#regbox').serialize(), function(data){
            subBlock = false;
            if (data.code == 200) {
                clearpop(data.message,'',data.data);
            }else{
                clearpop(data.message,'',false);
            }
        });
    })

    function checkInput(){
        if(!$('#regbox input[name=nickname]').val()){
            clearpop('请输入用户名');
            $('#regbox input[name=nickname]').focus();
            return false;
        }
        var password = $('#regbox input[name=password]').val();
        if(!password){
            clearpop('请输入密码');
            $('#regbox input[name=password]').focus();
            return false;
        }
        if(password.length <4){
            clearpop('密码位数不能小于4');
            $('#regbox input[name=password]').focus();
            return false;
        }
        if(password != $('#regbox input[name=repassword]').val()){
            clearpop('两次密码输入不一致');
            $('#regbox input[name=repassword]').focus();
            return false;
        }
        var $email = $('#regbox input[name=email]').val()
        if($email && !regex($email,'email')){
            clearpop('邮箱格式不正确');
            $('#regbox input[name=repassword]').focus();
            return false;
        }
        $('#box_1').addClass('hide');
        $('#box_2').removeClass('hide');
        $('#up').show();
    }

    $('#regbox input[name=proivce]').parents().siblings('.idealforms_select_menu').find('li').click(function(){
        if(parseInt($(this).data('value'))>0){
            checkeSupsort( $(this).data('value'), $('#regbox input[name=city]').parents().siblings('.idealforms_select_menu'));
        }
    })

</script>
</body>
</html>