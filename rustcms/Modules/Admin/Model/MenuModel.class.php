<?php
class MenuModel extends Model{
	protected $_validate =array(
	        array('name','require','名称必须！'),
			array('m','require','项目必须!'),
			array('c','require','模块必须!'),
			array('a','require','方法必须!')	
	);
}