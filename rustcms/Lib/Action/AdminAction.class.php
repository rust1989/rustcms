<?php
class AdminAction extends AppframeAction{
	public function __initialize(){
		parent::__initialize();
		define('IS_ADMIN',true);
		$this->initMenu();
	}
	public function index(){
		die('22');
	}
	protected  function initMenu(){
		$menu=F("Menu");
		if(!$menu)
			D("Menu")->create_cache();
	}
}