<?php
// 本类由系统自动生成，仅供测试用途
class MenuAction extends AdminAction {
	public function __initialize(){
		parent::__initialize();		
	}
	public function index(){
		$db=D("Menu");
		$menu=$db->menu_tree();
		$this->assign('menu',$menu);
		$this->display();
	}
	
	public function control(){
		$db=D('Menu');
		$id=isset($_GET['id'])?$_GET['id']:'';
		$pid=$db->get_parentid($id);
		
		$this->assign('pid',$pid);
		if($id){
		$where=array();
		$where['id']=$_GET['id'];
		$list=$db->where($where)->find();
		$this->assign('list',$list);
		}
		$menu=$db->menu_tree();
		$this->assign('menu',$menu);
		$this->display();
	}
	public function save(){
		$db=D('Menu');
		$data=array();
		$data['level']=$db->get_level();
		if(!$db->check_level()) $this->error("菜单子级层数超过".C('MENU_LIMIT_LEVEL'),__URL__);
		
		if(!$db->create()){
			$this->error($db->getError(),__URL__.'/control');
		}else{
			if(!empty($_POST['id'])){
			$query=$db->save();	
		    }else{
			$listorder=$db->add();
			
			$data['listorder']=$listorder;
			$where=array();
			$where['id']=$listorder;
			$query=$db->where($where)->save($data);
			}
			if($query)$this->success('',__URL__);
			else $this->error('',__URL__);
		}
		
	}
    public function menu(){
    	$action=isset($_GET['action'])?$_GET['action']:'';
    	$this->assign('action',$action);
        $this->display('Public:menu');
    }
   
}