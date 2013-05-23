<?php
<<<<<<< HEAD
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
=======
//开户调试模式
define("APP_DEBUG",false);
//网站当前路径
define("SITE_PATH", getcwd());
//项目名称
define("APP_NAME","rustcms");
//项目路径
define("APP_PATH",SITE_PATH."/rustcms/");
//定义缓存路径
define("RUNTIME_PATH",SITE_PATH."/runtime/");
//定义模版路径
define("TEMPLATE_PATH",APP_PATH."Template/");
//版本
define("RUSTCMS_VERSION",'20130521');
//大小写忽略处理
foreach (array("g","m") as $v){
	if(isset($_GET[$v]))
		$_GET[$v]=ucwords($_GET[$v]);
}

require APP_PATH.'Core/ThinkPHP.php';
>>>>>>> d46290d87d1f4a6e9d89003fef029948a08bd7c7
