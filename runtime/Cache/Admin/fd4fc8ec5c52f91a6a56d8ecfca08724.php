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
	$("#infotable").AdubyTree({
		data:<?php echo ($menu); ?>,
		dataType:"json",
		type:"simple",
		checkboxes:true
		});
	<?php if(count($list ) > 0): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>$("#infotable-ckbx-<?php echo ($vo["level"]); ?>-<?php echo ($vo["node_id"]); ?>-<?php echo ($vo["module"]); ?>").removeClass("checkBoxUncheck").addClass("checkBoxChecked checked");<?php endforeach; endif; else: echo "" ;endif; endif; ?>
});

</script>
</head>

<body>
<div class="wrap">
  <form id="myform" method="post">
     <h3 class="title">权限列表</h3>
     <div id="infotable">
    </div>
    <div class="btnwrap">
       <div class="btn">
         <input type="hidden" id="role_id" name="role_id" value="<?php echo ($role_id); ?>" />
         <input type="submit" name="submit" class="submit" value="" />
       </div>
    </div>
  </form>
</div>
<script type="text/javascript">
   $(document).ready(function(){
	   $("#myform").submit(function(){
		   var str=$("#infotable").getChecked();
           var action="__URL__/saveadminaccess/str/"+str;
           $(this).attr("action",action);
		   return true;
	   });
   });
</script>
</body>
</html>