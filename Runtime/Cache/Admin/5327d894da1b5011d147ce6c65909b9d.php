<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>banner设置</title>
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


    <script>
        var APP_PATH="";
        var CONST_PUBLIC="http://www.lovehou.com/Public";
    </script>
</head>
<body>
    <div style="width: 100%;height: 40px;line-height: 40px; border-top: 1px solid #cccccc;border-bottom: 1px solid #cccccc " class="tc">【 banner设置 】</div>
    <div id="autotab_1">
        <table border="0"class="mytables" style="width: 100%;">
            <tr>
                <th width="5%">ID</th>
                <th width="10%">图片</th>
                <th width="25%">连接</th>
                <th>标题/介绍</th>
                <th width="50">排序</th>
                <th width="5%">状态</th>
                <th width="10%">操作</th>
            </tr>
            <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="banner_<?php echo ($vo["id"]); ?>" data-indexpic="<?php echo ($vo["indexpic"]); ?>" data-picurl="<?php echo ($vo["picurl"]); ?>" data-info="<?php echo ($vo["info"]); ?>" data-type="<?php echo ($vo["type"]); ?>" data-status="<?php echo ($vo["status"]); ?>">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><img src="http://www.lovehou.com/Public/<?php echo ($vo["indexpic"]); ?>" width="120" alt=""/></td>
                    <td><?php echo ($vo["picurl"]); ?></td>
                    <td><?php echo ($vo["info"]); ?></td>
                    <td><input type="text" size="5" value="<?php echo ($vo["rank"]); ?>" onchange="setBanner('rank','<?php echo ($vo["id"]); ?>',$(this).val())" /></td>
                    <td align="center"><?php if($vo['status'] == 1): ?><span style="cursor: pointer" onclick="setBanner('status','<?php echo ($vo["id"]); ?>',2)">启用</span><?php else: ?><span style="cursor: pointer" onclick="setBanner('status','<?php echo ($vo["id"]); ?>',1)">禁用</span><?php endif; ?></td>
                <td style="text-align: center">
                        <a href="JavaScript:uploadImage('<?php echo ($vo["id"]); ?>');" class="underline">编辑</a>
                        <a href="javascript:delBanner('<?php echo ($vo["id"]); ?>');" class="underline">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr><td colspan="7" align="right"><button  onclick="uploadImage();">新增上传</button></td></tr>
        </table>

    </div>

    <form  role="form"  id="upload_pic" onsubmit="return false" style="display: none">
        <div class="form-group" id="clipArea" ><img src="" width="440" id="view" style="margin-top: 0" alt=""></div>

        <input type="button" class="cancel_btn" style="margin-left: 0" value="选择文件" onClick="selectPic();"/>
            <!--<span style="font-size: 12px;color: #cccccc;">图片尺寸:1226*600</span><br/>-->
            <input type="hidden" name="id"/>
            <input type="hidden" name="indexpic"/>
            <div class=" form-group"><span>图片链接:</span>&nbsp;&nbsp;<input type="text" style="width: 400px;" name="picurl" placeholder="http://"/> </div>
            <div class=" form-group"><span>标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题:</span>&nbsp;&nbsp;<input type="text"  style="width: 400px;" placeholder="无" name="info"/></div>

            <div class=" form-group">
                <span class="fl"> 位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;置:</span>
                <ul style="margin:0" >
                    <li><label for="radio12" class="fontn clo3"><input type="radio" id="radio12" name="banner" value="1"/>网站</label></li>
                    <li><label for="radio13" class="fontn clo3"><input type="radio" id="radio13" name="banner"  value="2" />微信</label></li>
                </ul>
                <div class="clr"></div>
            </div>
            <div class=" form-group">
                <span class="fl">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态:</span>
                <ul style="margin:0" >
                    <li><label for="radio3" class="fontn clo3"><input type="radio" id="radio3" name="status" value="1"/>启用</label></li>
                    <li><label for="radio4" class="fontn clo3"><input type="radio" id="radio4" name="status"  value="2" />禁用</label></li>
                </ul>
                <div class="clr"></div>
            </div>
        <!--<input type="file" id="file" class="common_btn"/>-->
         <button id="modifyBanner" class="common_btn">保存</button>
    </form>


    
    <link rel="stylesheet" href="http://www.lovehou.com/Public/kindeditor/themes/default/default.css" />
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/upload.js?<?php echo version();?>"></script>
<script>

    $("#upload_pic").idealforms();
    $('.idealform .idealradio .radio, .idealform .idealcheck .radio').css({'top':'0'})

    function uploadImage(id){
        if(id){
            $('#modifyBanner').show();
            $('#clipArea img').attr('src',CONST_PUBLIC+'/'+$('#banner_'+id).data('indexpic'));
            $('#upload_pic input[name=indexpic]').val($('#banner_'+id).data('indexpic'));
            $('#upload_pic input[name=id]').val(id);
            $('#upload_pic input[name=picurl]').val($('#banner_'+id).data('picurl'));
            $('#upload_pic input[name=info]').val($('#banner_'+id).data('info'));
            setRadioCheck('#upload_pic input[name=banner]',$('#banner_'+id).data('type'));
            setRadioCheck('#upload_pic input[name=status]',$('#banner_'+id).data('status'));
        }else{
            setRadioCheck('#upload_pic input[name=banner]',1);
            setRadioCheck('#upload_pic input[name=status]',2);
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
            $.post('/admin/cms/delBanner.html',{id:id},function(data){
                if(data.code == 200){
                    clearpop(data.message,'','self');
                }else{
                    clearpopj(data.message,'error',true);
                }
            })
        }
    }

   function setBanner(field,id,val){
       $.post('/admin/cms/setBanner.html',{field:field,val:val,id:id},function(data){
           if(data.code == 200){
               clearpop(data.message,'','self');
           }else{
               clearpopj(data.message,'error',true);
           }
       })
   }
    $('#modifyBanner').click(function(){
        var indexpic = $('#upload_pic input[name=indexpic]').val(),
                id = $('#upload_pic input[name=id]').val(),
                picurl = $('#upload_pic input[name=picurl]').val(),
                info = $('#upload_pic input[name=info]').val(),
                type = $('#upload_pic input[name=banner]:checked').val(),
                status = $('#upload_pic input[name=status]:checked').val();
        $.post('/admin/cms/modifyBanner.html',{indexpic:indexpic,picurl:picurl,info:info,id:id,type:type,status:status},function(data){
            if(data.code == 200){
                closeMask();
                clearpop(data.message,'','self');
            }else{
                clearpopj(data.message,'error',true);
            }
        })
    })
</script>
</body>
</html>