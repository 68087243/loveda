<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>参数设置</title>
    <script>
        var APP_PATH="";
        var CONST_PUBLIC="http://www.lovehou.com/Public";
    </script>
    <script type="text/javascript" src="http://www.lovehou.com/Public/js/jquery.2.2.1.min.js"></script><script type="text/javascript" src="http://www.lovehou.com/Public/js/sweetalert.min.js"></script><script type="text/javascript" src="http://www.lovehou.com/Public/js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/Admin/images/style.css" /><link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/css/sweetalert.css" /><link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/css/common.css" />
</head>
<body>
    <div style="width: 100%;height: 40px;line-height: 40px; border-top: 1px solid #cccccc;border-bottom: 1px solid #cccccc " class="tc">【 banner设置 】</div>
    <div class="tab">
        <ul class="idTabs" style="background: #EEEEEE;border: 1px solid #EEEEEE;padding: 5px;">
            <li <?php if($_REQUEST['type'] == 1 || !$_REQUEST['type']): ?>class="onselected"<?php endif; ?> ><a href="?type=1"rel="#autotab_1">网站banner</a></li>
            <li <?php if($_REQUEST['type'] == 2): ?>class="onselected"<?php endif; ?>><a href="?type=2" rel="#autotab_2">微信banner</a></li>
        </ul>
    </div>
    <div id="autotab_1">
        <table border="0" cellpadding="3" cellspacing="1" class="MainTbl" width="800">
            <tr class="header">
                <th width="5%">ID</th>
                <th width="10%">图片</th>
                <th width="25%">连接</th>
                <th>标题/介绍</th>
                <th width="50">排序</th>
                <th width="5%">状态</th>
                <th width="10%">操作</th>
            </tr>
            <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row<?php echo ($i % 2+1); ?>" id="banner_<?php echo ($vo["id"]); ?>" data-indexpic="<?php echo ($vo["indexpic"]); ?>" data-picurl="<?php echo ($vo["picurl"]); ?>" data-info="<?php echo ($vo["info"]); ?>" data-type="<?php echo ($vo["type"]); ?>" data-status="<?php echo ($vo["status"]); ?>">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><img src="http://www.lovehou.com/Public/<?php echo ($vo["indexpic"]); ?>" width="120" alt=""/></td>
                    <td><?php echo ($vo["picurl"]); ?></td>
                    <td><?php echo ($vo["info"]); ?></td>
                    <td><input type="text" size="5" value="<?php echo ($vo["rank"]); ?>" onchange="setBanner('rank','<?php echo ($vo["id"]); ?>',$(this).val())" /></td>
                    <td align="center"><?php if($vo['status'] == 1): ?><span style="cursor: pointer" onclick="setBanner('status','<?php echo ($vo["id"]); ?>',2)">启用</span><?php else: ?><span style="cursor: pointer" onclick="setBanner('status','<?php echo ($vo["id"]); ?>',1)">禁止</span><?php endif; ?></td>
                <td style="text-align: center">
                        <a href="JavaScript:uploadImage('<?php echo ($vo["id"]); ?>');" class="underline">编辑</a>
                        <a href="javascript:delBanner('<?php echo ($vo["id"]); ?>');" class="underline">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
         <!--图片上传-->
        <button onclick="uploadImage();">新增上传</button>
    </div>

    <div class=" center" id="upload_pic" style="display: none">
        <div id="clipArea" ><img src="" width="440" id="view" style="margin-top: 0" alt=""></div>
        <div class="upbanner">
            <!--<span style="font-size: 12px;color: #cccccc;">图片尺寸:1226*600</span><br/>-->
            <input type="hidden" name="id"/>
            <input type="hidden" name="indexpic"/>
            <span>图片链接:</span>&nbsp;&nbsp;<input type="text" name="picurl" placeholder="http://"/> <br/>
            <span>标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题:</span>&nbsp;&nbsp;<input type="text" placeholder="无" name="info"/><br/>
            位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;置:<label for="pc">&nbsp;<input type="radio" name="banner" checked value="1" id="pc"/>网站</label>
            <label for="wx"><input type="radio" name="banner" value="2" id="wx"/>微信</label><br/>
            状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态:<label for="pc">&nbsp;<input type="radio" name="status" checked value="1" class="qy" id="qy"/>启用</label>
            <label for="jz"><input type="radio" name="status" value="2" class="jz" id="jz"/>禁止</label><br/>
        </div>
        <input type="button" style="padding:5px 15px" value="上传" onClick="selectPic();"/>
        <!--<input type="file" id="file" class="common_btn"/>-->
        <br><button id="modifyBanner" type="button" class="common_btn" onclick="modifyBanner();" style=" margin:10px 0 0%;;padding:6px 50px;position: relative;left: 50%;margin-left: -65px;" >保存</button>
    </div>


    
    <link rel="stylesheet" href="http://www.lovehou.com/Public/kindeditor/themes/default/default.css" />
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="http://www.lovehou.com/Public/js/upload.js?<?php echo version();?>"></script>

<script>
    function uploadImage(id){
        if(id){
            $('#modifyBanner').show();
            $('#clipArea img').attr('src',CONST_PUBLIC+'/'+$('#banner_'+id).data('indexpic'));
            $('#upload_pic input[name=indexpic]').val($('#banner_'+id).data('indexpic'));
            $('#upload_pic input[name=id]').val(id);
            $('#upload_pic input[name=picurl]').val($('#banner_'+id).data('picurl'));
            $('#upload_pic input[name=info]').val($('#banner_'+id).data('info'));
            if($('#banner_'+id).data('type') == 1){
                $('#upload_pic #pc').attr('checked',true);
            }else{
                $('#upload_pic #wx').attr('checked',true);
            }
            if($('#banner_'+id).data('status') == 1){
                $('#upload_pic .qy').attr('checked',true);
            }else{
                $('#upload_pic .jz').attr('checked',true);
            }
        }else{
            if(getUrlParam('type')== 1 || !getUrlParam('type') ){
                $('#upload_pic #pc').attr('checked',true);
            }else{
                $('#upload_pic #wx').attr('checked',true);
            }
            $('#clipArea img').attr('src','');
            $('#upload_pic input[name=indexpic]').val('');
        }
        getMask().maskShow({"tit": "上传banner图","width":480, "cont": "#upload_pic"});
    }
    /**
     * 选择图片
     */
    function selectPic(){
        upload.prototype.callback = function(url, path){
            $('#upload_pic input[name=indexpic]').val(path);
            $("#clipArea img").attr("src",CONST_PUBLIC+path);
        }
        upload.prototype.uploadPic("banner");
    }

    function delBanner(id){
        if(id>0){
            $.post('/admin/system/delBanner.html',{id:id},function(data){
                if(data.code == 200){
                    clearpop(data.message,'','self');
                }else{
                    clearpopj(data.message,'error',true);
                }
            })
        }
    }

   function setBanner(field,id,val){
       $.post('/admin/system/setBanner.html',{field:field,val:val,id:id},function(data){
           if(data.code == 200){
               clearpop(data.message,'','self');
           }else{
               clearpopj(data.message,'error',true);
           }
       })
   }

   function modifyBanner(){
       var indexpic = $('#upload_pic input[name=indexpic]').val(),
           id = $('#upload_pic input[name=id]').val(),
           picurl = $('#upload_pic input[name=picurl]').val(),
           info = $('#upload_pic input[name=info]').val(),
           type = $('#upload_pic input[name=banner]:checked').val(),
           status = $('#upload_pic input[name=status]:checked').val();
       $.post('/admin/system/modifyBanner.html',{indexpic:indexpic,picurl:picurl,info:info,id:id,type:type,status:status},function(data){
           if(data.code == 200){
               closeMask();
               clearpop(data.message,'','self');
           }else{
               clearpopj(data.message,'error',true);
           }
       })
   }
</script>
</body>
</html>