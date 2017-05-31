<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码</title>
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
    var URL="/Admin/System";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body>
<form action="/Admin/System/pwd" method="post" name="form1"
		id="form1"> 
  <table border="0" cellspacing="1" cellpadding="3" class="MainTbl">
    <tr class="toolbar">
      <td colspan="2" class="tc">【 修改密码 】</td>
    </tr>
   
     <tr class="row0">
      <td class="col1" width="140">原密码：</td>
      <td><input type="password" class="inputText1 " name="userpwd" id="userpwd" maxlength="100" value="" /></td>
    </tr>
     <tr class="row0">
      <td class="col1">新密码：</td>
      <td><input type="password" class="inputText1 " name="userpwd1" id="userpwd1" maxlength="100" value="" /></td>
    </tr>
     <tr class="row0">
      <td class="col1">确认密码：</td>
      <td><input type="password" class="inputText1 " name="userpwd2" id="userpwd2" maxlength="100" value="" /></td>
    </tr>
    
    <tr class="footer">
      <td colspan="2" class="tc"><input type="submit" class="btn1"
					value="保存" />
        <input type="button" class="btn1" value="返回"
					onclick="history.back();" /></td>
    </tr>
  </table>
</form>

</body>
</html>