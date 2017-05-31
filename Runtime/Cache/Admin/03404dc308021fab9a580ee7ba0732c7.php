<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容列表</title>
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
    var URL="/Admin/Cms";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body>
	<form action="" method="get" name="form1" id="myform" style="width: 95%;margin: 0 auto;">
        <span  class="fl" >关 键 词：</span>
        <input type="text" class="fl" style="width: 220px;" id="keyword" name="keyword" placeholder="帖子标题、内容、用户名、用户ID等关键字" value="<?php echo ($_REQUEST['keyword']); ?>"/>
        <span style="margin:0 10px;" class=" fl">类型</span>
        <div class="idealforms_select fl"style="width:125px;">
            <div class="idealforms_select_obj" >
                <input type="hidden" value="" name="type">
                <input type="text" value="" readonly>
                <span class="icaret"></span>
            </div>
            <ul class="idealforms_select_menu">
                <li data-value="">请选择</li>
                <li data-value="1">帖子</li>
                <li data-value="3" >富豪包养</li>
            </ul>
        </div>
        <span style="margin-left: 10px;" class="fl">状态:&nbsp;</span>
        <ul style="margin:0" >
            <li><label for="radio11" class="fontn clo3"><input type="radio" id="radio11" name="status" value=""/>全部</label></li>
            <li><label for="radio12" class="fontn clo3"><input type="radio" id="radio12" name="status" value="1"/>启用</label></li>
            <li><label for="radio13" class="fontn clo3"><input type="radio" id="radio13" name="status"  value="-1" />禁用</label></li>
        </ul>
        <input type="submit" class="sure_btn" value="查询"  />
	</form>
	<div class="dot"></div>
	<table border="0" class="mytables" style="width: 95%;margin: 0 auto">
		<tr class="toolbar">
			<td colspan="7" class="tc">【 管理内容 】</td>
		</tr>
		<tr class="row0 hide">
			<td colspan="7"><a href="<?php echo U('Admin/Cms/addContent');?>"
				class="btnAdd">添加</a></td>
		</tr>
		<tr class="header">
			<th width="60">ID</th>
            <th width="70">用户</th>
            <th width="100">分类</th>
            <th width="100">类型</th>
			<th>标题</th>
			<th width="70">排序</th>
			<th width="50">推荐</th>
			<th width="50">状态</th>
			<th width="110">操作</th>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>" data="<?php echo ($vo["indexpic"]); ?>">
			<td><?php echo ($vo["tid"]); ?></td>
			<td><?php echo ($vo["nickname"]); ?></td>
			<td><?php echo getClubnameByCid($vo['cid']);?></td>
			<td><?php if($vo['type'] == 1): ?>帖子<?php else: ?>悬赏<?php endif; ?></td>
			<td><?php echo ($vo["title"]); ?></td>
			<td><input name="Item_1" onchange="setVal('topic','rank','<?php echo ($vo["tid"]); ?>',$(this).val())"
				class="inputText1 numeric w50" value="<?php echo ($vo["rank"]); ?>" />
            </td>
			<td>
                <?php if(($vo["recommend"] == 1)): ?><a href="javascript:void(0);" onclick="setVal('topic','recommend','<?php echo ($vo["tid"]); ?>',0)" class="red">推荐</a>
				<?php else: ?>
                    <a href="javascript:void(0);" onclick="setVal('topic','recommend','<?php echo ($vo["tid"]); ?>',1)">未推荐</a><?php endif; ?>
            </td>
			<td>
                <?php if(($vo["status"] == 1)): ?><a href="javascript:void(0);" onclick="setVal('topic','status','<?php echo ($vo["tid"]); ?>',-1,this,'禁用')"  class="fc_red">启用</a>
                <?php else: ?>
				    <a href="javascript:void(0);" onclick="setVal('topic','status','<?php echo ($vo["tid"]); ?>',1,this,'启用')">禁用</a><?php endif; ?>
            </td>
			<td>
                <a href="/admin/cms/topicinfo.html?tid=<?php echo ($vo['tid']); ?>" >修改</a>&nbsp;&nbsp;
                <!--<a  href="javascript:void(0);" onclick="if(confirm('您确定删除该记录吗？'))location='/admin/Cms/delContent.html?id=<?php echo ($vo["id"]); ?>';">删除</a>-->
            </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>

		<!--<tr align="right">-->
			<!--<td colspan="6"> <a href="/admin/cms/topicinfo.html" type="button" class="btn btn-default" >添加</a></td>-->
		<!--</tr>-->
		<tr class="footer">
			<td colspan="8"><div class="page"><?php echo ($page); ?></div></td>
		</tr>
	</table>
	
<script language="javascript" type="text/javascript">
$(function(){
    $("#myform").idealforms();
    setRadioCheck('#myform input[name=status]',"<?php echo ($_REQUEST['status']); ?>");
    setSelectSelected('#myform input[name=type]',"<?php echo ($_REQUEST['type']); ?>");
    $('.idealform .idealradio .radio, .idealform .idealcheck .radio').css({'top':'0'});
});
</script>
</body>
</html>