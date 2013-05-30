<?php
class ManagementModel extends CommonModel{
	public  function __construct(){
		parent::__construct();
	}
	
	public function access_list(){
		if(!F('Access')) 
	   $this->create_cache();
		return F('Access');
	}
	public function create_cache(){
		$db=M("Access");
		$list=$db->select();
		F('Access',$list);
	}
	/**
	 * 前置方法
	 */
	public function _before_write($data){
		parent::_before_write($data);
		F("Access",null);
	}
	/**
	 * 后置方法
	 */
	public function  _after_delete($data, $options){
		parent::_after_delete($data, $options);
		F("Access",null);
	}
	public function getAccessListById($id){
		if(empty($id)) return false;
		$access=$this->access_list();
		$list=array();
		$i=0;
		foreach($access as $key=>$vo){
			if($vo['role_id']==$id){
				$list[$i]=$vo;
				$i++;
			}
		}
		return $list;
	}
   /**
    * 保存权限
    */	
	public function saveAccess(){
		$str=isset($_GET['str'])?$_GET['str']:'';
		$db=M("Access");
		if(empty($str)) $this->error('',__URL__."/adminaccess");
		$query=$db->where(array('role_id'=>$_POST['role_id']))->delete();
		F("Access",null);
		$ids=explode(',', $str);
		foreach($ids as $id){
			$arr=explode('-',$id);
			
			$data=array();
			$data['role_id']=(int)$_POST['role_id'];
			$data['node_id']=(int)$arr[1];
			$data['level']=(int)$arr[0];
			$data['module']=$arr[2];
			$query=$db->data($data)->add();
		}
		return $query;
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