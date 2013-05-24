<?php
class AdminAction extends AppframeAction{
	public function _initialize(){
		parent::_initialize();
		define('IS_ADMIN',true);
		$this->initMenu();
	}
	public function index(){
		
	}
	protected  function initMenu(){
		$menu=F("Menu");
		if(!$menu)
			D("Menu")->create_cache();
	}
	protected function checkLogin(){
		
	}
}