<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>节点列表</title>
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
    var URL="/Admin/Rbac";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body>
	<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
		<tr class="toolbar">
			<td colspan="6" class="tc">【 管理节点 】</td>
		</tr>
		<tr class="row0">
			<td colspan="6"><a href="<?php echo U('Admin/Rbac/addNode');?>"
				class="btnAdd">添加</a></td>
		</tr>
		<tr class="header">
			<td width="50">ID</td>
			<td>节点名称</td>
			<td>节点描述</td>
			<td width="70">排序</td>
			<td width="50">状态</td>
			<td width="150">操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>">
			<td><?php echo ($vo["id"]); ?></td>
			<td><?php echo ($vo["title"]); ?>【<?php echo ($vo["name"]); ?>】</td>
			<td><?php echo ($vo["remark"]); ?>&nbsp;</td>
			<td><input name="Item_1" id="Item_1"
				onchange="setVal('node','sort',<?php echo ($vo["id"]); ?>,$(this).val())"
				class="inputText1 numeric w50" value="<?php echo ($vo["sort"]); ?>" /></td>
			<td><?php if(($vo["status"] == 1)): ?><a
					href="javascript:void(0);"
					onclick="setVal('node','status',<?php echo ($vo["id"]); ?>,0,this,'隐藏')">显示</a> <?php else: ?>
				<a href="javascript:void(0);"
					onclick="setVal('node','status',<?php echo ($vo["id"]); ?>,1,this,'显示')" class="fc_red">隐藏</a><?php endif; ?></td>
			<td><a href="<?php echo U('Rbac/addNode',Array("pid"=>$vo["id"],"level"=>$vo["level"]));?>"
				class="btnAdd">添加</a> <a
				href="<?php echo U('Rbac/editNode','id='.$vo['id']);?>" class="btnEdit">修改</a>
				<a class="btnDel" href="javascript:void(0);"
				onclick="var url='<?php echo U("Rbac/deleteNode","id=".$vo['id']);?>';if(confirm('您确定删除该记录吗？')){location=url;}">删除</a></td>
		</tr>
		<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><tr class="row1">
			<td><?php echo ($action["id"]); ?></td>
			<td><?php echo(str_repeat("&nbsp;",4));?>|-<?php echo ($action["title"]); ?>【<?php echo ($action["name"]); ?>】</td>
			<td><?php echo ($action["remark"]); ?>&nbsp;</td>
			<td><input name="Item_1" id="Item_1"
				onchange="setVal('node','sort',<?php echo ($action["id"]); ?>,$(this).val())"
				class="inputText1 numeric w50" value="<?php echo ($action["sort"]); ?>" /></td>
			<td><?php if(($action["status"] == 1)): ?><a
					href="javascript:void(0);"
					onclick="setVal('node','status',<?php echo ($action["id"]); ?>,0,this,'隐藏')">显示</a> <?php else: ?>
				<a href="javascript:void(0);"
					onclick="setVal('node','status',<?php echo ($action["id"]); ?>,1,this,'显示')" class="fc_red">隐藏</a><?php endif; ?></td>
			<td><a href="<?php echo U('Rbac/addNode',Array("pid"=>$action["id"],"level"=>$action["level"]));?>"
				class="btnAdd">添加</a> <a
				href="<?php echo U('Rbac/editNode','id='.$action['id']);?>" class="btnEdit">修改</a>
				<a class="btnDel" href="javascript:void(0);"
				onclick="var url='<?php echo U("Rbac/deleteNode","id=".$action['id']);?>';if(confirm('您确定删除该记录吗？')){location=url;}">删除</a></td>
		</tr>
		
		<?php if(is_array($action["child"])): $i = 0; $__LIST__ = $action["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><tr class="row1">
			<td><?php echo ($method["id"]); ?></td>
			<td><?php echo(str_repeat("&nbsp;",8));?>|-<?php echo ($method["title"]); ?>【<?php echo ($method["name"]); ?>】</td>
			<td><?php echo ($method["remark"]); ?>&nbsp;</td>
			<td><input name="Item_1" id="Item_1"
				onchange="setVal('node','sort',<?php echo ($method["id"]); ?>,$(this).val())"
				class="inputText1 numeric w50" value="<?php echo ($method["sort"]); ?>" /></td>
			<td><?php if(($method["status"] == 1)): ?><a
					href="javascript:void(0);"
					onclick="setVal('node','status',<?php echo ($method["id"]); ?>,0,this,'隐藏')">显示</a> <?php else: ?>
				<a href="javascript:void(0);"
					onclick="setVal('node','status',<?php echo ($method["id"]); ?>,1,this,'显示')" class="fc_red">隐藏</a><?php endif; ?></td>
			<td><a
				href="<?php echo U('Rbac/editNode','id='.$method['id']);?>" class="btnEdit">修改</a>
				<a class="btnDel" href="javascript:void(0);"
				onclick="var url='<?php echo U("Rbac/deleteNode","id=".$method['id']);?>';if(confirm('您确定删除该记录吗？')){location=url;}">删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

	</table>
	
</body>
</html>