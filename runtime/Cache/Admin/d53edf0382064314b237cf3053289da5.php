<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>完美一刻后台管理</title>
<link href="__CSS__/Admin/menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base target="mcMainFrame" />
</head>
<script language="javascript">
<!--
function $(objectId) 
{
	 return document.getElementById(objectId);
}

function showHide(objname)
{
    var obj = $(objname);
    if(obj.style.display == "none")
    {
        obj.style.display = "block";
    }
    else
    {
        obj.style.display = "none";
    }
    
    return false;
}

function refreshMainFrame(url)
{
    parent.mcMainFrame.location = url;
	
}
-->
</script>
<base target="mcMainFrame">
<body>
<div class="menu">
<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
          <dt><a href="" onclick="return showHide('items0');" target="_self"><?php echo ($vo["name"]); ?></a></dt>
           <dd id="items0" style="display:block;">
            <ul>
                <?php if(is_array($vo['items'])): $i = 0; $__LIST__ = $vo['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jo): $mod = ($i % 2 );++$i;?><li><a href='/index.php/?g=<?php echo ($jo["app"]); ?>&m=<?php echo ($jo["control"]); ?>&a=<?php echo ($jo["action"]); ?>'><?php echo ($jo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
      </dl>
       <script type="text/javascript">refreshMainFrame('/index.php/?g=<?php echo ($default["app"]); ?>&m=<?php echo ($default["control"]); ?>&a=<?php echo ($default["action"]); ?>');</script><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</body>
</html>