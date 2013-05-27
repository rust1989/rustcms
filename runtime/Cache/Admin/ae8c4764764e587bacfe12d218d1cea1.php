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
     <div class="mainlist">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <th width="80"><input type="text" value="<?php echo ($vo["listorder"]); ?>" class="input sid"></th>
            <th width="80"><?php echo ($vo["id"]); ?></th>
            <td><?php echo ($vo["name"]); ?></td>
            <th width="80"><?php echo ($vo["display"]); ?></th>
            <th width="200"><a href="__URL__/control/pid/<?php echo ($vo["id"]); ?>">添加子菜单</a>|<a href="__URL__/control/id/<?php echo ($vo["id"]); ?>">修改</a>|<a href="">删除</a></th>
          </tr>
              <?php if(is_array($vo['items'])): $i = 0; $__LIST__ = $vo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jo): $mod = ($i % 2 );++$i;?><tr>
		            <th width="80"><input type="text" value="<?php echo ($jo["listorder"]); ?>" class="input sid"></th>
		            <th width="80"><?php echo ($jo["id"]); ?></th>
		            <td>|—<?php echo ($jo["name"]); ?></td>
		            <th width="80"><?php echo ($jo["display"]); ?></th>
		            <th width="200"><a href="__URL__/control/pid/<?php echo ($jo["id"]); ?>">添加子菜单</a>|<a href="__URL__/control/id/<?php echo ($jo["id"]); ?>">修改</a>|<a href="">删除</a></th>
		          </tr>
		             <?php if(is_array($jo['items'])): $i = 0; $__LIST__ = $jo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ko): $mod = ($i % 2 );++$i;?><tr>
		            <th width="80"><input type="text" value="<?php echo ($ko["listorder"]); ?>" class="input sid"></th>
		            <th width="80"><?php echo ($ko["id"]); ?></th>
	            <td>|&nbsp;&nbsp;|—<?php echo ($ko["name"]); ?></td>
		            <th width="80"><?php echo ($ko["display"]); ?></th>
		            <th width="200"><a href="__URL__/control/pid/<?php echo ($ko["id"]); ?>">添加子菜单</a>|<a href="__URL__/control/id/<?php echo ($ko["id"]); ?>">修改</a>|<a href="">删除</a></th>
		          </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
</div>
</body>
</html>