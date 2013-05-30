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
       <li><a href="__URL__" >后台栏目管理</a></li>
       <li><a href="__URL__/control" class="active">添加栏目</a></li>
     </ul>
  </div>
  <form id="myform" method="post" action="__URL__/save">
     <h3 class="title">菜单属性</h3>
     <div class="infotable">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th width="80">角色类型</th>
            <td><select name="pid" class="input">
              <?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>'  <?php if($vo['id'] == $pid): ?>selected='selected'<?php endif; ?>><?php echo ($vo["title"]); ?></option>
                  <?php if(is_array($vo['items'])): $i = 0; $__LIST__ = $vo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($jo["id"]); ?>' <?php if($jo['id'] == $pid): ?>selected='selected'<?php endif; ?>>|-<?php echo ($jo["title"]); ?></option>
                     <?php if(is_array($jo['items'])): $i = 0; $__LIST__ = $jo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ko): $mod = ($i % 2 );++$i;?><option value='<?php echo ($ko["id"]); ?>' <?php if($ko['id'] == $pid): ?>selected='selected'<?php endif; ?>>|&nbsp;&nbsp;|-<?php echo ($ko["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
             </select>
             </td>
          </tr>
          <tr>
            <th width="80">用户名</th>
            <td><input type="text" id="title" name="title" class="input" value="<?php echo ($list['name']); ?>"><span class="error"></span></td>
          </tr>
          <tr>
            <th width="80">密码</th>
            <td><input type="text" id="app" name="app" class="input" value="<?php echo ($list['app']); ?>"><span class="error"></span></td>
          </tr>
          <tr>
            <th width="80">确认密码</th>
            <td><input type="text" id="control" name="control" class="input" value="<?php echo ($list['control']); ?>"><span class="error"></span></td>
          </tr>
          <tr>
            <th width="80">状态</th>
            <td>
              <select name="display" class="input">
                <option value="1">---开启---</option>
                <option value="0">---禁止---</option>
              </select>
            </td>
          </tr>
        </table>
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