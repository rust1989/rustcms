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
       <li><a href="javascript:void(0);" class="active">管理员管理</a></li>
       <li><a href="javascript:void(0);">添加管理员</a></li>
     </ul>
  </div>
  <form id="myform">
     <h3 class="title">基本属性</h3>
     <div class="infotable">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th width="80">用户名</th>
            <td><input type="text" id="username" name="username" class="input"><span class="error">请输入用户名</span></td>
          </tr>
          <tr>
            <th width="80">密码</th>
            <td><input type="text" id="password" name="password" class="input"><span class="error">请输入密码</span></td>
          </tr>
          <tr>
            <th width="80">确认密码</th>
            <td><input type="text" id="conpassword" name="conpassword" class="input"><span class="error">请输入确认密码</span></td>
          </tr>
          <tr>
            <th width="80">邮箱</th>
            <td><input type="text" id="email" name="email" class="input"><span class="error">请输入邮箱</span></td>
          </tr>
          <tr>
            <th width="80">角色类型</th>
            <td>
            <select name="roleid" class="input">
              <option value="0">--选择角色类型--</option>
            </select>
            <span class="error">请输入邮箱</span></td>
          </tr>
          <tr>
            <th width="80">状态</th>
            <td>
              <select name="status" class="input">
                <option value="0">---开启---</option>
                <option value="1">---禁止---</option>
              </select>
            </td>
          </tr>
        </table>
    </div>
    <div class="btnwrap">
       <div class="btn">
         <input type="submit" name="submit" class="submit" value="" />
       </div>
    </div>
  </form>
</div>
</body>
</html>