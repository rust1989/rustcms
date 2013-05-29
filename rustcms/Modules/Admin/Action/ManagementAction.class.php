<?php
// 本类由系统自动生成，仅供测试用途
class ManagementAction extends AdminAction {
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
    public function role(){
    	$list=D("Role")->role_list();
    	$this->assign('list',$list);
    	$this->display();
    }
    public function rolecontrol(){
    	$id=isset($_GET['id'])?$_GET['id']:'';
    	if(!empty($id)){
    		$list=D('Role')->getInfoById($id);
    		$this->assign('list',$list);
    	}
    	$this->display();
    }
    public function adminaccess(){
    	$db=D("Menu");
    	$menu=$db->menu_tree();
    	$this->assign("menu",$menu);
    	$this->display();
    }
    public function saverole(){
    	$db=D('Role');
    	if(!$db->create()){
    		$this->error($db->getError(),__URL__.'/rolecontrol');
    	}else{
    		if(!empty($_POST['id'])){
    			$query=$db->save();
    		}else{
    			$query=$db->add();
    		}
    		if($query)$this->success('',__URL__.'/role');
    		else $this->error('',__URL__.'/role');
    	}
    }
    public function roledel(){
    	$db=D('Role');
    	$id=isset($_POST['id'])?$_POST['id']:'';
    	if(empty($id)) die('false');
    	$where=array();
    	$where['id']=$id;
    	$query=$db->where($where)->delete();
    	if($query) die('true');
    	else die('false');
    }
}