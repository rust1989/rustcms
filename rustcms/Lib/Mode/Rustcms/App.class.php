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
// $Id: App.class.php 2792 2012-03-02 03:36:36Z liu21st $

/**
 +------------------------------------------------------------------------------
 * ThinkPHP 应用程序类 执行应用过程管理
 * 可以在模式扩展中重新定义 但是必须具有Run方法接口
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Core
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id: App.class.php 2792 2012-03-02 03:36:36Z liu21st $
 +------------------------------------------------------------------------------
 */
class App {

    /**
     +----------------------------------------------------------
     * 应用程序初始化
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    static public function init() {

        // 设置系统时区
        date_default_timezone_set(C('DEFAULT_TIMEZONE'));
        // 加载动态项目公共文件和配置
        load_ext_file();
        // URL调度
        Dispatcher::dispatch();
        
        
        //定义当前请求的系统常量
        define("NOW_TIME",$_SERVER['REQUEST_TIME']);
        define("REQUEST_METHOD",$_SERVER['REQUEST_METHOD']);
        define("IS_GET",REQUEST_METHOD=='GET'?true:false);
        define("IS_POST",REQUEST_METHOD=='POST'?true:false);
        define("IS_PUT",REQUEST_METHOD=='PUT'?true:false);
        define("IS_DELETE",REQUEST_METHOD=='DELETE'?true:false);
        define('IS_AJAX',((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || !empty($_POST[C('VAR_AJAX_SUBMIT')]) || !empty($_GET[C('VAR_AJAX_SUBMIT')])) ? true : false);
        
        // URL调度结束标签
        tag('url_dispatch');
        //页面压宿输出
        if(C("OUTPUT_ENCODE")){
          $zlib=ini_get("zlib.output_compression");
          if(empty($zlib)) ob_start("ob_gzhandler");
        }
        //系统变量安全过滤
        if(C('VAR_FILTERS')){
        	$filters=explode(',',C('VAR_FILTERS'));
        	foreach ($filters as $filter){
        	  array_walk_recursive($_GET,$filter);//对数组每个元素应用回调函数，跟array_walk的区别是，如果元素也是数组，会递归到更深入去
        	  array_walk_recursive($_POST,$filter);	
        	}
        }
        	
        
        if(defined('GROUP_NAME')) {
            // 加载分组配置文件
            if(is_file(CONF_PATH.GROUP_NAME.'/config.php'))
                C(include CONF_PATH.GROUP_NAME.'/config.php');
            // 加载分组函数文件
            if(is_file(COMMON_PATH.GROUP_NAME.'/function.php'))
                include COMMON_PATH.GROUP_NAME.'/function.php';
        }

        /* 获取模板主题名称 */
        $templateSet =  C('DEFAULT_THEME');
        if(C('TMPL_DETECT_THEME')) {// 自动侦测模板主题
            $t = C('VAR_TEMPLATE');
            if (isset($_GET[$t])){
                $templateSet = $_GET[$t];
            }elseif(cookie('think_template')){
                $templateSet = cookie('think_template');
            }
            // 主题不存在时仍改回使用默认主题
            
            if(!in_array($templateSet,explode(',',C('THEME_LIST')))){
            	$templateSet =  C('DEFAULT_THEME');
            }
            cookie('think_template',$templateSet,864000);
            
        }
        /* 模板相关目录常量 */
        define('THEME_NAME',   $templateSet);                  // 当前模板主题名称
        $group   =  defined('GROUP_NAME')?GROUP_NAME.'/':'';
        if(1==C("APP_GROUP_MODE")){//独立分组
        	define('THEME_PATH',BASE_LIB_PATH.basename(TMPL_PATH).'/'.(THEME_NAME?THEME_NAME.'/':''));
        	define('APP_TMPL_PATH',__ROOT__.'/'.APP_NAME.(APP_NAME?'/':'').C('APP_GROUP_PATH').'/'.$group.(THEME_NAME?THEME_NAME.'/':''));
        }else{
        define('THEME_PATH',   TMPL_PATH.$group.(THEME_NAME?THEME_NAME.'/':''));
        define('APP_TMPL_PATH',__ROOT__.'/'.APP_NAME.(APP_NAME?'/':'').basename(TMPL_PATH).'/'.$group.(THEME_NAME?THEME_NAME.'/':''));
        C('TEMPLATE_NAME',THEME_PATH.MODULE_NAME.(defined('GROUP_NAME')?C('TMPL_FILE_DEPR'):'/').ACTION_NAME.C('TMPL_TEMPLATE_SUFFIX'));
        }
        C('CACHE_PATH',CACHE_PATH.$group);
        //动态配置TMPL_EXCEPTION_FILE 改为绝对路径
        C('TMPL_EXCEPTION_FILE',realpath(C('TMPL_EXCEPTION_FILE')));
        return ;
    }

    /**
     +----------------------------------------------------------
     * 执行应用程序
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    static public function exec() {
        // 安全检测
        if(!preg_match('/^[A-Za-z_0-9]+$/',MODULE_NAME)){
            $module =  false;
        }else{
            //创建Action控制器实例
            $group =  defined('GROUP_NAME')&& C('APP_GROUP_MODE')==0 ? GROUP_NAME.'/' : '';
            $module  =  A($group.MODULE_NAME);
        }

        if(!$module) {
            if(function_exists('__hack_module')) {
                // hack 方式定义扩展模块 返回Action对象
                $module = __hack_module();
                if(!is_object($module)) {
                    // 不再继续执行 直接返回
                    return ;
                }
            }else{
                // 是否定义Empty模块
                $module = A('Empty');
                if(!$module){
                    $msg =  L('_MODULE_NOT_EXIST_').MODULE_NAME;
                    if(APP_DEBUG) {
                        // 模块不存在 抛出异常
                        throw_exception($msg);
                    }else{
                        if(C('LOG_EXCEPTION_RECORD')) Log::write($msg);
                        send_http_status(404);
                        exit;
                    }
                }
            }
        }
        // 获取当前操作名 支持动态路由
        $action = C('ACTION_NAME')?C('ACTION_NAME'):ACTION_NAME;
        C('TEMPLATE_NAME',THEME_PATH.MODULE_NAME.C('TMPL_FILE_DEPR').$action.C('TMPL_TEMPLATE_SUFFIX'));
        $action .=  C('ACTION_SUFFIX');
        
        
        try{
        	if(!preg_match('/^[A-Za-z](\w)*$/', $action)){
        		//非法操作
        		throw new ReflectionException();
        	}
        	//执行当前操作
        	$method=new ReflectionMethod($module, $action);
        	if($method->isPublic()){
        		$class=new ReflectionClass($module);
        		//前置操作
        		if($class->hasMethod("_before_".$action)){
        			$before=$class->getMethod("_before_".$action);
        			if($before->isPublic()){
        				$before->invoke($module);
        			}
        		}
        		//URL参数绑定检测
        		if(C('URL_PARAMS_BIND')&& $method->getNumberOfParameters()>0){
        			switch($_SERVER['REQUEST_METHOD']){
        				case 'POST':
        					$vars=array_merge($_GET,$_POST);
        				break;
        				case 'PUT':
        					parse_str(file_get_contents('php://input'),$vars);
        				break;
        				default:
        				 $vars=$_GET;
        			}
        			$params=$method->getParameters();
        			foreach ($params as $param){
        				$name=$param->getName();
        				if(isset($vars[$name])){
        					$args[]=$vars[$name];
        				}else if($param->isDefaultValueAvailable()){
        					$args[]=$param->getDefaultValue();
        				}else{
        					throw_exception(L('_PARAM_ERROR_').':'.$name);
        				}
        			}
        			$method->invokeArgs($module, $args);
        			
        			// 后置操作
        			if($class->hasMethod('_after_'.$action)) {
        				$after =   $class->getMethod('_after_'.$action);
        				if($after->isPublic()) {
        					$after->invoke($module);
        				}
        			}
        		}else{
        			$method->invoke($module);
        		}
        	}else{
        		throw new ReflectionException();
        	}
        }catch(ReflectionException $e){
        	// 方法调用发生异常后 引导到__call方法处理
        	$method=new ReflectionMethod($module,'__call');
        	$method->invokeArgs($module,array($action,''));
        }
        
        return ;
    }

    /**
     +----------------------------------------------------------
     * 运行应用实例 入口文件使用的快捷方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    static public function run() {
        // 项目初始化标签
        tag('app_init');
        App::init();
        // 项目开始标签
        tag('app_begin');
        // Session初始化
        session(C('SESSION_OPTIONS'));
        // 记录应用初始化时间
        G('initTime');
        App::exec();
        // 项目结束标签
        tag('app_end');
        // 保存日志记录
        if(C('LOG_RECORD')) Log::save();
        return ;
    }

}