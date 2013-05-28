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
       <li><a href="__URL__" class="active">后台栏目管理</a></li>
       <li><a href="__URL__/control">添加栏目</a></li>
     </ul>
  </div>
     <div class="header">
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th width="80">排序</th>
            <th width="80">ID</th>
            <td>名称</td>
            <th width="80">状态</th>
            <th width="200">管理操作</th>
          </tr>
        </table>
     </div>
     <form id="myform">
     <div class="mainlist">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <th width="80"><input type="text" value="<?php echo ($vo["listorder"]); ?>" name="listorder_<?php echo ($vo["id"]); ?>" class="input sid"></th>
            <th width="80"><?php echo ($vo["id"]); ?></th>
            <td><?php echo ($vo["name"]); ?></td>
            <th width="80"><?php echo ($vo["display"]); ?></th>
            <th width="200"><a href="__URL__/control/pid/<?php echo ($vo["id"]); ?>">添加子菜单</a>|<a href="__URL__/control/id/<?php echo ($vo["id"]); ?>">修改</a>|<a href="">删除</a></th>
          </tr>
              <?php if(is_array($vo['items'])): $i = 0; $__LIST__ = $vo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jo): $mod = ($i % 2 );++$i;?><tr>
		            <th width="80"><input type="text" value="<?php echo ($jo["listorder"]); ?>" name="listorder_<?php echo ($jo["id"]); ?>"  class="input sid"></th>
		            <th width="80"><?php echo ($jo["id"]); ?></th>
		            <td>|—<?php echo ($jo["name"]); ?></td>
		            <th width="80"><?php echo ($jo["display"]); ?></th>
		            <th width="200"><a href="__URL__/control/pid/<?php echo ($jo["id"]); ?>">添加子菜单</a>|<a href="__URL__/control/id/<?php echo ($jo["id"]); ?>">修改</a>|<a href="">删除</a></th>
		          </tr>
		             <?php if(is_array($jo['items'])): $i = 0; $__LIST__ = $jo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ko): $mod = ($i % 2 );++$i;?><tr>
		            <th width="80"><input type="text" value="<?php echo ($ko["listorder"]); ?>" class="input sid" name="listorder_<?php echo ($ko["id"]); ?>" ></th>
		            <th width="80"><?php echo ($ko["id"]); ?></th>
	            <td>|&nbsp;&nbsp;|—<?php echo ($ko["name"]); ?></td>
		            <th width="80"><?php echo ($ko["display"]); ?></th>
		            <th width="200"><a href="__URL__/control/pid/<?php echo ($ko["id"]); ?>">添加子菜单</a>|<a href="__URL__/control/id/<?php echo ($ko["id"]); ?>">修改</a>|<a href="">删除</a></th>
		          </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
     <div class="btnwrap">
       <div class="btn">
         <input type="hidden" id="id" name="id" value="<?php echo ($list['id']); ?>" />
         <input type="submit" id="submit" name="submit" class="sequence" value="" />
         <span class="error"></span>
       </div>
    </div>
    </form>
</div>
<script type="text/javascript" src="__JS__/jquery.js"></script>
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
</body>
</html>