<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: Dispatcher.class.php 2840 2012-03-23 05:56:20Z liu21st@gmail.com $

/**
 +------------------------------------------------------------------------------
 * ThinkPHP内置的Dispatcher类
 * 完成URL解析、路由和调度
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Util
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id: Dispatcher.class.php 2840 2012-03-23 05:56:20Z liu21st@gmail.com $
 +------------------------------------------------------------------------------
 */
class Dispatcher {

    /**
     +----------------------------------------------------------
     * URL映射到控制器
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    static public function dispatch() {
        $urlMode  =  C('URL_MODEL');
        if(!empty($_GET[C('VAR_PATHINFO')])) { // 判断URL里面是否有兼容模式参数
            $_SERVER['PATH_INFO']   = $_GET[C('VAR_PATHINFO')];
            unset($_GET[C('VAR_PATHINFO')]);
        }
        if($urlMode == URL_COMPAT ){
            // 兼容模式判断
            define('PHP_FILE',_PHP_FILE_.'?'.C('VAR_PATHINFO').'=');
        }elseif($urlMode == URL_REWRITE ) {
            //当前项目地址
            $url    =   dirname(_PHP_FILE_);
            if($url == '/' || $url == '\\')
                $url    =   '';
            define('PHP_FILE',$url);
        }else {
            //当前项目地址
            define('PHP_FILE',_PHP_FILE_);
        }

        // 开启子域名部署
        if(C('APP_SUB_DOMAIN_DEPLOY')) {
            $rules = C('APP_SUB_DOMAIN_RULES');
            $subDomain    = strtolower(substr($_SERVER['HTTP_HOST'],0,strpos($_SERVER['HTTP_HOST'],'.')));
            define('SUB_DOMAIN',$subDomain); // 二级域名定义
            if($subDomain && isset($rules[$subDomain])) {
                $rule =  $rules[$subDomain];
            }elseif(isset($rules['*'])){ // 泛域名支持
                if('www' != $subDomain && !in_array($subDomain,C('APP_SUB_DOMAIN_DENY'))) {
                    $rule =  $rules['*'];
                }
            }
            if(!empty($rule)) {
                // 子域名部署规则 '子域名'=>array('分组名/[模块名]','var1=a&var2=b');
                $array   =  explode('/',$rule[0]);
                $module = array_pop($array);
                if(!empty($module)) {
                    $_GET[C('VAR_MODULE')] = $module;
                    $domainModule   =  true;
                }
                if(!empty($array)) {
                    $_GET[C('VAR_GROUP')]  = array_pop($array);
                    $domainGroup =  true;
                }
                if(isset($rule[1])) { // 传入参数
                    parse_str($rule[1],$parms);
                    $_GET   =  array_merge($_GET,$parms);
                }
            }
        }
        // 分析PATHINFO信息
        if(empty($_SERVER['PATH_INFO'])) {
            $types   =  explode(',',C('URL_PATHINFO_FETCH'));
            foreach ($types as $type){
                if(0===strpos($type,':')) {// 支持函数判断
                    $_SERVER['PATH_INFO'] =   call_user_func(substr($type,1));
                    break;
                }elseif(!empty($_SERVER[$type])) {
                    $_SERVER['PATH_INFO'] = (0 === strpos($_SERVER[$type],$_SERVER['SCRIPT_NAME']))?
                        substr($_SERVER[$type], strlen($_SERVER['SCRIPT_NAME']))   :  $_SERVER[$type];
                    break;
                }
            }
        }
        $depr = C('URL_PATHINFO_DEPR');
        if(!empty($_SERVER['PATH_INFO'])) {
            tag('path_info');
            if(C('URL_HTML_SUFFIX')) {
                $_SERVER['PATH_INFO'] = preg_replace('/\.'.trim(C('URL_HTML_SUFFIX'),'.').'$/i', '', $_SERVER['PATH_INFO']);
            }
            if(!self::routerCheck()){   // 检测路由规则 如果没有则按默认规则调度URL
                $paths = explode($depr,trim($_SERVER['PATH_INFO'],'/'));
                if(C('VAR_URL_PARAMS')) {
                    // 直接通过$_GET['_URL_'][1] $_GET['_URL_'][2] 获取URL参数 方便不用路由时参数获取
                    $_GET[C('VAR_URL_PARAMS')]   =  $paths;
                }
                $var  =  array();
                if (C('APP_GROUP_LIST') && !isset($_GET[C('VAR_GROUP')])){
                    $var[C('VAR_GROUP')] = in_array(strtolower($paths[0]),explode(',',strtolower(C('APP_GROUP_LIST'))))? array_shift($paths) : '';
                    if(C('APP_GROUP_DENY') && in_array(strtolower($var[C('VAR_GROUP')]),explode(',',strtolower(C('APP_GROUP_DENY'))))) {
                        // 禁止直接访问分组
                        exit;
                    }
                }
                if(!isset($_GET[C('VAR_MODULE')])) {// 还没有定义模块名称
                    $var[C('VAR_MODULE')]  =   array_shift($paths);
                }
                $var[C('VAR_ACTION')]  =   array_shift($paths);
                // 解析剩余的URL参数
                $res = preg_replace('@(\w+)'.$depr.'([^'.$depr.'\/]+)@e', '$var[\'\\1\']=strip_tags(\'\\2\');', implode($depr,$paths));
                $_GET   =  array_merge($var,$_GET);
            }
            define('__INFO__',$_SERVER['PATH_INFO']);
        }

<<<<<<< HEAD
        // 获取分组 模块和操作名称
        if (C('APP_GROUP_LIST')) {
            define('GROUP_NAME', self::getGroup(C('VAR_GROUP')));
        }
        define('MODULE_NAME',self::getModule(C('VAR_MODULE')));
        define('ACTION_NAME',self::getAction(C('VAR_ACTION')));
        // URL常量
        define('__SELF__',strip_tags($_SERVER['REQUEST_URI']));
        // 当前项目地址
        define('__APP__',strip_tags(PHP_FILE));
        // 当前模块和分组地址
        $module = defined('P_MODULE_NAME')?P_MODULE_NAME:MODULE_NAME;
        if(defined('GROUP_NAME')) {
            define('__GROUP__',(!empty($domainGroup) || strtolower(GROUP_NAME) == strtolower(C('DEFAULT_GROUP')) )?__APP__ : __APP__.'/'.GROUP_NAME);
            define('__URL__',!empty($domainModule)?__GROUP__.$depr : __GROUP__.$depr.$module);
        }else{
            define('__URL__',!empty($domainModule)?__APP__.'/' : __APP__.'/'.$module);
        }
        // 当前操作地址
        define('__ACTION__',__URL__.$depr.ACTION_NAME);
=======
        // URL常量
        define('__SELF__',strip_tags($_SERVER['REQUEST_URI']));
        // 当前项目地址
        define('__APP__',strip_tags(PHP_FILE));
        
        // 获取分组 模块和操作名称
        if (C('APP_GROUP_LIST')) {
        	define('GROUP_NAME', self::getGroup(C('VAR_GROUP')));
        	// 分组URL地址
        	define('__GROUP__',(!empty($domainGroup) || strtolower(GROUP_NAME) == strtolower(C('DEFAULT_GROUP')) )?__APP__ : __APP__.'/'.GROUP_NAME);
        }
        // 定义项目基础加载路径
        define('BASE_LIB_PATH', (defined('GROUP_NAME') && C('APP_GROUP_MODE')==1) ? APP_PATH.C('APP_GROUP_PATH').'/'.GROUP_NAME.'/' : LIB_PATH);
        if(defined('GROUP_NAME')) {
        	if(1 == C('APP_GROUP_MODE')){ // 独立分组模式
        		$config_path    =   BASE_LIB_PATH.'Conf/';
        		$common_path    =   BASE_LIB_PATH.'Common/';
        	}else{ // 普通分组模式
        		$config_path    =   CONF_PATH.GROUP_NAME.'/';
        		$common_path    =   COMMON_PATH.GROUP_NAME.'/';
        	}
        	// 加载分组配置文件
        	if(is_file($config_path.'config.php'))
        		C(include $config_path.'config.php');
        	// 加载分组别名定义
        	if(is_file($config_path.'alias.php'))
        		alias_import(include $config_path.'alias.php');
        	// 加载分组tags文件定义
        	if(is_file($config_path.'tags.php'))
        		C('tags', include $config_path.'tags.php');
        	// 加载分组函数文件
        	if(is_file($common_path.'function.php'))
        		include $common_path.'function.php';
        }

        define('MODULE_NAME',self::getModule(C('VAR_MODULE')));
        define('ACTION_NAME',self::getAction(C('VAR_ACTION')));
        // 当前模块和分组地址
        $moduleName    =   defined('MODULE_ALIAS')?MODULE_ALIAS:MODULE_NAME;
        if(defined('GROUP_NAME')) {
        	define('__URL__',!empty($domainModule)?__GROUP__.$depr : __GROUP__.$depr.$moduleName);
        }else{
        	define('__URL__',!empty($domainModule)?__APP__.'/' : __APP__.'/'.$moduleName);
        }
        
        // 当前操作地址
        define('__ACTION__',__URL__.$depr.(defined('Action_ALIAS')?ACTION_ALIAS:ACTION_NAME));
>>>>>>> d46290d87d1f4a6e9d89003fef029948a08bd7c7
        //保证$_REQUEST正常取值
        $_REQUEST = array_merge($_POST,$_GET);
    }

    /**
     +----------------------------------------------------------
     * 路由检测
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    static public function routerCheck() {
        $return   =  false;
        // 路由检测标签
        tag('route_check',$return);
        return $return;
    }

    /**
     +----------------------------------------------------------
     * 获得实际的模块名称
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static private function getModule($var) {
        $module = (!empty($_GET[$var])? $_GET[$var]:C('DEFAULT_MODULE'));
        unset($_GET[$var]);
        if(C('URL_CASE_INSENSITIVE')) {
            // URL地址不区分大小写
            define('P_MODULE_NAME',strtolower($module));
            // 智能识别方式 index.php/user_type/index/ 识别到 UserTypeAction 模块
            $module = ucfirst(parse_name(P_MODULE_NAME,1));
        }
        return strip_tags($module);
    }

    /**
     +----------------------------------------------------------
     * 获得实际的操作名称
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static private function getAction($var) {
        $action   = !empty($_POST[$var]) ?
            $_POST[$var] :
            (!empty($_GET[$var])?$_GET[$var]:C('DEFAULT_ACTION'));
        unset($_POST[$var],$_GET[$var]);
        define('P_ACTION_NAME',$action);
        return strip_tags(C('URL_CASE_INSENSITIVE')?strtolower($action):$action);
    }

    /**
     +----------------------------------------------------------
     * 获得实际的分组名称
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    static private function getGroup($var) {
        $group   = (!empty($_GET[$var])?$_GET[$var]:C('DEFAULT_GROUP'));
        unset($_GET[$var]);
        return strip_tags(C('URL_CASE_INSENSITIVE') ?ucfirst(strtolower($group)):$group);
    }

}