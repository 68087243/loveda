window.subBlock = false;
function login(){
    if(subBlock){
        return false;
    }
    var username =$.trim($("#loginform input[name=username]").val());
    var pwd =$.trim($("#loginform input[name=userpwd]").val());
    if(!username){
        clearpopj('账号不能为空111', "error",true);
        $("#loginform input[name=username]").focus();
        subBlock = false;
        return false;
    }
    if(pwd==""){
        clearpopj('密码不能为空', "error",true);
        $("#loginform input[name=userpwd]").focus();
        subBlock = false;
        return false;
    }
    subBlock = true;
    $.post('/login/login.html',{username:username,password:pwd},function(data){
        subBlock = false;
        if(data.code==200){
            window.location.href = data.data;
        }else{
            clearpopj(data.message, "error",true);
        }
    })
}






























//选择所属省市——省
function checkeSupsort(pid,toobj){
    $.ajax({
        type: "POST",
        url:'/wap/index/getArea.html',
        data: {pid:pid},
        async: false,
        success: function (data) {
            var $obj = data.data,$html='<option value="">请选择</option>';
            for(var i in $obj){
                if($obj[i]){
                    $html += '<option value="'+ $obj[i]['aid']+'">'+ $obj[i]['name']+'</option>';
                }
            }
            $(toobj).html($html);
        }
    });
}

window.subBlock=false;
function subPlan(){
    if(subBlock){
        return false;
    }
    var title = $('#myform input[name=title]').val();
    var addr = $('#myform input[name=addr]').val();
    var startime = $('#myform input[name=startime]').val();
    var duration = $('#myform select[name=duration]').val();
    var payway = $('#myform select[name=payway]').val();
    var earnestfee = $('#myform input[name=earnestfee]').val();
    var budgetfee = $('#myform input[name=budgetfee]').val();
    var contentcn = $('#myform textarea[name=contentcn]').val();
    if(!title){
        clearpop('请填写标题！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!addr){
        clearpop('请填写目的地！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!startime){
        clearpop('请选择出发日期！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!duration){
        clearpop('请选择时长！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!payway){
        clearpop('请选择支付方式！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!earnestfee){
        clearpop('请填写诚意金！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!budgetfee){
        clearpop('请填写费用预算！');
        subBlock = false;//解除阻塞
        return false;
    }
    if(!contentcn){
        clearpop('请填写计划说明！');
        subBlock = false;//解除阻塞
        return false;
    }
    subBlock = true;//阻塞
    var $data = $("#myform").serialize();
    $.post('/home/member/subPlan.html', $data, function (data) {
        subBlock = false;//解除阻塞
        if (data.code == 200) {
            clearpop(data.message, '',data.data);
        } else {
            clearpop(data.message);
        }
    })
}