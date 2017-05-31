<?php
$hostname = php_uname('n');
if ( strtoupper($hostname) == 'E6SIEH7N44BWVU4' ) {
    define('DEPLOY_ENV', 'local'); // 本地模式
    define('HIDDEN_ENV_FLAG', true); // 环境标示显示
} else {
    define('DEPLOY_ENV', 'pro'); // 线上模式
    define('HIDDEN_ENV_FLAG', false); // 环境标示
}
require './Common/Common/share.php';
define ('APP_DEBUG', true);
define ('DIR_SECURE_FILENAME', false);
define('NO_CACHE_RUNTIME', true);

require './ThinkPHP/ThinkPHP.php';

?>