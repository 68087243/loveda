<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    
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
    var URL="/Wap/Index";
    var PUBLIC = 'http://www.lovehou.com/Public';
    var STATIC = 'http://www.lovehou.com/Public/static';
    var UPLOAD = 'http://www.lovehou.com/Public/upload';
    var DOMAIN ="<?php echo C('DOMAIN');?>";
</script>


</head>
<body data-keyword="<?php echo ($_REQUEST['keyword']); ?>" data-type="<?php echo ($_REQUEST['type']); ?>" data-aid="<?php echo ($_REQUEST['aid']); ?>" data-cid="<?php echo ($_REQUEST['cid']); ?>">
<?php $user = Common\Model\UserModel::getUser();$currentuid=$user['uid'] ?>
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

<div class="postitle container b_f bo_bl bo_tl mt10">
    <?php if(isset($_REQUEST['type'])): if($_REQUEST['type'] == 1): ?><span class="font15 cloc">结果: 找到 “<span class="font14"><?php echo ($_REQUEST['keyword']); ?></span>” 相关内容 <span id="count"></span> 个</em></span>
        <?php else: ?>
            <span class="font15 cloc">结果: 匹配到<span id="count"></span> 个会员</span><?php endif; endif; ?>
</div>
<div id="content" class="container">

</div>
<div onclick="loadmore(this);" class="tc clo9 font13 loadmore" >加载更多</div>
<?php if(isset($_REQUEST['cid']) && $_REQUEST['cid']): ?><div class="create-topic tc font18 fontb clof" onclick="window.location.href='/index/postTopic.html?cid=<?php echo ($_REQUEST["cid"]); ?>'"><img src="http://www.lovehou.com/Public/static/image/create-topic.png" alt=""/>&nbsp;&nbsp;在<?php echo ($headtitle); ?>发帖</div><?php endif; ?>


<script>
    var page =0;
    function getinfolist(){
        $.post('/index/getinfolist.html',{page:page,keyword:$('body').data('keyword'),aid:$('body').data('aid'),cid:$('body').data('cid')},function(data){
            if(data.code ==200){
                $('#count').html(data.data.count);
                var obj = data.data.list,$hmtl = '';
                if(!obj){
                    clearpop('没有更多了！');
                    return false;
                }
                $hmtl = topichtml(obj);
                $('#content').append($hmtl);
            }
        })
    }
    function getUserinfolist(data){
        $.get('/index/getUserinfolist.html',data,function(data){
            if(data.code ==200){
                $('#count').html(data.data.count);
                var obj = data.data.list,$hmtl = '';
                if(!obj){
                    clearpop('没有更多了！');
                    return false;
                }
                $hmtl = userhtml(obj);
                $('#content').append($hmtl);
            }
        })
    }
    $(function(){
        var type = $('body').data('type')
        if(type ==2){
            var url = (window.location.search+"&page="+page).substr(1);
            getUserinfolist(url);
        }else{
            getinfolist();
        }
    })

    function loadmore(obj){
        page++;
        var type = $('body').data('type')
        if(type == 2){
            var url = (window.location.search+"&page="+page).substr(1);
            getUserinfolist(url);
        }else{
            getinfolist();
        }
    }

    function userhtml(obj){
        var $html='';
        for(var i in obj){
            $html+='<li class="reply-item borderb-d" onclick="window.location.href=\'/user/userinfo.html?uid='+obj[i]['uid']+'\'" style="margin-bottom: 5px;">';
            $html+='<div class="fl">';
            if(obj[i]['picture']){
                $html+='<img src="'+(PUBLIC+obj[i]['picture'])+'" width="40" alt="" style="margin-top: 4px;"/>';
            }else{
                $html+='<img src="'+(STATIC)+'/static/image/noavatar_middle.gif" width="40" style="margin-top: 4px;" alt=""/>';
            }
            $html+='</div>';
            $html+='<div class="fl uinfo ">';
            $html+='<div class="item-nickname fontb clo3 " style="height: 17px;" >';
            if(obj[i]['nickname'].length){
                $html+='<a style="padding-right: 10px;">'+(obj[i]['nickname']).substring(0,18)+'</a>';
            }
            $html+='<a href="" class="level level_1 fr clof relative" style="top: 5px;">';
            $html+='<span>L1</span><em class="size_x" style="">新手上路</em>';
            $html+='</a>';
            $html+='</div>';
            if(obj[i]['describe']){
                $html+='<span class="clo9 font12">'+(obj[i]['describe'])+'</span>';
            }else{
                $html+='<span class="iblock clo9 font12" style="width: 100%;overflow: hidden; height: 25px;" >暂无消息</span>';
            }
            $html+='</div>';
            $html+='<div class="clr"></div>';
            $html+='</li>';
        }
        return $html;
    }

    function topichtml(obj){
        var $hmtl = '',keyword = $('body').data('keyword');
        for(var i in obj){
            $hmtl+='<div class="container">';
            $hmtl+='<div class="topic-itme " onclick="window.location.href=\'/index/topicInfo.html?tid='+obj[i]['tid']+'\'">';
            $hmtl+='<div class="container">';
            $hmtl+='<div class="topic_tit clo3 font16 fontb">';
            $hmtl+='<span class="red">#'+obj[i]['clubname']+'#</span>';
            $hmtl+=obj[i]['title'];
            $hmtl+='</div>';
            $hmtl+='<div class="topic_content font14 clo6 ">';
            $hmtl+=obj[i]['message'];
            if(obj[i]['sex'] !=1){ // 女生图片不展示
                if(obj[i]['img']){
                    for(var j in obj[i]['img']){
                        $hmtl+='<img src="http://www.lovehou.com/Public/'+ obj[i]['img'][j]+'" style="max-width: 100%"  alt=""/>';
                    }
                }
            }else{
                $hmtl+='<i>想看美女照片,请联系客服!</i>';
            }
            $hmtl+='</div>';
            $hmtl+='<div class="topic_u_info">';
            $hmtl+='<div class="fl">';
            if(obj[i]['avatar']){
                $hmtl+='<img src="'+(PUBLIC+obj[i]['avatar'])+'" width="30" alt=""/>';
            }else{
                $hmtl+='<img src="http://www.lovehou.com/Public/static/image/defaultAvatar.png" width="30" alt=""/>';
            }
            $hmtl+='<span clo3>'+obj[i]['nickname']+'&nbsp;</span>';
            $hmtl+='<a href="" class="level level_1 clof" tab="usergroup">';
            $hmtl+='<span>L1</span><em class="size_x" style="">新手上路</em>';
            $hmtl+='</a>';
            $hmtl+='</div>';
            $hmtl+='<div class="clo9 fr topic-c-time font12"> <span>阅读'+ (parseInt(obj[i]['read'])+0)+'</span>';
            $hmtl+='&nbsp;<span>评论'+ (parseInt(obj[i]['comments'])+0)+'</span></div>';
            $hmtl+='</div>';
            $hmtl+='</div>';
            $hmtl+='</div>';
            $hmtl+='</div>';
            $hmtl+='<div class="line10"></div>';
        }
        return $hmtl;
    }
</script>
</body>
</html>