<?php
// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
    public function index(){
        $this->display('Public:login');
    }
    public function verify(){
    	import("ORG.Util.Image");
    	Image::buildImageVerify();
    }
    
    public function checkLogin(){
    	//验证码
    	if(!$this->checkVerify()) $this->error("验证码不正确",__URL__);
    	
    	import("ORG.Util.RBAC");
    	$map=array();
    	$map['username']=$_POST['username'];
    	$map['status']=array('gt',0);
    	$authInfo=RBAC::authenticate($map);
    	if(false==$authInfo){
    		$this->error("帐号不存在",__URL__);
    	}else{
    		if($authInfo['password']!=md5($_POST['password'])){
    		   $this->error('密码不正确',__URL__);	
    		}
    		$_SESSION[C("USER_AUTH_KEY")]=$authInfo['id'];
    		if($authInfo['username']=='admin'){
    		  $_SESSION[C("ADMIN_AUTH_KEY")]=true;	
    		}
    		RBAC::saveAccessList();
    		$this->success('登录成功',__GROUP__.'/Index');
    	}
    }
    public function checkVerify(){
    	if(!empty($_POST['seccode'])&&!empty($_SESSION['verify'])&&($_SESSION['verify']==md5($_POST['seccode']))){
    		return true;
    	}
    	return false;
    }
}