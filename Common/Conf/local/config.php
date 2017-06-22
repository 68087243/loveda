<?php
return array(
    //'配置项'  => '配置值'
    'DB_TYPE' => 'mysql', //使用的数据库类型
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'lovehou', //数据库名
    'DB_USER' => 'root', //访问数据库账号
    'DB_PWD' => 'root', //访问数据库密码
    'DB_PORT' => '3306',
    'DB_PREFIX' => 't_', //表前缀
    'SHOW_PAGE_TRACE' => false, //显示调试信息
    'DOMAIN' => 'http://www.adsvip.cn',
     /* 日志 */
    'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL' => 'ERR,NOTIC,INFO,DEBUG,SQL', // 只记录EMERG ALERT CRIT ERR 错误
    'LOG_EXCEPTION_RECORD' => 'true',
    'IS_COMPRESS_HTML'                  =>false,  //是否压缩界面
    // 静态资源
    'TMPL_PARSE_STRING'=>array(
        '__PUBLIC__'=>'http://www.adsvip.cn/Public',
        '__STATIC__'=> 'http://www.adsvip.cn/Public/static',
        '__UPLOAD__'=> 'http://www.adsvip.cn/Public/upload',
    ),
);
?>
