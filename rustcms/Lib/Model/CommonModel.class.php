<?php
class CommonModel extends Model{
	
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
	 * 排序
	 */
	public function listorder(){
		static  $_listorder=array();
		
		$str=isset($_POST['str'])?$_POST['str']:'';
		$model=MODULE_NAME;
		if(empty($str)||empty($model)) die('false');
		$ids=explode(',', $str);
		foreach($ids as $id){
			$arr=explode('_',$id);
			if(count($arr)!=2) die('false');
			$where=array();
			$where['id']=$arr[0];
			if(isset($list_order[$model.$arr[0].$arr[1]])) continue;
			$list_order[$model.$arr[0].$arr[1]]=true;
			$data=array();
			$data['listorder']=$arr[1];
			$db=M("$model");
			$query=$db->where($where)->save($data);
		}
		die('true');
	}
	/**
	 * 根据模块名查找子栏目
	 */
	public function getChild(){
		$model=MODULE_NAME;
		$pid='';
		$menu=F("Menu");
		if(!$menu)
		$menu=D("Menu")->create_cache();
		foreach($menu as $vo){
			if($vo['control']==$model)
			$pid=$vo['id'];
		}
		$list=D("Menu")->menu_tree($pid);
		return $list;
	}
	/**
	 * 根据模块名查找首个默认子栏目
	 */
	public function getFirstChild(){
		$model=MODULE_NAME;
		$pid='';
		$menu=F("Menu");
		if(!$menu)
			$menu=D("Menu")->create_cache();
		foreach($menu as $vo){
			if($vo['control']==$model)
				$pid=$vo['id'];
		}
		$list=D("Menu")->menu_tree($pid);
		$default=$list[0]['items'][0];
		return $default;
	}
}