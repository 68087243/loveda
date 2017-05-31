<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
<title>标签列表</title>
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


</head>
<body>
<form action="" method="get" name="form1" id="form1">
  <input type="hidden" name="status" id="status" value="<?php echo I('status');?>" />
  <table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
    <tr>
      <td>关 键 词：
        <input type="text" class="inputText1" id="keyword" name="keyword" value="<?php echo ($keyword); ?>" />
        <select id="searchtype" name="searchtype">
          <option value="0">标签名</option>
          <?php if(($searchtype) == "1"): ?><option value="1" selected="selected">描述</option>
          <?php else: ?>
          <option value="1">描述</option><?php endif; ?>
        </select>
        <input type="submit" class="btn1" value="查询" /></td>
    </tr>
    <tr>
      <td>标签状态： <a href="<?php echo U('Label/label');?>" >全部</a>
        <?php if(($status == 1)): ?><a 	href="<?php echo U('Label/label','status=1');?>" class="fc_red">启用</a>
          <?php else: ?>
          <a href="<?php echo U('Label/label','status=1');?>">启用</a><?php endif; ?>
        <?php if(($status == '0')): ?><a 	href="<?php echo U('Label/label','status=0');?>" class="fc_red">禁用</a>
          <?php else: ?>
          <a href="<?php echo U('Label/label','status=0');?>">禁用</a><?php endif; ?></td>
    </tr>
  </table>
</form>
<div class="dot"></div>
<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
  <tr class="toolbar">
    <td colspan="5" class="tc">【 管理标签 】</td>
  </tr>
  <tr class="row0">
    <td colspan="5"><a href="<?php echo U('Admin/Label/addLabel');?>"
				class="btnAdd">添加</a></td>
  </tr>
  <tr class="header">
    <td width="50">ID</td>
    <td  >标签名</td>
    <td  >描述</td>
    <td width="50">状态</td>
    <td width="110">操作</td>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>">
      <td><input type="checkbox" name="SelectIDs" value="<?php echo ($vo["id"]); ?>" />
        <?php echo ($vo["id"]); ?></td>
      <td><?php echo ($vo["name"]); ?></td>
      <td><?php echo ($vo["remark"]); ?></td>
      <td><?php if(($vo["status"] == 1)): ?><a href="javascript:void(0);" onclick="setVal('label','status',<?php echo ($vo["id"]); ?>,0,this,'禁用')">启用</a>
          <?php else: ?>
          <a href="javascript:void(0);" onclick="setVal('label','status',<?php echo ($vo["id"]); ?>,1,this,'启用')">禁用</a><?php endif; ?></td>
      <td><?php if(($vo['status'] == 3) Or ($vo['status'] == 4)): ?><a href="<?php echo U('Label/editLabel','id='.$vo['id']);?>" class="btnEdit">查看</a>
          <?php else: ?>
          <a href="<?php echo U('Label/editLabel','id='.$vo['id']);?>" class="btnEdit">修改</a> <a class="btnDel" href="javascript:void(0);" onclick="var url='<?php echo U("Label/deleteLabel","id=".$vo['id']);?>';if(confirm('您确定删除该记录吗？')){location=url;}">删除</a><?php endif; ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  <tr class="row0">
    <td colspan="7" class="tr"><input type="hidden" value="label"
				id="ConstTbl" name="ConstTbl" />
      <input type="button" class="btn2"
				value="批量删除" id="AllDel" />
      <input type="button" class="btn1"
				value="全选" id="AllCheck" />
      <input type="button" class="btn1"
				value="反选" id="ReverseCheck" /></td>
  </tr>
  <tr class="footer">
    <td colspan="7"><div class="page"><?php echo ($page); ?></div></td>
  </tr>
</table>

</body>
</html>