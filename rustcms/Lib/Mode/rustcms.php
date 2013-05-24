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
// $Id: mode.php 2702 2012-02-02 12:35:01Z liu21st $
return array(
   'core'         =>   array(
        THINK_PATH.'Common/functions.php', // 标准模式函数库
        CORE_PATH.'Core/Log.class.php',    // 日志处理类
        LIB_PATH.'Mode/rustcms/Dispatcher.class.php', // URL调度类
        LIB_PATH.'Mode/rustcms/App.class.php',   // 应用程序类
        CORE_PATH.'Core/Action.class.php', // 控制器类
        CORE_PATH.'Core/View.class.php',  // 视图类
    ),		 
);
