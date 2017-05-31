<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>等级列表</title>
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
<body data-maxlevel="<?php echo ($maxlevel); ?>">
<table border="0" class="mytables" style="width: 100%;">
		<thead>
            <td colspan="6" class="tc">【 管理等级 】</td>
		</thead>
		<tr align="center">
			<th width="50">ID</th>
			<th>等级名称</th>
			<th width="50">等级</th>
			<th >所需积分</th>
			<th width="50">状态</th>
			<th width="110">操作</th>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr  align="center" id="row_<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" data-level="<?php echo ($vo["level"]); ?>" data-integrate="<?php echo ($vo["integrate"]); ?>">
			<td><?php echo ($vo["id"]); ?></td>
			<td><a href="<?php echo U('Member/member','searchtype=4&keyword='.$vo['id']);?>"><?php echo ($vo["name"]); ?></a></td>
			<td><?php echo ($vo["level"]); ?></td>
			<td><?php echo ($vo["integrate"]); ?></td>

			<td><?php if(($vo["status"] == 1)): ?><a
					href="javascript:void(0);"
					onclick="setVal('level','status',<?php echo ($vo["id"]); ?>,-1,this,'禁用')">启用</a> <?php else: ?>
				<a href="javascript:void(0);"
					onclick="setVal('level','status',<?php echo ($vo["id"]); ?>,1,this,'启用')">禁用</a><?php endif; ?></td>
			<td> <a href="javascript:showlevelbox('<?php echo ($vo["id"]); ?>');" >修改</a>
				<a href="javascript:delLevel('<?php echo ($vo["id"]); ?>');" >删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr><td align="right" colspan="6" > <a href="javascript:showlevelbox();" style="margin-right: 50px;;">添加</a></td></tr>
	</table>
	

    <form id="levelbox" style="display: none" onsubmit="return false;" >
        <input type="hidden" name="id"/>
        <div class="form-group">
            <label for="exampleInputname">等级名</label><input type="text" name="name" class="form-control" id="exampleInputname" />
        </div>
        <div class="form-group">
            <label for="exampleInputlevel">等级</label><input type="text" name="level" class="form-control" id="exampleInputlevel" value="" readonly/>
        </div>
        <div class="form-group">
            <label for="exampleInputintegrate">所需积分</label><input type="text" name="integrate" class="form-control" id="exampleInputintegrate" />
        </div>
        <button type="submit" class="btn btn-default" onclick="modifylevel();">提交</button>
    </form>
<script>
    function showlevelbox(id) {
        if(id){
            $('#levelbox input[name=id]').val(id);
            $('#levelbox input[name=name]').val($('#row_'+id).data('name'));
            $('#levelbox input[name=level]').val($('#row_'+id).data('level'));
            $('#levelbox input[name=integrate]').val($('#row_'+id).data('integrate'));
        }else{
            $('#levelbox input[name=level]').val(parseInt($('body').data('maxlevel'))+1);
        }

        getMask().maskShow({"tit": "添加/修改等级","width":480, "cont": "#levelbox"});
    }

    function delLevel($id){
        if(confirm('您确定删除该记录吗？')){
            $.post('/admin/member/delLevel.html',{id:$id},function(data){
                clearpop(data.message);
                if(data.code == 200){
                    $('#row_'+$id).remove();
                }
            })
        }
    }

    function modifylevel(){
        var id = $('#levelbox input[name=id]').val();
        var name = $('#levelbox input[name=name]').val();
        var level = $('#levelbox input[name=level]').val();
        var integrate = $('#levelbox input[name=integrate]').val();
        $.post('/admin/member/modifylevel.html',{id:id,name:name,level:level,integrate:integrate},function(data){
            if(data.code == 200){
                clearpop(data.message,'','self');
            }else{
                clearpop(data.message);
            }
        })
    }
</script>
</body>
</html>