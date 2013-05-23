<?php
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
?>