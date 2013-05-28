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
            <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['parentid'] == 0): ?><li id="d<?php echo ($i); ?>"><a class="tabon" target="mcMenuFrame" href="/index.php/?g=<?php echo ($vo["app"]); ?>&m=<?php echo ($vo["control"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<li class="navright"></li>
		</ul>
	</div>
</div>
</body>
</html>