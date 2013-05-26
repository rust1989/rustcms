<?php
class MenuModel extends Model{
	protected $_validate =array(
	        array('name','require','名称必须！'),
			array('module','require','项目必须!'),
			array('control','require','模块必须!'),
			array('action','require','方法必须!')	
	);
	
	public function create_cache(){
		
	}
}