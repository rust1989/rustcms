<?php
/**
 * 数据库配置
 */
return array(
		/* 数据库设置 */
		'DB_TYPE'               => 'mysql',     // 数据库类型
		'DB_HOST'               => 'localhost', // 服务器地址
		'DB_NAME'               => 'rustcms',          // 数据库名
		'DB_USER'               => 'root',      // 用户名
		'DB_PWD'                => '',          // 密码
		'DB_PORT'               => '3306',        // 端口
		'DB_PREFIX'             => 'think_',    // 数据库表前缀
		//密钥
	    "AUTHCODE" => 'bbC0IvA3kwfu33djcZ',
	    //cookies
	    "COOKIE_PREFIX" => '4emmTc_',
		
		'TMPL_PARSE_STRING'  =>array(
		
				'__PUBLIC__' => '/statics', // 更改默认的__PUBLIC__ 替换规则
		
				'__JS__' => '/statics/js', // 增加新的JS类库路径替换规则
		
				'__CSS__' => '/statics/css', // 增加新的JS类库路径替换规则
		
				'__IMG__' => '/statics/images', // 增加新的JS类库路径替换规则
		
				'__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
		
		)
);