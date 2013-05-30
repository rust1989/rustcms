<?php
class MenuModel extends CommonModel{
	public  function __construct(){
		parent::__construct();
	}
	protected $_validate =array(
	        array('name','require','名称必须！'),
			array('app','require','项目必须!'),
			array('control','require','模块必须并且唯一!',1),
			array('action','require','方法必须!')	
	);
	protected $_auto = array (
        array('app','ucfirst',3,'function'),
		array('control','ucfirst',3,'function')
	);
	public function menu_list(){
		if(!F('Menu')) 
	   $this->create_cache();
		return F('Menu');
	}
	public function create_cache(){
		$db=M("Menu");
		$list=$db->select();
		F('Menu',$list);
	}
	/**
	 * 获取子菜单
	 */
	public function get_child($parentid=0){
		$db=M('Menu');
		$parentid=(int)$parentid;
		$result=$db->where(array('pid'=>$parentid))->select();
		
		return $result;
	}
	/**
	 * 栏目树
	 */
	public function menu_tree($parentid,$level='1',$key='0'){
		$data=$this->get_child($parentid);
		$level++;
		foreach ($data as $vo){
			$id=$vo['id'];
			$vo['display']=$this->chang_status($vo['display']);
			$tree[$key]=$vo;
			$child=$this->menu_tree($id,$level);
			if($level<=C('MENU_LIMIT_LEVEL')){
				$tree[$key]['items']=$child;
			}
			$key++;
		}
		return $tree;
	}
	/**
	 * 栏目树
	 */
	public function menu_json($parentid,$level='1',$key='0'){
		$data=$this->get_child($parentid);
		$level++;
		foreach ($data as $vo){
			$id=$vo['id'];
			$jo['id']=$vo['level']."-".$vo['id'].'-'.$vo['control'];
			$jo['data']=$vo['title'];
			$tree[$key]=$jo;
			$child=$this->menu_json($id,$level);
			if($level<=C('MENU_LIMIT_LEVEL')){
				$tree[$key]['children']=$child;
			}
			$key++;
		}
		return $tree;
	}
	/**
	 * 
	 */
	public  function  chang_status($display=1){
		switch($display){
			case 1:
				$name='显示';
				break;
			case 0:
				$name='不显示';
				break;
		}
		return $name;
	}
	/**
	 * 检查子级层数
	 */
	public function check_level(){
		$pid=$_POST['pid'];
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
		$pid=$_POST['pid'];
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
		$db=M(MODULE_NAME);
		$where=array();
		$where['id']=(int)$id;
		$list=$db->where($where)->find();
		return $list;
	}
}