<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
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
    var URL="/Admin/Index";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body > 
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="MainTbl">
  <tr class="row0">
    <td ><strong>登录信息</strong></td>
  </tr>
  <tr class="row0">
    <td>你好，<span class="fc_red"><?php echo Session('adminname');?></span>，欢迎使用本系统！ </td>
  </tr>
  <tr class="row0">
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="MainTbl">
        <tr>
          <td align="right" width="100">登录次数：</td>
          <td><?php echo ($db["logtimes"]); ?></td>
        </tr>
        <tr>
          <td align="right" width="100">上次登录时间：</td>
          <td><?php echo ($db["lastlogtime"]); ?></td>
        </tr>
        <tr>
          <td align="right" width="100">上次登录IP：</td>
          <td><?php echo ($db["lastlogip"]); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr class="row0">
    <td ><strong>系统信息</strong></td>
  </tr>
  <tr class="row0">
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="MainTbl">
        <tr>
          <td align="right" width="100">操作系统：</td>
          <td><?php echo PHP_OS;?></td>
        </tr>
        <tr>
          <td align="right" width="100">服务器软件：</td>
          <td><?php echo ($_SERVER['SERVER_SOFTWARE']); ?></td>
        </tr>
        <tr>
          <td align="right" width="100">PHP版本：</td>
          <td><?php echo phpversion();?></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>