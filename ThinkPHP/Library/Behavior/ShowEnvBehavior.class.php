<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Behavior;
use Think\Log;
/**
 * 系统行为扩展：页面Trace显示输出
 */
class ShowEnvBehavior {

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        // 调用Trace页面模板
        if(HIDDEN_ENV_FLAG && ('local'==DEPLOY_ENV || 'test'==DEPLOY_ENV)){
            ob_start();
            include THINK_PATH.'Tpl/show_env.tpl';
            echo  ob_get_clean();
        }
    }
}
