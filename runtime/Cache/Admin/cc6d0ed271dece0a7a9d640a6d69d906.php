<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>完美一刻后台管理系统</title>
<link rel="stylesheet" type="text/css" href="__CSS__/Admin/main.css" />
</head>
<body>
<div class="wrap">
  <div class="topNav">
     <ul>
       <li><a href="__URL__" class="active">管理员管理</a></li>
       <li><a href="__URL__/control">添加管理员</a></li>
     </ul>
  </div>
     <div class="header">
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
           
            <th width="80">ID</th>
            <td>名称</td>
            <th width="80">状态</th>
            <th width="200">管理操作</th>
          </tr>
        </table>
     </div>
     <div class="mainlist">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            
            <th width="80"><?php echo ($vo["id"]); ?></th>
            <td><?php echo ($vo["username"]); ?></td>
            <th width="80"><?php echo ($vo["status"]); ?></th>
            <th width="200"><a href="__URL__/control/id/<?php echo ($vo["id"]); ?>">修改</a>|<a href="#"  class="del" data-id="<?php echo ($vo["id"]); ?>">删除</a></th>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style>
.no-close{padding:0em;}
.no-close .ui-dialog-titlebar {}
.no-close .ui-widget-header{border:none; background:none;}
.no-close .ui-dialog-titlebar-close{border:none; background:none;margin-top:-5px;}
.no-close .ui-button-text{font-size:10px;}
.no-close  .ui-dialog-buttonpane{border-top:none;margin-top:0px; background-color:#E6E6E6;padding:0em 1em 0em 0.4em;}
.no-close .ui-dialog-buttonpane button{margin:0em 0.4em, 0em 0em;;}
</style>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#myform").submit(function(){
        	var str='';
        	jQuery("input[name^='listorder']").each(function(){
        		var val=jQuery(this).val();
        		var id=jQuery(this).attr('name').split('_')[1];
        		var num=id+'_'+val;
        		str+=num+',';
        	});
        	str=str.substring(0,str.length-1);
        	$.ajax({
        		type:"POST",
        		url:"__URL__/listorder",
        		data:'str='+str,
        		success:function(data){
        			var obj=jQuery(".btn .error");
        			if(data=='true')
        			obj.html("排序成功");
        			else
        			obj.html("排序失败");
        			setTimeout(function(){obj.html('');},5000);
        			window.location.href="__URL__";
        		}
        	});
        	return false;
        });
    });
</script>
<script type="text/javascript">
   $(document).ready(function(){
	   addDialog();
	   drawDialog();
	   $(".del").each(function(){
		   $(this).click(function(){
			   $(this).addClass("delactive");
			   $("#dialog").dialog("option","position",{my:"center",at:"center",of:$(this)});
			   $("#dialog").dialog("open");
		   });
	   });
   });
   function addDialog(){
	   var html='<div id="dialog" title="" ><img src="__IMG__/Admin/s_warn.png">&nbsp;确定要删除？</div>';
	   $("body").append(html);
   }
   function drawDialog(){
	   $( "#dialog" ).dialog({
		      autoOpen:false,
		      dialogClass: "no-close",
		      height: 90,
		      width: 150,
		      draggable: false,
		      buttons:{
		    	  "确定":function(){
		    		  var id=$(".delactive").attr("data-id");
		    		  ajaxDel(id);
		    	  },
		    	  "取消":function(){
		    		  $(this).dialog("close");
		    	  }
		      }
		});
   }
   function ajaxDel(id){
	   $.ajax({
   		type:"POST",
   		url:"__URL__/deluser",
   		data:'id='+id,
   		success:function(data){
   			var obj=jQuery("#dialog");
   			obj.html("");
   			if(data=='true'){
   				obj.html("<img src='__IMG__/Admin/checked.gif'>删除成功");
   			}else{
   				obj.html("<img src='__IMG__/Admin/del.gif'>&nbsp;删除失败");
   			}
   			setTimeout(
   				function(){
   				$("#dialog").dialog("close");
   				window.location.href="__URL__";
   				},3000);	
   		}
   	});
   }
</script>
</body>
</html>