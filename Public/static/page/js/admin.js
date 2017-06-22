
function setVal(tbl,col,id,val,showmsg){
    $.ajax({url:APP_PATH+"/Admin/Rbac/batch?table="+tbl+"&id="+id+"&col="+col+"&v="+val+"&"+Math.random(),success:function(msg){
        msg=eval(msg);
        if(msg.status=="1"){
            var str=col.substring(0,3).toLowerCase();
            if(str=="pri"||str=="sor"||str=="sto"){  //指定指定不执行操作

            }else{
                if(showmsg == true){
                    clearpop('操作成功!');
                    return ;
                }else{
                    location.reload();
                }
            }
        }else{

        }
    }
    });
}

/**
 * 转换其他空值
 * @param val
 * @returns {*}
 */
function getdefaultval(val){
    if(!val ){
        return '';
    }else{
        return val;
    }
}

//选择所属省市——省
function checkeSupsort(pid,toobj){
    $.ajax({
        type: "POST",
        url:'/wap/index/getArea.html',
        data: {pid:pid},
        async: false,
        success: function (data) {
            var $obj = data.data,$html='<li data-value="">请选择城市</li>';
            for(var i in $obj){
                if($obj[i]){
                    $html += '<li data-value="'+ $obj[i]['aid']+'">'+ $obj[i]['name']+'</li>';
                }
            }
            $(toobj).html($html);
        }
    });
}

//审核照片、头像
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




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(function(){
    var _WIDTH=$(window).width();
    var _HEIGHT=$(window).height();
    var _TOP=95;
    var _LEFT=200;
    var _SPLIT=10;

    //初始化布局
    initPage();
    $(window).resize(function(){initPage();});
    function initPage(){
        _WIDTH=$(window).width();
        _HEIGHT=$(window).height();
        console.log('_WIDTH='+_WIDTH);
        console.log('_HEIGHT='+_HEIGHT);
        console.log('_TOP='+_TOP);
        console.log('_LEFT='+_LEFT);
        console.log('_SPLIT='+_SPLIT);
        $("#Lefter").height(_HEIGHT-_TOP);
        $("#Lefter").width(_LEFT);
        $("#Righter").width(_WIDTH-_LEFT-_SPLIT-2);
        $("#Righter").height($("#Lefter").height());
        $("#Spliter").width(_SPLIT-2);
        $("#Spliter").height($("#Lefter").height());
        $(".container").height($("#Lefter").height());
        setLocation("","");

        //$("#tester").text(_WIDTH-$("#Lefter").width()-_SPLIT+","+_HEIGHT);
    };

    function setLocation(menu1,menu2){
        var html="&nbsp;<b>当前位置：</b> 网站后台";
        html +=  (menu1==""?" > 首页":(" > "+menu1));
        html +=  (menu2==""?"":(" > "+menu2));
        $("#Location").html(html);
    }

    //显隐左侧菜单
    $("#Spliter").click(function(){_LEFT=(_LEFT==200?0:200);$("#Lefter").toggle();$(this).toggleClass("spliterRight",_LEFT==0);initPage();});

    //左侧菜单收缩特效
    $("#LeftMenu ul li:has(ul) span").click(function(){
        setLocation($(this).text(),"");
        var $ul = $(this).siblings("ul");
        if($ul.is(":visible")){
            $(this).attr("class","collapsed");
            $ul.hide();//.slideUp("fast");
        }else{
            $(this).attr("class","expanded");
            $ul.show();//.slideDown("fast");
        }
        return false;
    });

    //菜单链接处理
    $("#LeftMenu li a").attr("target","MainFrame").click(function(){
        setLocation($(this).parent().parent().parent().find("span").text(),$(this).text());
        $("#LeftMenu li a").removeClass("selected");
        $(this).addClass("selected").blur();
    });

    $("#ClrCache").click(function(){
        var obj=$(this).prev("span");
        if(obj.length==0){
            $(this).parent().prepend("<span id='tip'><img src='/Public/Admin/images/load.gif' /></span>");
        };
        obj=$(this).prev("span");
        obj.show();
        $.ajax({url:APP_PATH+'/Admin/Login/clrcache',success:function(msg){
            msg=eval(msg);
            if(msg.status=="1"){
                //alert ("缓存更新成功！");
                obj.hide();
            }else{

            }
        }})
    });

    //var okInterval=setInterval(function(){
    //    $.visit();
    //},100000);
});

(function(){
    /*	$.visit=function(){
     $.ajax({url:"/Login/test"});

     }*/
})(jQuery);