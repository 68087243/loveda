<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>供应商列表</title>
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
<body  data-loguser="<?php echo ($_SESSION['adminname']); ?>">
	<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
		<tr class="toolbar">
			<td colspan="6" class="tc">【 管理供应商 】</td>
		</tr>
		<tr class="row0">
			<td colspan="6"><a href="<?php echo U('Admin/System/addSupply');?>"
				class="btnAdd">添加</a></td>
		</tr>
		<tr class="header">
			<td width="50">ID</td>
			<td>供应商名称</td>
			<td class="is_admin">供应商别名</td>
			<td>供应商描述</td>
			<td width="70">排序</td>
			<td width="50">状态</td>
			<td width="110">操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>">
			<td><?php echo ($vo["id"]); ?></td>
			<td><?php  if ($vo['depth']!=='1'){ echo(str_repeat("&nbsp;",($vo['depth']-1)*4).'|-'); }?><a href="<?php echo U('Cms/content','searchtype=4&keyword='.$vo['id']);?>"><?php echo ($vo["name"]); ?></a></td>
			<td class="is_admin"><?php echo ($vo["title"]); ?></td>
			<td><?php echo ($vo["remark"]); ?>&nbsp;</td>
			<td><input name="Item_1" id="Item_1"
				onchange="setVal('supply','sort',<?php echo ($vo["id"]); ?>,$(this).val())"
				class="inputText1 numeric w50" value="<?php echo ($vo["sort"]); ?>" /></td>
			<td><?php if(($vo["status"] == 1)): ?><a
					href="javascript:void(0);"
					onclick="setVal('supply','status',<?php echo ($vo["id"]); ?>,0,this,'禁用')">启用</a> <?php else: ?>
				<a href="javascript:void(0);"
					onclick="setVal('supply','status',<?php echo ($vo["id"]); ?>,1,this,'启用')">禁用</a><?php endif; ?></td>
			<td> <a
				href="<?php echo U('System/editSupply','id='.$vo['id']);?>" class="btnEdit">修改</a>
				<a class="btnDel" href="javascript:void(0);"
				onclick="var url='<?php echo U("System/deleteSupply","id=".$vo['id']);?>';if(confirm('您确定删除该记录吗？')){location=url;}">删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>

	</table>
	
    <script>
        var $loguser = $.trim($('body').data('loguser'));
        if($loguser == 'admin' || $loguser == 'administrator'){
            $('.is_admin').show();
        }else{
            $('.is_admin').hide();
        }
    </script>
</body>
</html>