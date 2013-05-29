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
		$pid=isset($_GET['pid'])?$_GET['pid']:'';
		if(!empty($id)){
        $list=$db->getInfoById($id);
		$this->assign('list',$list);
		}
		$this->assign('pid',$pid);
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
			$data['sort']=$listorder;
			$where=array();
			$where['id']=$listorder;
			$query=$db->where($where)->save($data);
			}
			if($query)$this->success('',__URL__);
			else $this->error('',__URL__);
		}
		
	}
    public function menu(){
    	$db=D("Menu");
    	$menu=$db->menu_tree();
    	$this->assign('menu',$menu);
        $this->display('Public:menu');
    }
   public function listorder(){
   	    $db=D('Common');
   	    $db->listorder();
   }
}