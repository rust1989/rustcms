<?php
//开启调试模式
define("APP_DEBUG",true);
define("SITE_PATH",getcwd());
define("APP_NAME","rustcms");
define("APP_PATH",SITE_PATH.'/rustcms/');
define("MODE_NAME",APP_NAME);
define("MODE_PATH",APP_PATH.'Lib/Mode/');
define("RUNTIME_PATH",SITE_PATH.'/#runtime/');
define('TMPL_PATH',APP_PATH.'Template/');

//版本号
define('RUST_VERSION','20130521');
require APP_PATH."Core/ThinkPHP.php";
?>