<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
<title>会员列表</title>
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
	<form action="" method="get" name="form1" id="selectInfo">
		<input type="hidden" name="status" id="status" value="<?php echo I('status');?>" />
		<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
			<tr>
				<td>
                    <span class="fl">关 键 词<input type="text" class="inputText1" id="keyword"
					name="keyword" value="<?php echo ($keyword); ?>" style="width: 200px;margin:  0 10px;" placeholder="请输入会员名、电话、QQ"/></span>
                    <span class="fl rtop8" style="margin: 0 10px;">城市</span>
                    <div class="idealforms_select fl" style="width: 120px;" >
                        <div class="idealforms_select_obj" >
                            <input type="hidden" value="" name="proivce">
                            <input type="text" value="" readonly>
                            <span class="icaret"></span>
                        </div>
                        <ul class="idealforms_select_menu" style="text-indent: 10px;">
                            <li data-value="">--请选择--</li>
                            <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-value="<?php echo ($vo['aid']); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="idealforms_select fl" style="width: 120px;" >
                        <div class="idealforms_select_obj" >
                            <input type="hidden" value="" name="city">
                            <input type="text" value="" readonly>
                            <span class="icaret"></span>
                        </div>
                        <ul class="idealforms_select_menu" style="text-indent: 10px;">
                            <li data-value="">--请选择--</li>
                        </ul>
                    </div>
                    <input type="submit" class="btn1 rtop2" value="查询" />

                </td>
			</tr>
			<tr>
				<td>会员类型： <a href="<?php echo U('Member/member');?>" >全部</a>
					<?php if(is_array($levels)): $i = 0; $__LIST__ = $levels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/admin/member/member.html?levelid=<?php echo ($vo["id"]); ?>" <?php if(($level) == $vo['id']): ?>class="fc_red"<?php endif; ?>><?php echo ($vo["name"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
				</td>
			</tr>
		</table>
	</form>
	<div class="dot"></div>
	<table border="0" cellpadding="3" cellspacing="1" class="MainTbl">
		<tr class="toolbar">
			<td colspan="9" class="tc">【 管理会员 】</td>
		</tr>
		<tr>
			<td width="60">ID</td>
			<td width="120">用户名</td>
			<td width="100">联系电话</td>
			<td width="130">Email/QQ</td>
			<td width="">城市</td>
			<td width="120">等级</td>
			<td width="120">注册时间</td>
			<td width="110">操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>">
			<td><?php echo ($vo["uid"]); ?></td>
			<td><?php echo ($vo["nickname"]); ?></td>
			<td><?php echo ($vo["tel"]); ?> </td>
			<td><?php echo ($vo["email"]); ?>/<?php echo ($vo["qqid"]); ?></td>
			<td><?php if($vo['proivce'] && $vo['city']): echo getAreaByAid($vo['proivce']);?>-<?php echo getAreaByAid($vo['city']);?>
                <?php elseif($vo['proivce'] && !$vo['city']): ?>
                <?php echo getAreaByAid($vo['proivce']);?>
                <?php else: ?>
                <?php echo getAreaByAid($vo['city']); endif; ?></td>
			<td><?php echo ($vo["levelname"]); ?></td>
			<td><?php echo ($vo["createtime"]); ?></td>
			<td><a href="/admin/member/editMember.html?id=<?php echo ($vo["uid"]); ?>"
				class="btnEdit">修改</a>
                <a class="btnDel" href="javascript:void(0);"
				onclick="var url='/admin/member/deleteMember.html?id=<?php echo ($vo["uid"]); ?>';if(confirm('您确定删除该记录吗？')){location=url;}">删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		 
		<tr class="row0">
			<td colspan="10" class="tr"><input type="hidden" value="member"
				id="ConstTbl" name="ConstTbl" /> <input type="button" class="btn2"
				value="批量删除" id="AllDel" /> <input type="button" class="btn1"
				value="全选" id="AllCheck" /> <input type="button" class="btn1"
				value="反选" id="ReverseCheck" /></td>
		</tr>
		<tr class="footer">
			<td colspan="10"><div class="page"><?php echo ($page); ?></div></td>
		</tr>
	</table>
	
<script>
    $("#selectInfo").idealforms();
    $('#selectInfo input[name=proivce]').parents().siblings('.idealforms_select_menu').find('li').click(function(){
        if(parseInt($(this).data('value'))>0){
            checkeSupsort( $(this).data('value'), $('#selectInfo input[name=city]').parents().siblings('.idealforms_select_menu'));
        }
    })
</script>
</body>
</html>