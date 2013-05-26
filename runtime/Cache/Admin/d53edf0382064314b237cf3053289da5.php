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

<?php switch($action): case "Setting": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">系统管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
				<li><a href='__GROUP__/Menu'>后台菜单设置</a></li> 
				<li><a href='__GROUP__/Censor/'>词语过滤</a></li> 
				<li><a href='__GROUP__/Config/'>站点配置</a></li> 
            </ul>
        </dd>
    </dl>
     <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">管理员管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
				<li><a href='__GROUP__/Management/role'>管理员角色</a></li> 
                <li><a href='__GROUP__/Management'>管理员管理</a></li> 
            </ul>
        </dd>
    </dl>
    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">日志管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
				<li><a href='__GROUP__/Logs/loginlog'>后台登陆日志</a></li> 
                <li><a href='__GROUP__/Logs'>后台操作日志</a></li> 
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Setting/');</script><?php break;?>

<?php case "Index": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">单页管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
             <li><a href='__GROUP__/Banner/index'>首页banner管理</a></li> 
             <li><a href='__GROUP__/Class/index'>首页课程时间管理</a></li> 
             <li><a href='__GROUP__/Enjoy/index'>首页作品欣赏管理</a></li> 
             <li><a href='__GROUP__/Movie/index'>首页完美视线管理</a></li> 
             <li><a href='__GROUP__/Download/index'>首页下载管理</a></li> 
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Banner/index');</script><?php break;?> 
<?php default: ?>

    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">快捷方式</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
				<?php if(($security['allowsystem']) == "1"): ?><li><a href='__APP__/Settings'>系统配置</a></li><?php endif; ?> 
				<?php if(($security['allowmember']) == "1"): ?><li><a href='__APP__/Member'>用户管理</a></li><?php endif; ?>
                <?php if(($security['allowgroup']) == "1"): ?><li style="display:none;"><a href='__APP__/Usergroup'>用户组管理</a></li><?php endif; ?>
            </ul>
        </dd>
    </dl> 
	<!--<script type="text/javascript">refreshMainFrame('__APP__/Index/main');</script>--><?php endswitch;?>



</div>
</body>
</html>