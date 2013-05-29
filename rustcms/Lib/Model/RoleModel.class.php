<?php
class RoleModel extends CommonModel{
	public  function __construct(){
		parent::__construct();
	}
	protected $_validate =array(
	        array('name','require','名称必须！')
	);
   //前置方法 有更新，编辑时册除内存
   public function _before_write($data){
   	  parent::_before_write($data);
   	  F("Role",null);
   }
  //后置方法 册除时删除内存
  public function _after_delete($data, $options){
  	 parent::_after_delete($data, $options);
  	 $this->_before_write($data);
  }
	public function role_list(){
		if(!F('Role'))  
		$this->create_cache();
		return F('Role');
	}
	public function create_cache(){
		$db=M("Role");
		$list=$db->select();
		foreach($list as $key=>$vo){
			$list[$key]['status']=$this->chang_status($vo['status']);
		}
		F('Role',$list);
	}
	/**
	 * 
	 */
	public  function  chang_status($display=1){
		switch($display){
			case 1:
				$name='启用';
				break;
			case 0:
				$name='禁止';
				break;
		}
		return $name;
	}
	/**
	 * 检查子级层数
	 */
	public function check_level(){
		$pid=$_POST['parentid'];
		$list=$this->menu_list();
		$arr=array();
		foreach($list as $vo){
			if($vo['id']==$pid)
				$arr=$vo;
		}
		$level=$arr['level'];
		if($level<C('MENU_LIMIT_LEVEL')) return true;
		return false;
	}
	/**
	 * 获取子级层数
	 */
	public function get_level(){
		$pid=$_POST['parentid'];
		if($pid==0) return 1;
		$list=$this->menu_list();
		$arr=array();
		foreach($list as $vo){
			if($vo['id']==$pid)
				$arr=$vo;
		}
		$level=(int)$arr['level']+1;
		return $level;
	}
	
	/**
	 * 获取父级ID
	 */
	public function get_parentid($id){
		if(empty($id)) return false;
		$list=$this->menu_list();
		$arr=array();
		foreach($list as $vo){
			if($vo['id']==$id)
				$arr=$vo;
		}
		
		return $arr['id'];
	}
	/**
	 * 根据id查找栏目详细
	 */
	public function getInfoById($id=''){
		if(empty($id)) return false;
		$where=array();
		$where['id']=(int)$id;
		$list=$this->where($where)->find();
		return $list;
	}
}