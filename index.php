<?php
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