<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>标签添加</title>
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
    var URL="/Admin/Label";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <link rel="stylesheet" href="http://www.lovehou.com/Public/kindeditor/themes/default/default.css" />
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/upload.js?<?php echo version();?>"></script>
</head>
<body>
<form action="/Admin/Label/addLabel" method="post" name="form1" id="form1">
  <input type="hidden" name="pid" id="pid" value="0" />
  <table border="0" cellspacing="1" cellpadding="3" class="MainTbl">
    <tr class="toolbar">
      <td colspan="2" class="tc">【 添加标签 】</td>
    </tr>
    <tr class="row0">
      <td class="col1" width="140" >标签名：</td>
      <td><input type="text" class="inputText1" id="name" name="name" maxlength="100" value="" />
        <span class="fc_red">* 不能重复</span></td>
    </tr>
    <tr class="row0">
      <td class="col1">描述：</td>
      <td><input type="text" class="inputText1" name="remark" id="remark" maxlength="100" value="" /></td>
    </tr>
    <tr class="row0">
      <td class="col1">HTML代码：<br />
        <input type="button" value="编辑器" class="btn2" id="btnEditor" /></td>
      <td><textarea type="text" class="inputText1 editor1" name="info" id="info" ></textarea></td>
    </tr>
    <tr class="row0">
      <td class="col1">排序：</td>
      <td><input type="text" class="inputText1 numeric w50" name="sort" id="sort" maxlength="10" value="<?php echo ($sort); ?>" /></td>
    </tr>
    <tr class="row0">
      <td class="col1">状态：</td>
      <td><select name="status" id="status">
          <option value="1">启用</option>
          <option value="0">禁用</option>
        </select></td>
    </tr>
    <tr class="footer">
      <td colspan="2" class="tc"><input type="submit" class="btn1" value="保存" />
        <input type="button" class="btn1" value="返回" onclick="history.back();" /></td>
    </tr>
  </table>
</form>
 
<script language="JavaScript" type="text/javascript" >

    $("#form1").idealforms();
    upload.prototype.createContent("#info",'info',1);
</script>
</body>
</html>