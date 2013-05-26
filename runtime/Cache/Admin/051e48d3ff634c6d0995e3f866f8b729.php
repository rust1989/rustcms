<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>完美一刻后台管理</title>
<link href="__CSS__/Admin/top.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="topnav">
	<div class="sitenav">
		<div class="welcome">你好，<span class="username"><?php echo $_SESSION['name'];?></span><a href="" target="_blank" style="display:none">THINKCMS</a> </div>
		<div class="sitelink"> 
			<a href="<?php echo C("SITE");?>" target="_blank">网站主页</a> | 
			<a href="__GROUP__/Login/loginout" target="_parent">安全退出</a>
      
		</div>
	</div>
	<div class="leftnav" style="float:left;">
		<ul>
			<li class="navleft"></li>
			<li id='d1' style="margin-left:-1px"><A href="__GROUP__/Menu/menu/action/Index" target="mcMenuFrame" class="tabon">首页管理</A></li>
            <li id='d8'><A href="__GROUP__/Menu/menu/action/Setting" target="mcMenuFrame" >系统管理</A></li>
             <li id='d9'><A href="__GROUP__/Menu/menu/action/Images" target="mcMenuFrame" >图集列表管理</A></li>
             <li id='d2'><A href="__GROUP__/Menu/menu/action/News" target="mcMenuFrame" >新闻管理</A></li>
             <li id='d3'><A href="__GROUP__/Menu/menu/action/Video" target="mcMenuFrame" >视频管理</A></li>
             <li id='d4'><A href="__GROUP__/Menu/menu/action/Photo" target="mcMenuFrame" >作品展示管理</A></li>
             <li id='d5'><A href="__GROUP__/Menu/menu/action/Assistant" target="mcMenuFrame" >助手管理</A></li>
             <li id='d6'><A href="__GROUP__/Menu/menu/action/Page" target="mcMenuFrame" >单页管理</A></li>
            
			<li class="navright"></li>
		</ul>
	</div>
</div>
</body>
</html>