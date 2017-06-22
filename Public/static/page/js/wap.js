//选择所属省市——省
function checkeSupsort(pid,toobj){
    $.ajax({
        type: "POST",
        url:'/index/getArea.html',
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
/////////////////////////////////topic_info////////////////////////////////////
//点赞
function likeTopic(tid){
    $.post('/index/likeTopic.html',{tid:tid},function(data){
        if(data.code==200){
            clearpop(data.message,'','self');
        }else{
            clearpop(data.message);
        }
    })
}
//收藏
function favorite(tid){
    $.post('/index/favorite.html',{tid:tid},function(data){
        if(data.code==200){
            clearpop(data.message,'','self');
        }else{
            clearpop(data.message);
        }
    })
}

function reply(touser,tuid,tid){
    if(touser){
        $('#reply input[name=touser]').val(touser);
        $('#reply input[name=message]').val("@"+touser+" ");
    }
    if(tuid){
        $('#reply input[name=uid]').val(tuid);
    }
    if(tid){
        $('#reply input[name=tid]').val(tid);
    }

    $('#reply input[name=type]').val('reply');
    $('.create-topic').hide();
}


//提交评论
function subReply(){
    var tid = $('#reply input[name=tid]').val();
    var message = $('#reply input[name=message]').val();
    var picture = $('#reply input[name=picture]').val();
    var touser = $('#reply input[name=touser]').val();
    if(!tid){
        clearpop('提交错误，请刷新重试！');
        return false;
    }
    if(!message || (touser.length+2) == message.length){
        clearpop('请填写回复内容');
        return false;
    }
    var data = {
        tid : tid,
        message : message,
        picture : picture,
        touser : touser
    }
    $.post('/index/subReply.html',data,function(data){
        if(data.code==200){
            clearpop(data.message,'','self');
        }else{
            clearpop(data.message);
        }
    })
}

var page = 0;
var f = parseInt($('#reply_list ul li').length)+1;
function getReplyByTid(){
    var $tid = $('body').data('tid');
    $.post('/index/getReplyByTid.html',{page:page,tid:$tid},function(data){
        if(data.code == 200){
            var obj = data.data,$html='';
            if(obj){
                for(var i in obj){
                    $html+='<li class="reply-item bordert-d">';
                    $html+='<div class="stream-content">';
                    $html+='<div>';
                    $html+='<div class="fl">';
                    if(obj[i]['picture']){
                        $html+='<a href="/user/userinfo.html?uid='+obj[i]['uid']+'" class="item-user"><img style="position: relative;top: 3px" src="'+PUBLIC+'/'+obj[i]['picture']+'" width="40" alt=""> </a>';
                    }else{
                        $html+='<a href="/user/userinfo.html?uid='+obj[i]['uid']+'" class="item-user"><img  style="position: relative;top: 3px" src="'+STATIC+'/image/defaultAvatar.png" width="40" alt=""> </a>';
                    }
                    $html+='</div>';
                    $html+='<div class="fl" style="margin-left: 5px;">';
                    $html+='<div class="item-nickname fontb clo3" style="height: 17px;" ><a href="/user/userinfo.html?uid='+obj[i]['uid']+'">'+obj[i]['nickname']+'</a></div>';
                    $html+='<span class="clo9 font12"> '+f+'楼&nbsp;&nbsp;'+obj[i]['createtime']+'</span>';
                    $html+='</div>';
                    if($('body').data('currentuid') != obj[i]['uid']){
                        $html+='<div class="fr relative top5 font24 cloc" onclick="reply(\''+obj[i]['nickname']+'\','+obj[i]['uid']+')"><i class="fa fa-commenting"></i></div>';
                    }
                    $html+='<div class="clr"></div>';
                    $html+='</div>';
                    $html+='<div class="clo9">'+obj[i]['message']+'</div>';
                    $html+='</div>';
                    $html+='</li>';
                    f++;
                }
                $('#reply_list ul').append($html);
            }else{
                //$('#reply-list ul').append($html);
            }
        }else{
            clearpop('');
        }
    })
}


function deltopic(tid){
    $.post('/user/deltopic.html',{tid:tid},function(data){
        clearpop(data.message);
        if(data.code == 200){
            $('#row_'+tid).remove();
        }
    })
}
///////////////////////////////////////////
/*side*/
function openside(){
    if($('html').hasClass("openside")){
        $('html').removeClass('openside').addClass('closeside');
    }else{
        $('html').removeClass('closeside').addClass('openside');
    }
}
