jQuery.cookie = function(name, value, options) {
	if(!window.localStorage){
	    //创建localStorage
	    var localStorageClass = function(){
	            this.options = {
	            expires : 60*24*3600
	            }
	    	}
	    localStorageClass.prototype = {
	        //初实化。添加过期时间
	           init:function(){
	            var date = new Date();
	            date.setTime(date.getTime() + 60*24*3600);
	            this.setItem('expires',date.toGMTString());
	           },
	        //内部函数 参数说明(key) 检查key是否存在
	           findItem:function(key){
	            var bool = document.cookie.indexOf(key);
	            if( bool < 0 ){
	                return true;
	            }else{
	                return false;
	            }
	           },
	           //得到元素值 获取元素值 若不存在则返回 null
	           getItem:function(key){       
	            var i = this.findItem(key);
	            if(!i){
	                var array = document.cookie.split(';')           
	                for(var j=0;j<array.length;j++){
	                    var arraySplit = array[j];
	                    if(arraySplit.indexOf(key) > -1){
	                         var getValue = array[j].split('=');
	                        //将 getValue[0] trim删除两端空格
	                         getValue[0] = getValue[0].replace(/^\s\s*/, '').replace(/\s\s*$/, '')
	                        if(getValue[0]==key){
	                        return getValue[1];
	                        }else{
	                        return 'null';
	                        }
	                    }
	                }
	            }
	           },
	           //重新设置元素
	           setItem:function(key,value){
	               var i = this.findItem(key)
	            document.cookie=key+'='+value;
	           },
	           //清除cookie 参数一个或多一
	           clear:function(){
	               for(var cl =0 ;cl<arguments.length;cl++){
	                var date = new Date();
	                date.setTime(date.getTime() - 100);
	                document.cookie =arguments[cl] +"=a; expires=" + date.toGMTString();
	               }
	           },
	           removeItem:function(name, value, options){
	        	   options = options || {};
	             if (value === null) {
	                 value = '';
	                 options.expires = -1;
	             }
	             var expires = '';
	             if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
	                 var date;
	                 if (typeof options.expires == 'number') {
	                     date = new Date();
	                     date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
	                 } else {
	                     date = options.expires;
	                 }
	                 expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
	             }
	             var path = options.path ? '; path=' + options.path : '';
	             var domain = options.domain ? '; domain=' + options.domain : '';
	             var secure = options.secure ? '; secure' : '';
	             document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
	           }
	    }
	     localStorage = new localStorageClass();
	    console.log(localStorage);
	    localStorage.init();
	}
    
    if (typeof value != 'undefined') { // name and value given, set cookie
//        options = options || {};
//        if (value === null) {
//            value = '';
//            options.expires = -1;
//        }
//        var expires = '';
//        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
//            var date;
//            if (typeof options.expires == 'number') {
//                date = new Date();
//                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
//            } else {
//                date = options.expires;
//            }
//            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
//        }
//        var path = options.path ? '; path=' + options.path : '';
//        var domain = options.domain ? '; domain=' + options.domain : '';
//        var secure = options.secure ? '; secure' : '';
//        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    	if (value === null) {
    		window.localStorage.removeItem(name, value, options);
    	}else{
    		window.localStorage.setItem(name,value);
    	}
    } else { // only name given, get cookie
//        var cookieValue = null;
//        if (document.cookie && document.cookie != '') {
//            var cookies = document.cookie.split(';');
//            for (var i = 0; i < cookies.length; i++) {
//                var cookie = jQuery.trim(cookies[i]);
//                // Does this cookie string begin with the name we want?
//                if (cookie.substring(0, name.length + 1) == (name + '=')) {
//                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
//                    break;
//                }
//            }
//        }
//        return cookieValue;
    	return window.localStorage.getItem(name);
    }
    
    
};