<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>地区列表</title>
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
<body class="bg_white">
<div class="page_title"> 热词管理</div>
<div class="container">
    <table class="mytables" id="area_table" style="width: 100%;margin: 0 auto; " >
        <tr>
            <th width="5%">ID</th>
            <th>名称</th>
            <th width="5%">排序</th>
            <th width="8%">状态</th>
            <th width="10%">编辑</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="list_<?php echo ($vo["id"]); ?>" data-nameen="<?php echo (stripslashes($vo["name"])); ?>" data-namecn="<?php echo ($vo["namecn"]); ?>" data-deliver_fee="<?php echo ($vo["deliver_fee"]); ?>" data-status="<?php echo ($vo["status"]); ?>">
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo (stripslashes($vo["name"])); ?></td>
                <td><?php echo ($vo["namecn"]); ?></td>
                <td><?php echo ($vo["deliver_fee"]); ?></td>
                <td><input type="text" style="width: 50px;" onkeyup="rank('<?php echo ($vo["id"]); ?>',$(this).val())" value="<?php echo ($vo["rank"]); ?>"/> </td>
                <td align="center">
                    <?php if($vo['status'] == 1): ?><a href="javascript:setStatus('<?php echo ($vo["id"]); ?>',0)">启用</a>
                        <?php else: ?>
                        <a href="javascript:setStatus('<?php echo ($vo["id"]); ?>',1)">禁用</a><?php endif; ?>
                </td>
                <td align="center">
                    <a href="javascript:showBox('<?php echo ($vo["id"]); ?>')">修改</a>
                    <a href="javascript:setStatus('<?php echo ($vo["id"]); ?>',-1)">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td colspan="6" align="right"  style="height: 40px;;">
                <input type="submit" class="sure_btn" value="新增" onclick="showBox()" />
            </td>
        </tr>
    </table>
</div>

<div id="area_box" class="hide">
    <form onsubmit="return false" id="area_form">
        <input type="hidden" name="id"/>
        <div class="row_item">
            <span>英文名：</span>
            <input type="text" class="input_text2" name="nameen" />
        </div>
        <div class="row_item">
            <span>中文名：</span>
            <input type="text" class="input_text2" name="namecn" />
        </div>
        <div class="row_item">
            <span>运&nbsp;&nbsp;&nbsp;费：</span>
            <textarea name="deliver_fee" style="width: 308px;height: 50px;overflow: auto;resize: none" ></textarea>
        </div>
        <div class="row_item">
            <span class="fl">状&nbsp;&nbsp;&nbsp;态 ：</span>
            <div class="idealforms_select fl">
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="status">
                    <input type="text" value="" readonly>
                    <span class="caret"></span>
                </div>
                <ul class="idealforms_select_menu">
                    <li data-value="1">启用</li>
                    <li data-value="2">禁止</li>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
        <div class="tc row_item">
            <input type="submit" onclick="modifyArea()" class="sure_btn" value="提交" />
        </div>
    </form>
</div>
<script>
    $("#area_form").idealforms();
    function showBox($id){
        $('#area_box input[name=id]').val($id);
        $('#area_box input[name=nameen]').val($('.list_'+$id).data('nameen'));
        $('#area_box input[name=namecn]').val($('.list_'+$id).data('namecn'));
        $('#area_box textarea[name=deliver_fee]').val($('.list_'+$id).data('deliver_fee'));
        if($id){
            setSelectSelected('#area_box input[name=status]',$('.list_'+$id).data('status'));
        }
        getMask().maskShow({"tit": "添加/修改地区","width":420, "cont": "#area_box"});
    }

    //提交编辑
    function modifyArea(){
        var id = $('#area_box input[name=id]').val(),
                name = $('#area_box input[name=nameen]').val(),
                namecn = $('#area_box input[name=namecn]').val(),
                deliver_fee = $('#area_box textarea[name=deliver_fee]').val(),
                status = $('#area_box input[name=status]').val();
        if(!name){
            clearpopj('必须填写英文名','error',true);
            return false;
        }
        $.post('/admin/cms/modifyArea.html',{id:id,name:name,namecn:namecn,deliver_fee:deliver_fee,status:status},function(data){
            if(data.code == 200){
                clearpop(data.message,'','self');
            }else{
                clearpopj(data.message,'error',true);
            }
        })
    }

    //提交编辑
    function rank(id,rank){
        $.post('/admin/cms/modifyArea.html',{id:id,rank:rank},function(data){
            if(data.code == 200){
                clearpop(data.message,'','self');
            }else{
                clearpopj(data.message,'error',true);
            }
        })
    }

    function setStatus($id ,status){
        $.post('/admin/cms/modifyArea.html',{id:$id,status:status},function(data){
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