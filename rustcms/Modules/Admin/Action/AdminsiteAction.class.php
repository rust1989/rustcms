<?php
// 本类由系统自动生成，仅供测试用途
class AdminsiteAction extends AdminAction {
	public function __initialize(){
		parent::__initialize();		
	}
    public function index(){
    	$menu=D('Common')->getChild();
    	$default=D('Common')->getFirstChild();
    	$this->assign('default',$default);
    	$this->assign('menu',$menu);
        $this->display("Public:menu");
    }

}