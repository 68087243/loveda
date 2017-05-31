<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>内容添加</title>
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


    <link rel="stylesheet" href="http://www.lovehou.com/Public/kindeditor/themes/default/default.css" />
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="http://www.lovehou.com/Public/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/upload.js?<?php echo version();?>"></script>

</head>
<body class="bg_white" data-storage_id="<?php echo ($db["storage_id"]); ?>" data-rootid="<?php echo ($_REQUEST['rootid']); ?>" data-status="<?php echo ($db["status"]); ?>" data-negative="<?php echo ($db["negative"]); ?>"  data-title="<?php echo ($db["title"]); ?>" data-id="<?php echo ($db["id"]); ?>" data-good_type="<?php echo ($db["good_type"]); ?>" data-pid="<?php echo ($db["pid"]); ?>" data-supplyid="<?php echo ($db["supplyid"]); ?>" data-stock_type="<?php echo ($db["stock_type"]); ?>" data-origin_id="<?php echo ($db["origin_id"]); ?>">
<div class="container" style="overflow: hidden">
    <input type="hidden" id="goodid" value="<?php echo ($db["id"]); ?>"/>
    <div class="page_title"> 文章帖子添加/修改</div>
    <div class="tab_box" id="title_tab">
        <ul>
            <li class="onselect" data-name="infoform">基本信息</li>
        </ul>
    </div>
    <form id="infoform" onsubmit="return false;" style="width: 700px;margin: 0 auto;">
        <input type="hidden" name="tid" value="<?php echo ((isset($info["tid"]) && ($info["tid"] !== ""))?($info["tid"]):0); ?>"/>
        <div class="form-group">
            <span  class="fontb fl">文章类型</span>
            <div class="idealforms_select fl"style="width:125px;margin:0 10px;">
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="type">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu">
                    <li data-value="1">帖子</li>
                    <li data-value="3" >悬赏</li>
                </ul>
            </div>
            <div class="fl" id="contentpid" style="display: none">
                <span class="fontb fl">帖子分类</span>
                <div class="idealforms_select fl"  style="width:125px;margin-left: 10px;">
                    <div class="idealforms_select_obj" >
                        <input type="hidden" value="" name="cid">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu">
                        <?php if(is_array($club)): $i = 0; $__LIST__ = $club;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["clubname"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php if($info['type'] == 1): ?><label for="exampleInputText3">作者（发帖人）</label><input type="text" name="nickname" value="<?php echo ((isset($info['nickname']) && ($info['nickname'] !== ""))?($info['nickname']):'admin'); ?>" class="form-control" id="exampleInputText3" readonly />
                <?php else: ?>
                <label for="exampleInputText4">诚意金</label><input type="text" name="rarnestfee" value="<?php echo ((isset($info['rarnestfee']) && ($info['rarnestfee'] !== ""))?($info['rarnestfee']):0); ?>" class="form-control" id="exampleInputText4" /><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="exampleInputText1">标题</label><input type="text" name="title" value="<?php echo ($info['title']); ?>" class="form-control" id="exampleInputText1" />
        </div>

        <div class="form-group">
            <label for="exampleInputText2">简述(副标题)  <em class="fontn font13 cloc">后台设置</em>  </label><input type="text" name="title"  class="form-control" id="exampleInputText2" placeholder="仅后台能操作" />
        </div>

        <div class="form-group">
            <label for="keywords">
                <em class="fl"> 状态&nbsp;&nbsp;&nbsp;&nbsp;</em>
                <ul style="margin:0" >
                    <li><label for="radio12" class="fontn clo3"><input type="radio" id="radio12" <?php if($info['status'] == 1): ?>checked<?php endif; ?> name="status" value="1"/>启用</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    <li><label for="radio13" class="fontn clo3"><input type="radio" id="radio13" name="status"  value="-1" />禁用</label></li>
                </ul>
            </label>
        </div>
        <div class="form-group">
            <label for="keywords">
                <em class="fl">是否推荐&nbsp;&nbsp;&nbsp;&nbsp;</em>
                <ul style="margin:0" >
                    <li><label for="radio1" class="fontn clo3"><input type="radio" id="radio1" <?php if($info['recommend'] == 1): ?>checked<?php endif; ?> name="recommend" value="1"/>推荐</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    <li><label for="radio2" class="fontn clo3"><input type="radio" id="radio2" name="recommend"  value="0" />不推荐</label></li>
                </ul>
            </label>
        </div>

        <div class="form-group">
            <label for="content">内容 </label><textarea name="message" style="resize: none" id="content"><?php echo ($info["message"]); ?></textarea>
        </div>
        <div class="form-group">
            <label for="keywords">关键词
                <textarea class="textarea_text2 fontn" placeholder=" 一般不超过100个字符" name="keywords" style="width: 700px;height: 50px;resize: none;" id="keywords" ><?php echo ($info["keywords"]); ?></textarea>

            </label>
        </div>
        <div class="form-group">
            <label for="description">描述
                <textarea class="textarea_text2 fontn" placeholder="一般不超过200个字符" id="description"style="width: 700px;height: 50px;resize: none;" name="description" ><?php echo ($info["description"]); ?></textarea>

            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputText5">阅读量</label><input type="text" name="read" value="<?php echo ($info['read']); ?>" class="form-control" id="exampleInputText5" />

        </div>

        <button type="submit" class="btn btn-default" onclick="modifyTopic();">提交</button>
    </form>


</div>
<script>

    $(function(){
        //初始化form
        $("#infoform").idealforms();
        if("<?php echo ($info['tid']); ?>"){
            setSelectSelected('#infoform input[name=type]',"<?php echo ($info['type']); ?>");
            setSelectSelected('#infoform input[name=cid]',"<?php echo ($info['cid']); ?>");
            if("<?php echo ($info['type']); ?>" == 1){
                $('#contentpid').show();
            }
        }

        setRadioCheck('#infoform input[name=status]',"<?php echo ((isset($info['status']) && ($info['status'] !== ""))?($info['status']):-1); ?>");
        setRadioCheck('#infoform input[name=recommend]',"<?php echo ((isset($info['recommend']) && ($info['recommend'] !== ""))?($info['recommend']):0); ?>");

        $('.idealform .main-label span').css({'font-size': '1em'})
        $('.idealform .idealradio span,.idealform .idealcheck span').css({'top':'0'})
        upload.prototype.createContent("#content",'pyplan',700);
        $('#infoform input[name=type]').parents().siblings('.idealforms_select_menu').find('li').click(function(){
            if($(this).data('value') == 3){
                $('#contentpid').hide();
            }else{
                $('#contentpid').show();
            }
        })
    })

    function modifyTopic(){
        var title = $("#infoform input[name=title]").val();
        var message = $("#infoform textarea[name=message]").val();
        if(!title){
            clearpop('请填写文章标题');
            return false;
        }
        if(!message){
            clearpop('请填写文章内容');
            return false;
        }
        var $data = $("#infoform").serialize();
        $.post('/admin/cms/modifyTopic.html',$data,function(data){
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