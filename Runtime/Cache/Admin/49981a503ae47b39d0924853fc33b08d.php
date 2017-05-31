<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>爱大叔--后台管理</title>
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
    var URL="/Admin/Index";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


<style>
html {
	overflow: hidden;
}
</style>
</head>
<body class="MainBody">
	<div id="Header">
		<div class="topBar">
			<span class="fl">
                <a href="./"><span style="font-size: 35px;">爱大叔</span></a>
            </span>
            <span class="fr" style="padding:6px 20px 0px 40px; background:url(http://www.lovehou.com/Public/static/image/page/admin/home.gif) no-repeat left 6px;">
                <a href="/" style="display: inline-block" target="_blank">网站首页</a>
            </span>
		</div>
		<div class="location">
			<span class="fl" id="Location"></span>
            <span class="fr">
            <!--<a href="javascript:void(0);" id="ClrCache">更新缓存</a> -->
            当前用户：<?php echo Session('adminname');?> <a href="javascript:void(0);" onclick="var url='<?php echo U('Admin/Login/logout');?>';if(confirm('您确定要退出登录吗？')){location=url;};" class="fc_red">安全退出</a>&nbsp;<a href="javascript:showUpPwdBox();">【修改密码】</a>
        </span>
		</div>
	</div>
	<div id="Lefter">
		<div id="LeftMenu">
			<ul>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($supper == true) Or ($vo["access"] == 1)): ?><li><span><?php echo ($vo["title"]); ?></span>
					<ul>
						<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i; if(($supper == true) Or ($son["access"] == 1)): ?><li><a href="<?php echo isN($son['url'])?U($vo['name'].'/'.$son['name']):U($son['url']);?>"><?php echo ($son["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="copyright">
				版权所有：<a href="http://www.cc01.com.cn" target="_blank">智君网络</a>
			</div>
		</div>
	</div>
	<div id="Spliter" class="spliterLeft"></div>
	<div id="Righter">
		<div class="container">
			<iframe src="<?php echo U('Index/index?sys=1');?>" width="100%" height="100%" frameborder="0"
				class="MainFrame" id="MainFrame" name="MainFrame"></iframe>
		</div>
	</div>
    <form onsubmit="return false" id="upPwdBox" style="display: none">
        <input type="text" style="width: 300px" placeholder="请输入原始密码" name="oldpwd"/><br/><br/>
        <input type="text" style="width: 300px" placeholder="请输入新密码" name="pwd"/><br/>
        <p>
            <input type="button" class="sure_btn" onclick="upPwd()"  value="修改"/>
            <input type="button" class="cancel_btn" onclick="closeMask();"  value="取消"/>
        </p>
    </form>
<script>
    function showUpPwdBox(){
        $("#upPwdBox").idealforms();
        getMask().maskShow({"tit": "修改密码","width":350, "cont": "#upPwdBox"});
    }

    function upPwd(){
        var old = $('#upPwdBox input[name=oldpwd]').val(),pwd = $('#upPwdBox input[name=pwd]').val();
        $.post('/admin/login/uppwd',{old:old,pwd:pwd},function(data){
            if(data.code == 200){
                clearpop(data.message, "",'Admin/Login/index');
            }else{
                clearpopj(data.message, "error",true);
                return  false;
            }
        })
    }
</script>
</body>
</html>