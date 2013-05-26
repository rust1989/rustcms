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
       <li><a href="__URL__/add" class="active">添加栏目</a></li>
     </ul>
  </div>
  <form id="myform" method="post" action="__URL__/save">
     <h3 class="title">菜单属性</h3>
     <div class="infotable">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <th width="80">上一级</th>
            <td><select name="parentid" class="input">
              <option value="0">作为一级菜单</option>
             </select>
             </td>
          </tr>
          <tr>
            <th width="80">名称</th>
            <td><input type="text" id="name" name="name" class="input"><span class="error"></span></td>
          </tr>
          <tr>
            <th width="80">项目</th>
            <td><input type="text" id="m" name="m" class="input"><span class="error"></span></td>
          </tr>
          <tr>
            <th width="80">模块</th>
            <td><input type="text" id="c" name="c" class="input"><span class="error"></span></td>
          </tr>
           <tr>
            <th width="80">方法</th>
            <td><input type="text" id="a" name="a" class="input"><span class="error"></span></td>
          </tr>
          <tr>
             <th>备注</th>
             <td>
               <textarea name="description"></textarea>
             </td>
          </tr>
          <tr>
            <th width="80">类型</th>
            <td>
            <select name="pstatus" class="input">
               <option value="1">---权限认证菜单---</option>
                <option value="0">---仅作为菜单---</option>
            </select>
            <span class="error"></span></td>
          </tr>
          <tr>
            <th width="80">状态</th>
            <td>
              <select name="display" class="input">
                <option value="0">---显示---</option>
                <option value="1">---不显示---</option>
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