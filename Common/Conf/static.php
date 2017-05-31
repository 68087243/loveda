<?php
return array(
    'DB_FIELDTYPE_CHECK'=>true, // 开启字段类型验证
    'URL_MODEL'=>2, //URL模式：0普通模式 1PATHINFO 2REWRITE 3兼容模式
    'DEFAULT_MODULE'=>'Home', //默认分组
    'MODULE_ALLOW_LIST' => array('Home', 'Admin','Wap', ),

    'URL_HTML_SUFFIX'=>'.html', //URL伪静态后缀设置
    'DEFAULT_CHARSET'=>'utf-8', // 默认输出编码
    'URL_CASE_INSENSITIVE'=>TRUE, // 默认false 表示URL区分大小写 true则表示不区分大小写

    /* 错误设置 ,部署模式有效 */
    'ERROR_MESSAGE'=> '您浏览的页面暂时发生了错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'=>'/Public/error.html', // 错误定向页面
    'URL_404_REDIRECT'=>'/Public/error.html',


    // RBAC权限配置
    'USER_AUTH_ON' => true, // USER_AUTH_ON 是否需要认证
    'USER_AUTH_TYPE' => 1, // USER_AUTH_TYPE 认证类型
    'USER_AUTH_KEY' => 'authId', // USER_AUTH_KEY 认证识别号
    'REQUIRE_AUTH_MODULE' => '', // REQUIRE_AUTH_MODULE 需要认证模块
    'NOT_AUTH_MODULE' => 'Public', // NOT_AUTH_MODULE 无需认证模块
    'NOT_AUTH_ACTION' => '',
    'USER_AUTH_GATEWAY' => '/Admin/Login', // USER_AUTH_GATEWAY 认证网关
    'USER_AUTH_MODEL' => 'user', // 用户表
    // RBAC_DB_DSN 数据库连接DSN
    'RBAC_ROLE_TABLE' => 'my_role', // RBAC_ROLE_TABLE 角色表名称
    'RBAC_USER_TABLE' => 'my_role_user', // RBAC_USER_TABLE 用户表名称
    'RBAC_ACCESS_TABLE' => 'my_access', // RBAC_ACCESS_TABLE 权限表名称
    'RBAC_NODE_TABLE' => 'my_node', // RBAC_NODE_TABLE 节点表名称
    'ADMIN_AUTH_KEY' => 'administrator',
// 超级管理员
//     /** 模板设置 */
//    'TMPL_STRIP_SPACE' => true,
//    'TAG_NESTED_LEVEL' => 5,


      /* Cookie设置 */
    'COOKIE_DOMAIN' => '.lovehou.com', // Cookie有效域名
    'COOKIE_EXPIRE' => 1800, // Coodie有效期
    'COOKIE_PATH' => '/', // Cookie路径
    'COOKIE_PREFIX' => '', // Cookie前缀 避免冲突
    "DOMAIN"=>"lovehou.com",

    //SESSION 设置
    'SESSION_OPTIONS'=>array(
        'domain'=>'.lovehou.com', //域名
        'expire'=>43200,          //过期时间
//        'type'=>'Redis',   // redis
//        'db'=>15,    // db index
    ),
    'URL_ROUTER_ON' =>'true',    //开启路由
    'URL_ROUTE_RULES' => array(
        '/^superadmin/' =>'/index.php/admin',
        '/^buyorder$/' =>'index/buyorder',
        '/^resorder$/' => '/resorder/index',
        '/^res(\w*)$/' =>'index/res?id=:1',
        '/^start(\w+)$/'=>'start/index?id=:1',
        '/^coupon(\d+)$/' =>'/coupon/index/share?id=:1',
//        '/resinfo(\w+)$/' =>'index/res?id=:1',
        '/info(\d+)$/' =>'/market/index/Info?news_id=:1',
        '/^spreadcase$/' =>'static/spreadCase',
        'reslist/:point' =>'index/reslist',
        '/^error$/'=>'index/error',
        '/^search/'=>'static/search_result',
        '/^product/'=>'static/product',
        '/^usecase/'=>'static/usecase',
        '/^aboutus/'=>'static/aboutus',
        '/^ware$/'=>'static/ware',
        '/^farmshop$/'=>'static/farmshop',
        '/^leader$/'=>'static/leader',
        '/^weixin/'=>'static/weixin',
        '/^trade/'=>'static/trade',
        '/^ladyboss/'=>'static/ladyboss',
        '/^screen/'=>'static/screen',
        '/^cctv/'=>'static/cctv',
        '/^service/'=>'static/service',
        '/^hardware/'=>'static/hardware',
        '/^solution/'=>'static/solution',
        '/^doc/'=>'static/doc',
        '/^joinin/'=>'static/joinin',
        '/^download/'=>'static/download',
        '/^honour/'=>'static/honour',
        '/^customer/'=>'static/customer',
        '/^help/'=>'static/help',
        '/^info/'=>'static/info',
        '/^ask/'=>'static/ask',
        '/^tutorial/'=>'static/tutorial',
        '/^news/'=>'static/news',
        '/^description/'=>'static/description',
        '/^share/'=>'static/share',
        '/^art(\d+)$/' =>'static/article?id=:1',
        '/^toc/'=>'static/toc',
        '/^store/'=>'index/store',
        '/^spread$/'=>'spread/spread/index',
        '/^market(\w+)/'=>'market/index/index?id=:1',
        '/^admin/'=>'spread/spread/index',
        '/^union/'=>'/resorder/login/union',
        '/^saler/'=>'saler/index/login',
        '/^buy(\w+)/'=>'buy?res_id=:1',
        '/^sweeppay$/'=>'index/sweeppay',
        '/^l(\d+)i(\d+)/'=>'task/index?task_id=:1&spread_id=:2',
        '/^position(\w+)$/'=>'/wap/position/index?id=:1',   //地理位置 /wap/positon331.html
        '/^position$/'=>'/wap/position/index',   //地理位置 /wap/positon331.html

    ),
   // 'APP_AUTOLOAD_PATH'   =>'@.Cache,@.Service,@.Exception,@.Session,@.Queue',
    //'TAGLIB_PRE_LOAD'=>'Extend',
)
?>
