<?php
class AdminAction extends AppframeAction{
	public function _initialize(){
		parent::_initialize();
		import("ORG.Util.RBAC");
		if(!RBAC::AccessDecision()){
		   RBAC::checkLogin();
		   $this->error(L("_VALID_ACCESS"));	
		}
		define('IS_ADMIN',true);
	}
	public function index(){
		
	}

	protected function checkLogin(){
		
	}
}