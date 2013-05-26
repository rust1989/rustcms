<?php
// 本类由系统自动生成，仅供测试用途
class MenuAction extends AdminAction {
	public function __initialize(){
		parent::__initialize();		
	}
	public function index(){
		$this->_menu();
		$this->display();
	}
	public function _menu(){
		$db=M('Menu');
		$list=$db->select();
		$this->assign('menu',$list);
	}
	public function control(){
		$this->_menu();
		if(isset($_GET['pid']))
		$this->assign('pid',$_GET['pid']);
		if($_GET['id']){
		$db=M('Menu');
		$where=array();
		$where['id']=$_GET['id'];
		$list=$db->where($where)->find();
		$this->assign('list',$list);
		}
		$this->display();
	}
	public function save(){
		$db=D('Menu');
		
		if(!$db->create()){
			$this->error($db->getError(),__URL__.'/control');
		}else{
			if(!empty($_POST['id'])){
			$query=$db->save();	
		    }else{
			$listorder=$db->add();
			$data=array();
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