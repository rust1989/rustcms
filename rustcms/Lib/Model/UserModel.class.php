<?php
class UserModel extends CommonModel{
	public  function __construct(){
		parent::__construct();
	}
	protected $_validate =array(
	        array('name','require','名称必须！'),
			array('password','require','密码必须'),
			array('conpwd','password','确认密码不正确',1,'confirm')
	);
    public function getRoleList(){
   	    $list=D("Role")->role_list();
   	    return $list;
    }
    public function getUserList(){
    	$list=F("User");
    	if(!$list){
    		$list=D("User")->join("think_role_user on think_user.id=think_role_user.user_id")->field("think_role_user.role_id,think_user.id,think_user.username,think_user.status")->select();
    		F("User",$list);
    	}
    	return $list;
    }
}