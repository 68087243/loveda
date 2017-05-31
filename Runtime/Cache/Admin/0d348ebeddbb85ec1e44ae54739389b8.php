<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>收支列表</title>
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
    var URL="/Admin/Member";
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
		<input type="hidden" name="type" id="type" value="<?php echo I('type');?>" />
		<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
			<tr>
				<td>关 键 词： <input type="text" class="inputText1" id="keyword"
					name="keyword" value="<?php echo ($keyword); ?>" /> <select id="searchtype"
					name="searchtype">
						<option value="0">用户名</option>
					 
				</select> <input type="submit" class="btn1" value="查询" /></td>
			</tr>
            
			<tr>
				<td>收支类型： <a href="<?php echo U('Member/balance');?>" >全部</a>
					<?php if(($type == 1)): ?><a
						href="<?php echo U('Member/balance','type=1');?>" class="fc_red">收入</a> <?php else: ?>
					<a href="<?php echo U('Member/balance','type=1');?>">收入</a><?php endif; ?> <?php if(($type == '0')): ?><a
						href="<?php echo U('Member/balance','type=0');?>" class="fc_red">支出</a> <?php else: ?>
					<a href="<?php echo U('Member/balance','type=0');?>">支出</a><?php endif; ?>
				</td>
			</tr>

			 
		</table>
	</form>
	<div class="dot"></div>
	<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
		<tr class="toolbar">
			<td colspan="8" class="tc">【 管理收支 】</td>
		</tr>
		<tr class="row0">
			<td colspan="8"><a href="<?php echo U('Admin/Member/addBalance');?>"
				class="btnAdd">添加</a></td>
		</tr>
		<tr class="header">
			<td width="60">ID</td>
			<td width="100">用户名</td>
			<td width="100">交易金额</td>
			<td width="100">上次余额</td>
			<td width="100">本次余额</td>
			<td width="120">交易时间</td>
			<td>收支描述</td>
			<td width="110">操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>">
			<td><?php echo ($vo["id"]); ?></td>
			<td><a href="<?php echo U('Member/editMember','id='.$vo['userid']);?>"><?php echo ($vo["username"]); ?></a></td>
			<td><?php if(($vo["balancetype"]) == "1"): ?>+<?php else: ?>-<?php endif; ?> <?php echo ($vo["amount"]); ?></td>
			<td><?php echo ($vo["prebalance"]); ?></td>
			<td><?php echo ($vo["balance"]); ?></td>
			<td><?php echo ($vo["addtime"]); ?></td>
			<td>【<?php echo get_iotypename($vo['balancetypeid']);?>】<?php echo ($vo["remark"]); ?></td>
			<td> <a
				href="<?php echo U('Member/editBalance','id='.$vo['id']);?>" class="btnEdit">查看</a>
				 </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>

		<tr class="footer">
			<td colspan="11"><div class="page"><?php echo ($page); ?></div></td>
		</tr>
	</table>
	
</body>
</html>