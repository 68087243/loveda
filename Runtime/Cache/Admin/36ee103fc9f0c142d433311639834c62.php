<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统登录入口-<?php echo ($title); ?></title>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/bootstrap/css/bootstrap.min.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/admin.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/style.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.2.2.1.min.js?version=<?php echo version(2);?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/common.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/page/js/admin.js?version=<?php echo version();?>"></script>

<script type="text/javascript">
    var URL="/Admin/Login";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


<script language="javascript">
$(function(){
	$("#username").focus();
	if(self.frameElement != null && (self.frameElement.tagName == "IFRAME" || self.frameElement.tagName == "iframe")){
		window.parent.location=APP_PATH+'/Admin/Login';
	}
	$("#form2").submit(function(){ 
		var u=$.trim($("#username").val());
		var p=$.trim($("#userpwd").val());
		var v=$.trim($("#verify").val());
		if(u==""){
			$("#username").focus();
			return false;
		}
		if(p==""){
			$("#userpwd").focus();
			return false;
		}
		if(v==""){
			$("#verify").focus();
			return false;
		}
		$.ajax({
			"type":"POST",
			"url":"Login/login",
			"data":"username="+u+"&userpwd="+p+"&verify="+v+"",
			"success":function(msg){
				if(msg.status==0){
					if(msg.info.indexOf('验证码')!=-1){
						$("#verify").val("").focus();
						$("#vimg").click();
					}
					alert(msg.info);
					return false;
				}else{
					location="/admin/";	
				}
			}
		});
		return false;
	});
});
</script>
</head>
<body style="background: #e1e1e1">
<div class="container">
    <div class="row clearfix absolute"  style="width: 380px;height: 380px;left: 50%; top: 20%;margin: 0px 0 0 -170px;; background: #FFffff;border: 1px solid #CCCABA">
        <form role="form" onsubmit="return false;" style="width: 250px;margin: 0 auto; ">
            <div class="form-group" style="line-height: 35px;">
                <label class="font24">后台登录</label>
            </div>
            <div class="form-group">
                <label for="exampleInputText">账号</label><input type="text" name="username" class="form-control" id="exampleInputText" />
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label><input type="password" name="userpwd" class="form-control" id="exampleInputPassword1" />
            </div>
            <div class="form-group">
                <label for="exampleInputVerify">验证码</label>
                <input type="text" class="form-control" name="verify" style="width: 120px;" maxlength="6"  id="exampleInputVerify" />

                <img class="fr relative" style="cursor:pointer; top: -34px; width:100px; height:34px;" title="看不清楚?换一张!" alt="" onclick="this.src='/home/index/verify.html?random='+Math.random()" src="/home/index/verify.html" />
            </div>
            <div class="checkbox">
            </div><button type="submit" class="btn btn-default" onclick="loginAdmin();">登录</button>

            <div class="copyright tc" style="margin-top: 20px;">Copyright &copy; 2017 爱大叔 <br />
                <div class="clr"></div>
            </div>
        </form>
    </div>
</div>
<script>
    function loginAdmin(){
        var username =$.trim($("form input[name=username]").val());
        var pwd =$.trim($("form input[name=userpwd]").val());
        var verify =$.trim($("form input[name=verify]").val());
        if(username==""){
            clearpop('账号不能为空');
            $("form input[name=username]").focus();
            return false;
        }
        if(pwd==""){
            clearpop('密码不能为空');
            $("form input[name=userpwd]").focus();
            return false;
        }
        if(verify==""){
            clearpop('验证码不能为空');
            $("form input[name=verify]").focus();
            return false;
        }
        $.post('/admin/login/login.html',{username:username,pwd:pwd,verify:verify},function(data){
            if(data.code){
                clearpop(data.message,'',data.data);
            }else{
                clearpop(data.message);
            }
        })
    }
</script>
</body>
</html>