<?php
class AppframeAction extends Action{
    //记录各种缓存
	public static $Cache=array();
    
	public function __initialize(){
		//消除魔术引号转义
		Input::noGPC();
		$this->initSite();
		$this->assign("waitSecond",2000);
	}

	/**
	 * 初始化登录信息
	 * 
	 */
	final protected  function  initUser(){
		
	}
	/**
	 * 初始化网站配置
	 */
	final protected  function iniSite(){
		$config=F("Config");
		self::$Cache['Config']=$config;
		
		$appinfo=array(
				'action'=>ACTION_NAME,
				'group'=>GROUP_NAME,
				'module'=>MODULE_NAME
		);
		$this->assign('appinfo',$appinfo);
	}
	/*
	 * 初始化模型
	 */
	final protected  function initModel(){
		if(!F("Model"))
			D('Model')->create_cache();
		if(!F("Category"))
			D("Category")->create_cache();
	}
}