<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>相册/上传管理</title>
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


    <script>
        var APP_PATH="";
        var CONST_PUBLIC="http://www.lovehou.com/Public";
    </script>
</head>
<body>
<form action="" method="get" name="selectinfo" id="selectinfo" style="width: 98%;margin: 0 auto;">
    <input type="hidden" name="status" id="status" value="<?php echo I('status');?>" />
    <span  class="fl" >关键字：</span>
    <input type="text" class="fl" style="width: 150px;" placeholder="用户名或备注" id="keyword" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>"/>

    <span style="margin:0 10px;" class=" fl">类型</span>
    <div class="idealforms_select fl"style="width:125px;">
        <div class="idealforms_select_obj" >
            <input type="hidden" value="" name="type">
            <input type="text" value="" readonly>
            <span class="icaret"></span>
        </div>
        <ul class="idealforms_select_menu">
            <li data-value="">请选择</li>
            <li data-value="1">头像</li>
            <li data-value="2" >相片</li>
        </ul>
    </div>
    <span style="margin-left: 10px;" class="fl">状态:&nbsp;</span>
    <ul style="margin:0" >
        <li><label for="radio1" class="fontn clo3"><input type="radio" id="radio1" name="status" value=""/>全部</label></li>
        <li><label for="radio2" class="fontn clo3"><input type="radio" id="radio2" name="status" value="0"/>待审核</label></li>
        <li><label for="radio3" class="fontn clo3"><input type="radio" id="radio3" name="status"  value="1" />审核通过</label></li>
        <li><label for="radio4" class="fontn clo3"><input type="radio" id="radio4" name="status"  value="2" />审核不通过</label></li>
    </ul>
    <input type="submit" class="sure_btn" value="查询"  />
</form>

<div id="autotab_1">
    <table border="0"class="mytables" style="width: 98%; margin: 0 auto">
        <tr>
            <th width="5%" class="tc">ID</th>
            <th width="10%" class="tc">图片</th>
            <th width="7%" class="tc">用户</th>
            <th width="5%" class="tc">状态</th>
            <th width="5%" class="tc">读取</th>
            <th class="tc">备注</th>
            <th width="10%" class="tc">操作</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="banner_<?php echo ($vo["id"]); ?>">
                <td><?php echo ($vo["id"]); ?></td>
                <td><img src="http://www.lovehou.com/Public/<?php echo ($vo["img"]); ?>" width="120" alt=""/></td>
                <td><?php echo ($vo["nickname"]); ?></td>
                <td> <?php if($vo['type'] == 1): ?>照片<?php else: ?>头像<?php endif; ?></td>
                <td><?php echo ($vo["read"]); ?></td>
                <td align="left"><?php echo ($vo["note"]); ?></td>
                <td style="text-align: center">
                    <?php if($vo['status'] == 0): ?><select name="" onchange="passShow(this,'<?php echo ($vo["id"]); ?>');">
                            <option value="1">待审核</option>
                            <option value="1">审核通过</option>
                            <option value="2">不通过</option>
                        </select>
                        <?php elseif($vo['status'] == 1): ?>
                        审核通过
                        <?php else: ?>
                        不通过<?php endif; ?>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>

<form  role="form"  id="passform" onsubmit="return false" style="display: none">
    <input type="hidden" name="id"/>
    <input type="hidden" name="status"/>
    <div class=" form-group">
        <span>备注:</span>&nbsp;&nbsp;
        <input type="text" style="width: 400px;" name="note" placeholder="请填写备注,100字符以内"/>
    </div>
    <button id="modifyBanner" class="common_btn" onclick="passImg();">直接提交</button>
</form>

<script>
    $("#selectinfo").idealforms();
    $('.idealform .idealradio .radio, .idealform .idealcheck .radio').css({'top':'0'});
    setRadioCheck('#selectinfo input[name=status]',"<?php echo ($_REQUEST['status']); ?>");

    setSelectSelected('#selectinfo input[name=type]',"<?php echo ($_REQUEST['type']); ?>");
    function passShow(obj,$id){
        $('#passform input[name=id]').val($id);
        $('#passform input[name=status]').val($(obj).val());
        $("#passform").idealforms();
        if($(obj).val()==2){
            $('#modifyBanner').html('保存');
            $('#passform input[name=note]').attr('placeholder','请填写审核不通过的原因,100字符以内');
        }else{
            $('#modifyBanner').html('直接提交');
            $('#passform input[name=note]').attr('placeholder','请填写备注,100字符以内');
        }
        getMask().maskShow({"tit": "审核备注","width":480, "cont": "#passform"});
    }
    function passImg(){
        var $id =$('#passform input[name=id]').val();
        var status =$('#passform input[name=status]').val();
        var note =$('#passform input[name=note]').val();
        if(status == 2 && !note){
            clearpop('请填写审核失败的原因！');
            return false;
        }
        $.post('/admin/member/modifyPhoto.html',{id:$id,status:status,note:note},function(data){
            closeMask();
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