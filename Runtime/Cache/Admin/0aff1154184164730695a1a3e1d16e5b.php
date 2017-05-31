<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>会员编辑</title>
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


    <style>
        .regform{width: 600px;margin-bottom: 50px;display: none}
        .regform .fg-r{width: 500px;}
        .regform .fg-r textarea{width: 490px;}
        .regform .fg-l{width: 100px;}
    </style>
</head>
<body>
<div class="page_title">用户资料</div>
<div class="tab_box" id="title_tab">
    <ul>
        <li class="onselect" data-name="infoform">基本信息</li>
        <li data-name="picform">用户图片</li>
    </ul>
</div>
<form class="regform" id="infoform" onsubmit="return false;" style="padding-bottom: 50px;margin-top: 20px;">
    <input type="hidden" name="uid" value="<?php echo ($user["uid"]); ?>"/>
    <div class="form-group">
        <div class="fg-l tr fl">等级(VIP)：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="level">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <?php if(is_array($level)): $i = 0; $__LIST__ = $level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">昵称：</div>
        <div class="fg-r fr"><input type="text" name="nickname" value="<?php echo ($user["nickname"]); ?>" class="form-control fr" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">手机号码：</div>
        <div class="fg-r fr"><input type="text" value="<?php echo ($user["tel"]); ?>" class="form-control fr" name="tel" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">邮箱：</div>
        <div class="fg-r fr"><input type="text" value="<?php echo ($user["email"]); ?>" class="form-control fr" name="email" /></div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">性别：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="sex">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <li data-value="1">实力大叔(男)</li>
                    <li data-value="2">美女萝莉(女)</li>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">年龄：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="age">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <?php
 for($i=15;$i<80;$i++){ ?>
                    <li data-value="<?php echo ($i); ?>"><?php echo ($i); ?></li>
                    <?php
 } ?>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">所在城市：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="proivce">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <li data-value="">请选择</li>
                    <?php if(is_array($priovce)): $i = 0; $__LIST__ = $priovce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-value="<?php echo ($vo["aid"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="city">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <li data-value="">请选择</li>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <?php if($user['sex'] == 2): ?><div class="form-group hide" id="bwh">
            <div class="fg-l tr fl">三围：</div>
            <div class="fg-r fr">
                &nbsp;
                <input type="text" name="bust" value="<?php echo ($user["bust"]); ?>" placeholder="胸围/cm" class="form-control fl" style="width: 100px;"/>
                <input type="text" name="waist" value="<?php echo ($user["waist"]); ?>" placeholder="腰围/cm" class="form-control fl"  style="width: 100px;margin-left: 4px;"/>
                <input type="text" name="hip"  value="<?php echo ($user["hip"]); ?>" placeholder="臀围/cm" class="form-control fl"  style="width: 100px;margin-left: 4px;"/>
            </div>
            <div class="clr"></div>
        </div><?php endif; ?>
    <div class="form-group">
        <div class="fg-l tr fl">身高：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="height">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <li data-value="">请选择</li>
                    <?php
 for($i=145;$i<210;$i++){ ?>
                    <li data-value="<?php echo ($i); ?>"><?php echo ($i); ?>cm</li>
                    <?php
 } ?>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">学历：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="education">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
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
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">婚姻状况：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="marriage">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <li data-value="">请选择</li>
                    <li data-value="未婚">未婚</li>
                    <li data-value="离异">离异</li>
                    <li data-value="丧偶">丧偶</li>
                    <li data-value="非单身">非单身</li>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="form-group">
        <div class="fg-l tr fl">月收入：</div>
        <div class="fg-r fr">
            <div class="idealforms_select fl" style="width: 120px;" >
                <div class="idealforms_select_obj" >
                    <input type="hidden" value="" name="income">
                    <input type="text" value="" readonly>
                    <span class="icaret"></span>
                </div>
                <ul class="idealforms_select_menu" style="text-indent: 10px;">
                    <li data-value="">请选择</li>
                    <li data-value="3000元以下">3000元以下</li
                    <li data-value="3001元-5000元" >3001元-5000元</li>
                    <li data-value="5001元-8000元">5001元-8000元</li>
                    <li data-value="8001元-12000元">8001元-12000元</li>
                    <li data-value="12001元-20000元">12001元-20000元</li>
                    <li data-value="20001元-50000元">20001元-50000元</li>
                    <li data-value="50001元以上">50001元以上</li>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">爱好：</div>
        <div class="fg-r fr"><input type="text" name="hobby" value="<?php echo ($user["hobby"]); ?>" class="form-control fr" /></div>
        <div class="clr"></div>
    </div>

    <div class="form-group">
        <div class="fg-l tr fl">自我介绍：</div>
        <div class="fg-r fr">
            <textarea name="describe" style="resize: none;height: 50px;" placeholder="自我介绍，300字以内"><?php echo ($user["describe"]); ?></textarea>
        </div>
        <div class="clr"></div>
    </div>
    <button type="submit" style="margin-left: 100px;" class=" fl btn clof btn-blue" onclick="modifyuser();">修改</button>
</form>
<form class="regform" id="picform" onsubmit="return false;" style="padding-bottom: 50px;margin-top: 20px">
    <table border="0"class="mytables" style="width: 98%;min-width: 800px; margin: 0 auto;margin-left: 10px;">
        <tr>
            <th width="5%" class="tc">ID</th>
            <th width="10%" class="tc">图片</th>
            <th width="7%" class="tc">用户</th>
            <th width="5%" class="tc">类型</th>
            <th width="5%" class="tc">读取</th>
            <th class="tc">备注</th>
            <th width="15%" class="tc">操作</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="banner_<?php echo ($vo["id"]); ?>">
                <td><?php echo ($vo["id"]); ?></td>
                <td><img src="http://www.lovehou.com/Public/<?php echo ($vo["img"]); ?>" width="120" alt=""/></td>
                <td><?php echo ($vo["nickname"]); ?></td>
                <td> <?php if($vo['type'] == 1): ?>照片<?php else: ?>头像<?php endif; ?></td>
                <td><?php echo ($vo["read"]); ?></td>
                <td align="left"><?php echo ($vo["note"]); ?></td>
                <td style="text-align: center;max-width: 130px;">
                    <?php if($vo['status'] == 0): ?><select name="" onchange="passShow(this,'<?php echo ($vo["id"]); ?>');">
                            <option value="1">待审核</option>
                            <option value="1">审核通过</option>
                            <option value="2">不通过</option>
                        </select>
                        <?php elseif($vo['status'] == 1): ?>
                        审核通过
                        <?php else: ?>
                        不通过<?php endif; ?>
                    <!--只能禁用相片，头像不禁用-->
                    <?php if($vo['type'] == 1 and $vo['status'] == 1): if($vo['status'] == -1): ?><a style="color:#333333" href="javascript: setVal('member_photo','status','<?php echo ($vo["id"]); ?>',1);" >禁用</a>
                        <?php else: ?>
                            <a style="color: #008000" href="javascript: setVal('member_photo','status','<?php echo ($vo["id"]); ?>',-1);" >启用</a><?php endif; endif; ?>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</form>

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

    $('#'+$('#title_tab li.onselect').data('name')).show();
    $('#title_tab li').click(function(){
        $('#title_tab li').removeClass('onselect');
        $(this).addClass('onselect');
        $('.regform').hide();
        $('#'+$(this).data('name')).show();
    })

    $("#infoform").idealforms();
    setSelectSelected('#infoform input[name=level]',"<?php echo ($user['level']); ?>");
    setSelectSelected('#infoform input[name=sex]',"<?php echo ($user['sex']); ?>");
    setSelectSelected('#infoform input[name=age]',"<?php echo ($user['age']); ?>");
    setSelectSelected('#infoform input[name=proivce]',"<?php echo ($user['proivce']); ?>");
    setSelectSelected('#infoform input[name=city]',"<?php echo ($user['city']); ?>");
    setSelectSelected('#infoform input[name=height]',"<?php echo ($user['height']); ?>");
    setSelectSelected('#infoform input[name=education]',"<?php echo ($user['education']); ?>");
    setSelectSelected('#infoform input[name=marriage]',"<?php echo ($user['marriage']); ?>");
    setSelectSelected('#infoform input[name=income]',"<?php echo ($user['income']); ?>");
    $('#infoform input[name=proivce]').parents().siblings('.idealforms_select_menu').find('li').click(function(){
        if(parseInt($(this).data('value'))>0){
            checkeSupsort( $(this).data('value'), $('#infoform input[name=city]').parents().siblings('.idealforms_select_menu'));
        }
    })


    window.subBlock = false;
    function modifyuser(){
        if(subBlock){
            return false;
        }
        subBlock = true;//阻塞
        var $data = $("#infoform").serialize();
        $.post('/admin/member/modifyuser.html', $data, function (data) {
            subBlock = false;//解除阻塞
            if (data.code == 200) {
                clearpop(data.message);
            } else {
                clearpop(data.message);
            }
        })
    }
</script>
</body>
</html>