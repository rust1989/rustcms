<?php
// 本类由系统自动生成，仅供测试用途
class AdminmanageAction extends AdminAction {
	public function __initialize(){
		parent::__initialize();		
	}
    public function index(){
    	$db=D("User");
    	$list=$db->getUserList();
    	$this->assign('list',$list);
        $this->display();
    }
    public function control(){
    	$id=isset($_GET['id'])?$_GET['id']:'';
    	$db=D("User");
    	if(!empty($id)){
    		$list=$db->getInfoById($id);
    		
    		$this->assign('list',$list);
    	}
    	$rlist=$db->getRoleList();
    	$this->assign('rlist',$rlist);
    	$this->display();
    }

    public function save(){
    	$db=D("User");
    	if(!$db->create()){
    		$this->error($db->getError(),__URL__.'/control');
    	}else{
    		
    		if(!empty($_POST['id'])){
    		  $db->save();
    		  $data=array();
    		  $where=array();
    		  $where['user_id']=$id;
    		  $data['role_id']=$_POST['role_id'];
    		  $query=D("Role_user")->where($where)->save($data);
    		}else{
    		  $id=$db->add();
    		  $data=array();
    		  $data['user_id']=$id;
    		  $data['role_id']=$_POST['role_id'];
    		  $query=D("Role_user")->data($data)->add();
    		}
    		
    	}
    	if($query) $this->success('',__URL__);
    	else $this->error('',__URL__);
    }
    public function role(){
    	$list=D("Role")->role_list();
    	$this->assign('list',$list);
    	$this->display();
    }
    public function rolecontrol(){
    	$id=isset($_GET['id'])?$_GET['id']:'';
    	if(!empty($id)){
    		$list=D('Role')->getInfoById($id);
    		
    		$this->assign('list',$list);
    	}
    	$this->display();
    }
    public function adminaccess(){
    	$id=isset($_GET['id'])?$_GET['id']:'';
    	if(empty($id)) $this->error('',__URL__);
    	$list=D("Management")->getAccessListById($id);
    	$this->assign('list',$list);
    	$db=D("Menu");
    	$menu=$db->menu_json();
    	$menu=trim(json_encode($menu),'[]');
    	$this->assign("menu",$menu);
    	$this->assign('role_id',$id);
    	$this->display();
    }
    public function saveadminaccess(){
    	$query=D("Management")->saveAccess();
    	if($query)$this->success('',__URL__."/role");
    	else $this->error('',__URL__."/adminaccess");
    }
    public function saverole(){
    	$db=D('Role');
    	if(!$db->create()){
    		$this->error($db->getError(),__URL__.'/rolecontrol');
    	}else{
    		if(!empty($_POST['id'])){
    			$query=$db->save();
    		}else{
    			$query=$db->add();
    		}
    		if($query)$this->success('',__URL__.'/role');
    		else $this->error('',__URL__.'/role');
    	}
    }
    public function roledel(){
    	$db=D('Role');
    	$id=isset($_POST['id'])?$_POST['id']:'';
    	if(empty($id)) die('false');
    	$where=array();
    	$where['id']=$id;
    	$query=$db->where($where)->delete();
    	$query=M("Access")->where(array('role_id'=>$id))->delete();
    	if($query) die('true');
    	else die('false');
    }
    public function deluser(){
    	$db=D('User');
    	$id=isset($_POST['id'])?$_POST['id']:'';
    	if(empty($id)) die('false');
    	$where=array();
    	$where['id']=$id;
    	$query=$db->where($where)->delete();
    	$query=M("Role_user")->where(array('user_id'=>$id))->delete();
    	if($query) die('true');
    	else die('false');
    }
}