<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>节点添加</title>
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

	<form action="/Admin/Rbac/addNode" method="post" name="form1"
		id="form1">
		<input type="hidden" name="level" id="level" value="<?php echo ($level); ?>" />
		<table border="0" cellspacing="1" cellpadding="3" class="MainTbl">
			<tr class="toolbar">
				<td colspan="2" class="tc">【 添加节点 】</td>
			</tr>
			<tr class="row0">
				<td class="col1" width="200">上级：</td>
				<td><select name="pid" id="pid">
						<option value="0">顶级</option>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($pid == $vo['id'])): ?><option value="<?php echo ($vo["id"]); ?>" selected="selected"><?php echo ($vo["title"]); ?></option>
						<?php else: ?>
						<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endif; ?> <?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i; if(($pid == $action['id'])): ?><option value="<?php echo ($action["id"]); ?>" selected="selected">
							<?php echo(str_repeat("&nbsp;",4));?>
							|-<?php echo ($action["title"]); ?>
						</option>
						<?php else: ?>
						<option value="<?php echo ($action["id"]); ?>">
							<?php echo(str_repeat("&nbsp;",4));?>
							|-<?php echo ($action["title"]); ?>
						</option><?php endif; ?> <?php if(is_array($action["child"])): $i = 0; $__LIST__ = $action["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i; if(($pid == $method['id'])): ?><option value="<?php echo ($method["id"]); ?>" selected="selected">
							<?php echo(str_repeat("&nbsp;",8));?>
							<?php echo(str_repeat("&nbsp;",8));?>
							|-<?php echo ($method["title"]); ?>
						</option>
						<?php else: ?>
						<option value="<?php echo ($method["id"]); ?>">
							<?php echo(str_repeat("&nbsp;",8));?>
							|-<?php echo ($method["title"]); ?>
						</option><?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
				</select></td>
			</tr>
			<tr class="row0">
				<td class="col1" width="200">类型：</td>
				<td><?php if(($level == 1)): ?>应用(App)<?php endif; ?> <?php if(($level == 2)): ?>模块(Action)<?php endif; ?> <?php if(($level == 3)): ?>方法(Handle)<?php endif; ?></td>
			</tr>
			<tr class="row0">
				<td class="col1" width="200">节点名：</td>
				<td><input type="text" class="inputText1" id="name" name="name"
					maxlength="100" value="" /> <span class="fc_red">* 英文</span></td>
			</tr>
			<tr class="row0">
				<td class="col1" width="200">显示名称：</td>
				<td><input type="text" class="inputText1" id="title"
					name="title" maxlength="100" value="" /> <span class="fc_red">*</span></td>
			</tr>
			<tr class="row0">
				<td class="col1" width="200">行为地址：</td>
				<td><input type="text" class="inputText1" id="url"
					name="url" maxlength="100" value="" /> </td>
			</tr>
			<tr class="row0">
				<td class="col1">描述：</td>
				<td><input type="text" class="inputText1" name="remark"
					id="remark" maxlength="100" value="" /></td>
			</tr>
			<tr class="row0">
				<td class="col1">排序：</td>
				<td><input type="text" class="inputText1 numeric w50"
					name="sort" id="sort" maxlength="10" value="<?php echo ($sort); ?>" /></td>
			</tr>
			<tr class="row0">
				<td class="col1">超级：</td>
				<td><select name="super" id="super">
						<option value="0">否</option>
						<option value="1">是</option>
				</select></td>
			</tr>
			<tr class="row0">
				<td class="col1">状态：</td>
				<td><select name="status" id="status">
						<option value="1">显示</option>
						<option value="0">隐藏</option>
				</select></td>
			</tr>
			<tr class="footer">
				<td colspan="2" class="tc"><input type="submit" class="btn1"
					value="保存" /> <input type="button" class="btn1" value="返回"
					onclick="history.back();" /></td>
			</tr>
		</table>
	</form>
	
</body>
</html>