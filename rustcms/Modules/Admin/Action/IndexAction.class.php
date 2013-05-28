<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends AdminAction {
	public function __initialize(){
		parent::__initialize();		
	}
    public function index(){
        $this->display();
    }
    public function topmenu(){
    	$menu=F("Menu");
    	if(!$menu)
    	$menu=D("Menu")->create_cache();
    	$this->assign("menu",$menu);
    	$this->display("Public:topmenu");
    }
    public function menu(){
    	$this->display("Public:menu");
    }
    public function main(){
    	$this->display("Public:main");
    }
}