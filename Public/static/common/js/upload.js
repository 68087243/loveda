var url = "http://"+window.location.host+"/"; //图片上传回调地址
function upload(){};
upload.prototype.uploadPic= function(scope,uploadPhp){
    uploadPhp = url+'/Public/uploadForKindeditor.php';
    var uploadJson = uploadPhp+"?scope="+scope+"&callback="+url+"Public/redirect.html";
    var editor = KindEditor.editor({
        uploadJson : uploadJson
    });
    editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
            showRemote:false,
            clickFn : function(url,title){

                var path = url.replace(/\/Public/, "");
                upload.prototype.callback(url, path);
                setTimeout(function() {
                    editor.hideDialog().focus();
                }, 0);
            }
        });
    });
}

upload.prototype.createContent = function(contentId, scope,width,height){
    if(!height){
        height=350
    }
    if(!width){
        width=700
    }
    uploadPhp = url+'/Public/kindeditor/php/upload_json.php';
    var uploadJson = uploadPhp+"?scope="+scope;
    var options ={
        urlType: 'domain',
        filterMode:false,
        showRemote : false,
        width:width+'px',
        height:height+'px',
        uploadJson :uploadJson,
        allowFileManager : true, //开启多文件上传
        autoHeightMode : true,

        afterChange : function() {
            this.sync();
        },
        afterBlur:function(){
            this.sync();
        }

    };
    var editor = KindEditor.create("#"+contentId,options);
    return editor;
}

