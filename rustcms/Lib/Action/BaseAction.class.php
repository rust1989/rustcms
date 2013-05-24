<?php
class BaseAction extends AppframeAction{
	function _initialize(){
		parent::_initialize();
		define('IS_ADMIN',false);
		$this->initModel();
		//全局模版变量
		//栏目数组
		$this->assign("Categorys",F("Category"));
		//模型数组
		$this->assign("Model",F("Model"));
		//
	}
}