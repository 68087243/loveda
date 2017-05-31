<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="Robots" content="noindex,nofollow,noarchive" />
    <title>爱大叔--<?php echo ($user["nickname"]); ?></title>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<!--<link rel="shortcut icon" type="image/x-icon" href="http://www.lovehou.com/Public/static/common/img/favicon.ico"/>-->
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/bootstrap/css/bootstrap.min.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/wap.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.2.2.1.min.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/bootstrap/js/bootstrap.min.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/common.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/page/js/wap.js?version=<?php echo version();?>"></script>
<script type="text/javascript">
    var URL="/Wap/User";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


<body pagename="login" style="overflow-x:hidden;">
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="clearfix header">
    <ul class="user_header top-head container">
        <li class="fl" onclick="window.history.back(-1)"><span class="back"></span></li>
        <li class="tc fl top-htit">
            <span class="font24 clof"><?php echo ((isset($headtitle) && ($headtitle !== ""))?($headtitle):'个人中心'); ?></span>
        </li>
        <li class="fr" onclick="openside();"><span class="menu"></span></li>
    </ul>
    <div class="clr"></div>
</div>
<div style="height: 50px;"></div>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="imui_side b_f" onclick="openside();">
    <div class="side_user font14 clof cl">
        <?php if(!empty($user)): ?><a href="/user/index.html" >
                <?php if($user['picture']): ?><img src="http://www.lovehou.com/Public/<?php echo ($user['picture']); ?>">
                    <?php else: ?>
                    <img src="http://www.lovehou.com/Public/static/image/noavatar_middle.gif"><?php endif; ?>
            </a>
            <h3 class="font16"><?php echo ($user["nickname"]); ?></h3>
            <p><a href="/login/logout.html" class="clof fr font12">退出</a></p>
            <?php else: ?>
            <p class="font18"><a href="/login/login.html" style="text-decoration: inherit" class="clof fr font20">请登录</a></p><?php endif; ?>
    </div>
    <div class="side_nv size_16">
        <ul id="sidearea">
            <li>
                <a href="/">
                    <div class="font16 fontb">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_home.png" width="40" style="margin-left: 10px;" />
                        <span class="relative s_rowname" >首页</span>
                    </div>
                    <div class="clr "></div>
                </a>
            </li>
            <li>
                <a href="/">
                    <div class="font16 fontb">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_chat.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >论坛</span>
                    </div>
                </a>
            </li>
            <li>
                <?php if($user['sex'] == 1): ?><a href="/index/rlist.html?cid=1">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/f_boy.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >找大叔</span>
                    </a>
                <?php else: ?>
                    <a href="/index/rlist.html?cid=2">
                        <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_girl.png" width="40" style="margin-left: 10px;"/>
                        <span class="relative s_rowname" >找萝莉</span>
                    </a><?php endif; ?>
            </li>
            <li>
                <a href="/">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_index/l_service.png" width="40" style="margin-left: 10px;"/>
                    <span class="relative s_rowname" >服务指南</span>
                </a>
            </li>
            <li>
                <a href="/">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_index/aboutus.png" width="40" style="margin-left: 10px;"/>
                    <span class="relative s_rowname" >联系我们</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="imui_sidebg" onclick="openside();"></div>

<div class="line10"></div>
    <form class="container" id="infobox" onsubmit="return false;">
        <ul class="modifyuser tr">
            <li class="tl">
                <input type="hidden" name="picture"/>
                <img id="picture" src="http://www.lovehou.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>" width="35" alt=""/>
                &nbsp;&nbsp; 修改头像
                <span class="fr">
                    <img src="http://www.lovehou.com/Public/static/image/page/w_user/c_user_p.png" width="35" onclick="$('#file').click();" alt=""/>
                     <input type="file" id="file" class="hide"/>
                </span>
            </li>
            <li>
                <label for="exampleInputPassword2">用户名</label>
                <input type="text" name="nickname" value="<?php echo ($user["nickname"]); ?>" class="form-control" id="exampleInputPassword2" />
            </li>
            <li>
                <label for="exampleInputTel">电话</label>
                <input type="text" name="tel" value="<?php echo ($user["tel"]); ?>" class="form-control" id="exampleInputTel" />
            </li>
            <li>
                <label for="exampleInputQQ">QQ</label>
                <input type="text" name="qqid" value="<?php echo ($user["qqid"]); ?>" class="form-control" id="exampleInputQQ" />
            </li>
            <li>
                <label for="exampleInputEmail">Email</label>
                <input type="text" name="email" value="<?php echo ($user["email"]); ?>" class="form-control" id="exampleInputEmail" />
            </li>
            <li>
                <label>城市</label>
                <div class="select_row" >
                    <div class="idealforms_select fl" style="width:50%;min-width: 100px;">
                        <div class="idealforms_select_obj">
                            <input type="hidden" value="" name="proivce">
                            <input type="text" value="" readonly>
                            <span class="icaret"></span>
                        </div>
                        <ul class="idealforms_select_menu">
                            <li data-value="0">请选择省</li>
                            <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="idealforms_select fl" style="width:50%;">
                        <div class="idealforms_select_obj">
                            <input type="hidden" value="" name="city">
                            <input type="text" value="" readonly>
                            <span class="icaret"></span>
                        </div>
                        <ul class="idealforms_select_menu">
                            <li data-value="0">请选择城市</li>
                        </ul>
                    </div>
                    <div class="clr"></div>
                </div>
            </li>
            <?php if($user['sex'] == 1): ?><li>
                    <label>三围</label>
                    <div class="select_row" id="bwh" >
                        <input type="text" name="bust" value="<?php echo ($user["bust"]); ?>" placeholder="胸围/cm" class="form-control"/>
                        <input type="text" name="waist" value="<?php echo ($user["waist"]); ?>" placeholder="腰围/cm" class="form-control" />
                        <input type="text" name="hip"  value="<?php echo ($user["hip"]); ?>" placeholder="臀围/cm" class="form-control" />
                    </div>
                </li>
                <li>
                    <label for="exampleInputEmail">体重</label>
                    <input type="text" name="weight" value="<?php echo ($user["weight"]); ?>" class="form-control" id="exampleInputweight"/>
                    <span class="relative" style="top: -45px; right: 6px;">kg</span>
                </li><?php endif; ?>
            <li>
                <label>身高</label>
                <div class="idealforms_select select_row tc">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="height">
                        <input type="text" value=""  readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <?php
 for($i=145;$i<210;$i++){ ?>
                        <li data-value="<?php echo ($i); ?>"><?php echo ($i); ?>cm</li>
                        <?php
 } ?>
                    </ul>
                </div>
            </li>
            <li>
                <label>年龄</label>
                <div class="select_row">
                    <div class="idealforms_select fl" style="width:100%;">
                        <div class="idealforms_select_obj">
                            <input type="hidden" value="" name="age">
                            <input type="text" value="" readonly>
                            <span class="icaret"></span>
                        </div>
                        <ul class="idealforms_select_menu">
                            <?php
 for($i=15;$i<80;$i++){ ?>
                            <li data-value="<?php echo ($i); ?>"><?php echo ($i); ?></li>
                            <?php
 } ?>
                        </ul>
                    </div>
                    <div class="clr"></div>
                </div>
            </li>
            <li>
                <label>学历</label>
                <div class="idealforms_select select_row tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="education">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <li data-value="">请选择</li>
                        <li data-value="初中及以下">初中及以下</li>
                        <li data-value="中专">中专</li>
                        <li data-value="高中">高中</li>
                        <li data-value="专科">专科</li>
                        <li data-value="本科">本科</li>
                        <li data-value="硕士">硕士</li>
                        <li data-value="博士">博士</li>
                    </ul>
                </div>
            </li>
            <li>
                <label>婚姻</label>
                <div class="idealforms_select select_row tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="marriage">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <li data-value="">请选择</li>
                        <li data-value="未婚">未婚</li>
                        <li data-value="离异">离异</li>
                        <li data-value="丧偶">丧偶</li>
                        <li data-value="非单身">非单身</li>
                    </ul>
                </div>
            </li>
            <li>
                <label class="font13">月收入</label>
                <div class="idealforms_select select_row tc" style="width:100%;">
                    <div class="idealforms_select_obj">
                        <input type="hidden" value="" name="income">
                        <input type="text" value="" readonly>
                        <span class="icaret"></span>
                    </div>
                    <ul class="idealforms_select_menu tc">
                        <li data-value="">请选择</li>
                        <li data-value="3000元以下">3000元以下</li>
                        <li data-value="3001元-5000元">3001元-5000元</li>
                        <li data-value="5001元-8000元">5001元-8000元</li>
                        <li data-value="8001元-12000元">8001元-12000元</li>
                        <li data-value="12001元-20000元">12001元-20000元</li>
                        <li data-value="20001元-50000元">20001元-50000元</li>
                        <li data-value="50001元以上">50001元以上</li>
                    </ul>
                </div>
            </li>
            <li>
                <label for="exampleInputEmail">描述</label>
                <input type="text" name="describe" value="<?php echo ($user["describe"]); ?>" class="form-control" id="exampleInputdescribe" />
            </li>
        </ul>
        <div class="form-group tc" style="margin: 20px 0">
            <div class=" next_btn clof" onclick=" submodify();" >修改</div>
        </div>
    </form>
    <div id="pic"  style="display: none;">
        <div class="fullbg" onclick="$('#pic').hide()"></div>
        <div class="pop center">
            <div id="clipArea" style="height: 300px;;"></div>
            <button id="clipBtn" class="btn store_btn " style="width:25%;margin: 2% 0;">完成</button>
        </div>
    </div>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/hammer.js"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/iscroll-zoom.js"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.photoClip.min.js"></script>
<script>

    $("#infobox").idealforms();
    $('.idealforms_select_menu').css({'max-height': '120px'});
    $('.idealforms_select .idealforms_select_obj input[type=text]').css({'text-indent': '0px'});
    $('.idealforms_select .icaret ').css({'top': '13px'});
    $('.select_row').css({'margin-left':'55px','text-indent': '0','width':($('#infobox').width()-55)+'px'});
    $('#bwh input').css({'width':'32%','text-indent': '0'});


    setSelectSelected('#infobox input[name=proivce]',"<?php echo ($user['proivce']); ?>");
    checkeSupsort("<?php echo ($user['proivce']); ?>", $('#infobox input[name=city]').parents().siblings('.idealforms_select_menu'));
    setSelectSelected('#infobox input[name=city]',"<?php echo ($user['city']); ?>");
    setSelectSelected('#infobox input[name=height]',"<?php echo ($user['height']); ?>");
    setSelectSelected('#infobox input[name=age]',"<?php echo ($user['age']); ?>");
    setSelectSelected('#infobox input[name=education]',"<?php echo ($user['education']); ?>");
    setSelectSelected('#infobox input[name=marriage]',"<?php echo ($user['marriage']); ?>");
    setSelectSelected('#infobox input[name=income]',"<?php echo ($user['income']); ?>");

    function submodify(){

        $.post('/user/info.html',$('#infobox').serialize(),function(data){
            if(data.code == 200){
                clearpop(data.message,'','/user/index.html') ;
            }else{
                clearpop(data.message) ;
            }
        })
    }

    $('#infobox input[name=proivce]').parents().siblings('.idealforms_select_menu').find('li').click(function(){
        if(parseInt($(this).data('value'))>0){
            checkeSupsort( $(this).data('value'), $('#infobox input[name=city]').parents().siblings('.idealforms_select_menu'));
        }
    })



    $(function() {
        $("#clipArea").photoClip({
            width: 200,
            height: 200,
            file: "#file",
            view: "#view",
            ok: "#clipBtn",
            loadStart: function() {
                console.log("照片读取中");
            },
            loadComplete: function() {
                $('#pic').show()
            },
            clipFinish: function(dataURL) {
                uploadPicByBase64('avatar',dataURL);
            }
        });
    })

    function uploadPicByBase64(scope,stream){
        var uploadPhp = DOMAIN+'/Public/uploadForKindeditor.php';
        var uploadJson = uploadPhp+"?scope="+scope+"&callback="+DOMAIN+"&isbase64=true&isaj=1";
        $.post(uploadJson,{stream:stream},function(data){
            if(data.code==100){
                var img = data.data.url.img;//原图
                var thumb = data.data.url.thumb;//缩略图
                $('input[name=picture]').val(img);
                $('#picture').attr('src',PUBLIC+img);
                $('#pic').hide();
            }else{
                clearpop('上传失败');
            }
        },'json')
    }

</script>
</body>
</html>