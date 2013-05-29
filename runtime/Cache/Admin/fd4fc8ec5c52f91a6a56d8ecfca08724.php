<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>完美一刻后台管理系统</title>
<link rel="stylesheet" type="text/css" href="__CSS__/Admin/main.css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="__JS__/jquery.adubytree.js"></script>
<link rel="stylesheet" type="text/css" href="__CSS__/adubytree.css" />
<script type="text/javascript">
jQuery(document).ready(function(){ 

var jsondata ={id : "node-0" , data: "C:",
		children: [
			{ id : "node-1" ,data: "node1",
				children: [
					{ id : "node-1-1" ,data: "node1.1",
						children: [
						{ id : "node-1-1-1" ,data: "node1.1.1"},
						{ id : "node-1-1-2" ,data: "node1.1.2"}
						]},
					{id : "node-1-2" , data: "node1.2"},
					{id : "node-1-3" ,data: "node1.3"}
				] 
			},
			{id : "node-2" ,data: "node2"},
			{id : "node-3", data: "node3",
				children: [
					{ id : "node-3-1" ,data: "node3.1",
					children: [
						{id : "node-3-1-1" , data: "node3.1.1",
							children: [
								{ id : "node-3-1-1-1" , data: "node3.1.1-1"},
								{ id : "node-3-1-1-2" , data: "node3.1.1-2"}
							] 
						}
					] 
					}
				] 
			}
		] 
	};
	
	$("#infotable").AdubyTree({
		data:jsondata,
		dataType:"json",
		checkboxes:true
		});

		
	function getopenid(node){
		alert(node.id);
	}
});

</script>
</head>

<body>
<div class="wrap">
  <div class="topNav">
  </div>
  <form id="myform" method="post" action="__URL__/save">
     <h3 class="title">权限列表</h3>
     <div id="infotable">
    </div>
    <div class="btnwrap">
       <div class="btn">
         <input type="hidden" id="id" name="id" value="<?php echo ($list['id']); ?>" />
         <input type="submit" name="submit" class="submit" value="" />
       </div>
    </div>
  </form>
</div>

</body>
</html>