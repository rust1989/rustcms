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
       <li><a href="__URL__/role" >角色管理</a></li>
       <li><a href="__URL__/rolecontrol" class="active">添加角色</a></li>
     </ul>
  </div>
  <form id="myform" method="post" action="__URL__/saverole">
     <h3 class="title">基本属性</h3>
     <div class="infotable">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th width="80">角色名称</th>
            <td><input type="text" id="name" name="name" class="input" value="<?php echo ($list['name']); ?>"><span class="error"></span></td>
          </tr>
             <th>角色描述</th>
             <td>
               <textarea name="remark"><?php echo ($list['remark']); ?></textarea>
             </td>
          </tr>
          <tr>
            <th width="80">是否启用</th>
            <td><input type="radio"  value="1"  checked="checked"  name="status">启用&nbsp;&nbsp;<input type="radio"  value="0"  name="status" />禁止</td>
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