<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>爱大叔</title>
    <link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/bootstrap/css/bootstrap.min.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/common.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/idealforms.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/common/css/animation.css?version=<?php echo version();?>"/>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/home.css?version=<?php echo version();?>"/>

<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.2.2.1.min.js?version=<?php echo version(2);?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/bootstrap/js/bootstrap.min.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/jquery.idealforms.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/common/js/common.js?version=<?php echo version();?>"></script>
<script type="text/javascript" src="http://www.lovehou.com/Public/static/page/js/home.js?version=<?php echo version();?>"></script>

<script type="text/javascript">
    var URL="/Home/Index";
    var APP_PATH="";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


    <style>
        table{border: 1px solid #E4E4E4}
        table tr th:first-child,table tr td:first-child{text-indent: 10px;}
    </style>
</head>
<body>
<style>
    span.triangle_ico{height:40px; width:40px; display:block; position:relative;}

    span.triangle_ico:before{content:''; height:0; width:0; display:block; border:10px transparent solid; border-right-width:0; border-left-color:#7EE0D9; position:absolute; top:25px; left:200px;}

</style>
<?php $user = Common\Model\UserModel::getUser();$currentuid=$user['uid']; ?>
<link rel="stylesheet" type="text/css" href="http://www.lovehou.com/Public/static/page/css/icon.css?version=<?php echo version();?>"/>
<div class="bgf navbar-fixed-top">
    <div class="container  borderb-d">
        <nav class="navbar" role="navigation">
            <div class="collapse navbar-collapse relative" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="height: 85px;">
                    <li class="active">
                       <a href="/">
                           <!--<img src="http://www.lovehou.com/Public/static/image/logo.png" width="190"  alt=""/>-->
                           <span class="fontb clo6" style="font-size: 50px;line-height: 65px;">爱大叔</span>
                       </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav top_bar navbar-right" style="height: 40px;">
                    <li class="dropdown ">
                        <?php if($user['uid']): ?><a href="/member/index.html"  style="height: 40px;" class="dropdown-toggle clo6" data-toggle="dropdown">
                                <img src="http://www.lovehou.com/Public<?php echo ((isset($user["picture"]) && ($user["picture"] !== ""))?($user["picture"]):'/static/image/noavatar_middle.gif'); ?>" width="25" class="user_noavatar_img"/>
                                <?php echo (msubstr($user["nickname"],0,9,'UTF-8',true)); ?>&nbsp;
                                <strong class="caret"></strong>
                            </a>
                        <?php else: ?>
                            <a href="/login/index.html" class="dropdown-toggle clo3" data-toggle="">
                               登录/注册
                            </a><?php endif; ?>
                        <ul class="dropdown-menu" style="min-width: 100px;">
                            <li>
                                <a href="/member/index.html">个人中心</a>
                            </li>
                            <li>
                                <a href="#">帖子文章</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/login/logout.html">退出登录</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="clo6 "><img src="http://www.lovehou.com/Public/static/image/page/home/location.png" width="15" alt=""/>设位置</a>
                    </li>
                    <li>
                        <a href="#" class="clo6" style="padding: 4px 0"><img src="http://www.lovehou.com/Public/static/image/page/home/mail.png" width="28" alt=""/>消息</a>
                    </li>
                </ul>
                <!--<form onsubmit='return false;' id="searchForm" class="absolute nav navbar-nav navbar-right" style="top: 50px;right: 0" >
                        <select name="proivce" onchange="checkeSupsort($(this).val(), $('#searchForm select[name=city]'));"  style="width: 80px;height: 32px;">
                            <option value="">请选择</option>
                            <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <select name="city" style="width: 80px;height: 32px;">
                            <option value="">请选择</option>
                        </select>
                        <select name="ren" style="width: 80px;height: 32px;">
                            <option value="1">游伴</option>
                            <option value="2">游客</option>
                        </select>
                        <img src="http://www.lovehou.com/Public/static/image/page/home/search_flat.png" width="31" alt=""/>
                    </ul>
                </form>-->
            </div>
        </nav>

        <nav class="navbar navhead" role="navigation">
            <div class="collapse navbar-collapse relative" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav fl " style="height: 30px;width: 100%;">
                    <li>
                        <a href="/index/richkept.html" class="clo6"><img src="http://www.lovehou.com/Public/static/image/page/home/pin_green.png" width="15" alt=""/>&nbsp;&nbsp;&nbsp;悬赏任务</a>
                    </li>
                    <li class="selected">
                        <a href="/" class="clo6">首页</a>
                    </li>
                    <li>
                        <a href="javascript:if(confirm('你没有权限，请升级你的会员等级'))window.location.href='/'" class="clo6">找美女</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">找土豪</a>
                    </li>
                    <li class="planitem">
                        <a href="/index/planlist.html" class="clo6">养成计划</a>
                    </li>
                    <li>
                        <a href="#" class="clo6">公益资助</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div style="height: 140px;"></div>
<script>
    var  $pathname = window.location.pathname.toLowerCase();
    if($pathname.indexOf('/plan')>0){
        $('.navbar-nav li').removeClass('selected');
        $('.navbar-nav li.planitem').addClass('selected');
    }
</script>
<div class="container" style="margin-top: 30px;padding: 0 0 50px 0 ;">
    <div class="fl column" style="width: 910px;">
        <div id="postPlan">
            <div class="pp_left fl">
                <img src="http://www.lovehou.com/Public/static/image/page/home/pp_left_y.JPG" style="height: 130px;;border-radius: 130px;margin: 25px 0 0 35px; " width="130" alt=""/>
                <span class="triangle_ico"></span>
            </div>
            <div class="pp_cotent fl">
                <form role="form" id="myform" onsubmit="return false;" style="padding-bottom: 50px;">
                    <div class="form-group"></div>
                    <div class="form-group">
                        <div style="width: 290px;;" class="fl">
                            <div class="fg-l tr fl">开始日期：</div>
                            <div class="fg-r fl"><input type="text" id="pp_startime" class="form-control fl" name="startime" /></div>
                        </div>
                        <div style="width: 200px;;" class="fl">
                            <div class="fg-l tr fl">共几天：</div>
                            <div class="fg-r fl">
                                <select name="duration" style="width: 100px;height: 32px;">
                                    <option value="">请选择</option>
                                    <option value="1">3天</option>
                                    <option value="2">5天</option>
                                    <option value="3">7天</option>
                                    <option value="4">一个月</option>
                                    <option value="5">三个月</option>
                                    <option value="6">长期有效</option>
                                </select>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div style="width: 200px;;" class="fl">
                            <div class="fg-l tr fl">支付方式：</div>
                            <div class="fg-r fr">
                                <select name="payway" style="width: 100px;height: 32px;">
                                    <option value="">请选择</option>
                                    <option value="1">现金</option>
                                    <option value="2">微信</option>
                                    <option value="3">QQ</option>
                                    <option value="4">支付宝</option>
                                    <option value="5">PayPal</option>
                                    <option value="6">银行卡</option>
                                    <option value="7">其他</option>
                                </select>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>

                    <div class="form-group">
                        <div style="width: 345px;;" class="fl">
                            <div class="fg-l tr fl" style="width: 80px;">诚意金：</div>
                            <input type="text"  class="form-control fl" name="earnestfee" />
                            <span class="fl">元/天</span>
                        </div>
                        <div style="width: 345px;text-indent: 20px;" class="fr">
                            <div class="fg-l tr fl">费用预算：</div>
                            <input type="text" width="200" class="form-control fl" name="budgetfee" />
                            <span class="fl">元/天</span>
                        </div>
                        <div class="clr"></div>
                    </div>

                    <div class="form-group">
                        <div class="fg-l tr fl" style="width: 80px;">标题：</div>
                        <input type="text" name="title" class="form-control fl" style="width: 610px;;"/>
                        <div class="clr"></div>
                    </div>

                    <div class="form-group">
                        <div class="fg-l tr fl" style="width: 80px;">目的地：</div>
                            <select name="proivce"  class="fl" onchange="checkeSupsort($(this).val(), $('#myform select[name=city]'));" style="width: 100px;height: 32px;">
                                <option value="">请选择</option>
                                <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <select name="city" class="fl" style="width: 100px;height: 32px;">
                                <option value="">请选择</option>
                            </select>
                            <input type="text" style="width: 410px" class="form-control fl" name="addr" />
                        <div class="clr"></div>
                    </div>
                    <div class="form-group" >
                        <div class="fg-l tr fl" style="width: 80px;">计划说明：</div>
                        <textarea name="contentcn" class="fl"  id="contentcn"></textarea>
                        <div class="clr"></div>
                    </div>
                    <button type="submit" style="margin-left: 70px;" class=" btn clof btn-warning " onclick="subPlan();">发布计划</button>
                    <span class="font13 clo9">更多信息，<a href="/member/escortplan.html?to=escortplan"  class="font13 blue">发布完整版计划</a></span>
                </form>
            </div>
            <div class="clr"></div>
        </div>
        <form role="form" id="seachform" style="margin: 20px 0">
            <input type="text"  class="form-control fl" name="keyword" style="width: 280px;" placeholder="请输出:目的地,计划标题，内容等关键字" value="<?php echo ($_REQUEST['keyword']); ?>"/>
            <span class="fl">&nbsp;&nbsp;</span>
            <input type="text" placeholder="费用" class="form-control fl" style="width: 80px;" name="feestar" value="<?php echo ($_REQUEST['feestar']); ?>"/>
            <span class="fl clo9">--</span>
            <input type="text" placeholder="费用" class="form-control fl" style="width: 80px;" name="feeend" value="<?php echo ($_REQUEST['feeend']); ?>"/>
            <span class="fl clo9">元</span>
            <span class="fl">&nbsp;&nbsp;</span>
            <input type="text" id="seachstime"  value="<?php echo ($_REQUEST['startime']); ?>" class="form-control fl"  placeholder="选择时间" style="width: 100px;" name="startime"/>
            <span class="fl">&nbsp;&nbsp;</span>
            <input type="text" id="seachetime"  value="<?php echo ($_REQUEST['startime']); ?>" class="form-control fl"  placeholder="选择时间" style="width: 100px;" name="startime"/>
            <span class="fl">&nbsp;&nbsp;</span>
            <button type="submit" style="background: #7EE0D9" class=" btn clof " >搜索</button>
            <div class="clr"></div>
        </form>
        <table class="list-task" width="910">
        <tr class="borderb-d" >
            <th width="560">计划名称</th>
            <th width="50">费用</th>
            <th width="100">目的地</th>
            <th width="100">出发时间</th>
            <th width="100">发布人</th>
        </tr>
        <colgroup><col><col width="110px"><col width="130px"><col width="105px"></colgroup>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr onclick="window.location.href='/index/plan.html?pid=<?php echo ($vo["pid"]); ?>/'" >
                <td><em class="list-task-reward font14 font6"> <?php echo str_ireplace($_REQUEST['keyword'],'<span class="red">'.$_REQUEST['keyword'].'</span>',$vo['title']);?></em></td>
                <td><?php echo ($vo["budgetfee"]); ?></td>
                <td><?php if($vo['city']): echo getAreaByAid($vo['city']); elseif($vo['proivce']): echo getAreaByAid($vo['proivce']); else: echo ($vo["addr"]); endif; ?></td>
                <td><?php echo (msubstr($vo["startime"],0,11,'utf-8',false)); ?></td>

                <td><img src="http://www.lovehou.com/Public<?php echo ($vo["picture"]); ?>" width="30" style="height: 30px;;border-radius: 30px;;" alt=""/><span><?php echo ($vo["level"]); ?></span><span><?php echo ($vo["nickname"]); ?></span>
                </td>
            </tr>
            <tr class="borderb-d">
                <td colspan="3" class="font13 clo9"><?php echo timeTran($vo['createtime']);?></td>
                <td colspan="2" align="right">
                    <span class="btn btn-default btn-primary" style="padding: 3px 12px;margin: -5px 20px 0 0;">回复(<?php echo ((isset($vo["comtents"]) && ($vo["comtents"] !== ""))?($vo["comtents"]):0); ?>)&nbsp;&nbsp;回复(<?php echo ((isset($vo["read"]) && ($vo["read"] !== ""))?($vo["read"]):0); ?>)</span>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
        <div class="page tc"><?php echo ($page); ?></div>
    </div>
    <div class="fr column" style="width: 295px;">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: #f8f8f8" >
                <span class="panel-title fontb yellow">达人</span>
                <div class="clr"></div>
            </div>
            <div class="panel-body">
                <ul class="clo6">
                    <li class="borderb-d" style="padding: 5px 0;">
                        <img src="http://www.lovehou.com/Public<?php echo ((isset($vo["avatar"]) && ($vo["avatar"] !== ""))?($vo["avatar"]):'/static/image/noavatar_middle.gif'); ?>" width="65" class="fl"/>
                        <div class="fr" style="width: 195px;line-height: 22px;">
                            <div><?php if(isset($vo['title']) && $vo['title']): echo (msubstr($vo['title'],0,12)); else: echo (msubstr($vo['message'],0,12)); endif; ?></div>
                            <div><?php echo date('Y/m/d-H/i',strtotime($vo['createtime']));?></div>
                            <div><span class="bgy clof">聘请</span> <span></span><span class="fontb"><?php echo ($vo["read"]); ?></span></div>
                        </div>
                        <div class="clr"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tc qr-index">
            <img src="http://www.lovehou.com/Public/static/image/page/home/qr.png" width="200" alt=""/>

        </div>
    </div>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<footer style="width: 100%">
    <div class="footline"></div>
    <div class="footitem">
        <ul class=" container">
            <li class="fl tc">
                <p>新手上路</p>
            </li>
            <li class="fl tc">
                <p>网站条款</p>
            </li>
            <li class="fl tc">
                <p><a href="/index/newinfo.html?id=2" class="clo3">联系我们</a></p>

            </li>
            <li class="fl tc">
                <p><a href="/index/newinfo.html?id=1" class="clo3">关于我们</a></p>
            </li>
        </ul>
    </div>
    <div class="footline"></div>
    <div class="footitem" style="height: 50px;line-height: 50px;">
        <div class=" tc">Copyright 2013-2017</div>
    </div>
</footer>
<div class="feedback font18 tc clof" onclick="showfeedback();">
    意见反馈
</div>
<div id="feedback" style="display: none;">
    <form role="form" class="regform" style="width: 460px;" id="myform" onsubmit="return false;">
        <input type="hidden" name="type" value="1"/>
        <div class="form-group">
            <label for="tel" class="clo6">联系方式 </label><input type="text" placeholder="请填写您的手机号" class="form-control" name="tel" id="tel" />
        </div>
        <div class="form-group">
            <label for="info" class="clo6">你需要 </label><input type="text" name="note" placeholder="请用一句话概括您要做什么" id="info" class="form-control " />
        </div>
        <br/>
        <div class="form-group tc">
            <input type="submit" onclick="subfeedback();" class="clof" style="border: none;background: #FB7D24;width: 400px;height:40px;border-radius: 4px;;" value="立即提交" />
        </div>
    </form>
</div>
<script>
    function showfeedback(){
        getMask().maskShow({"tit": "意见反馈","width":500, "cont": "#feedback"});
    }
    function subfeedback(){
        $.post('/home/index/subform.html',{tel:$('#feedback input[name=tel]').val(),note:$('#feedback input[name=note]').val()},function(data){
           clearpop(data.message);
            if(data.code ==200){
                $('#feedback input[name=note]').val('');
                $('#feedback input[name=tel]').val('');
            }
        })
    }
</script>
<script src="http://www.lovehou.com/Public/static/common/js/jquery.lhgcalendar.min.js"></script>
<script>

</script>
<script>
    $('#pp_startime').calendar({
        format: 'yyyy-MM-dd',
        minDate: '%y-%M-%d',
        btnBar: false
    });
    $('#seachstime').calendar({
        format: 'yyyy-MM-dd',
        btnBar: false
    });
    $('#seachetime').calendar({
        format: 'yyyy-MM-dd',
        btnBar: false
    });
</script>

</body>
</html>