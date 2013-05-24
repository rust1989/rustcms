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
				<li><a href='__GROUP__/Setting/'>系统设置管理</a></li> 
                <li><a href='__GROUP__/User/'>管理员管理</a></li> 
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Setting/');</script><?php break;?>
<?php case "News": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">新闻分类管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <li><a href='__GROUP__/News/newssort'>新闻分类管理</a></li> 
            </ul>
        </dd>
    </dl>
    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">新闻管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <?php if(is_array($newssort)): $i = 0; $__LIST__ = $newssort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href='__GROUP__/News/index/pid/<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/News');</script><?php break;?>


<?php case "Video": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">视频分类管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
               <li><a href='__GROUP__/Video/videosort'>视频分类管理</a></li> 
            </ul>
        </dd>
    </dl>

    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">视频管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <?php if(is_array($videosort)): $i = 0; $__LIST__ = $videosort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href='__GROUP__/Video/index/pid/<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Video');</script><?php break;?>


<?php case "Photo": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">作品分类管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
                <li><a href='__GROUP__/Photo/photosort'>作品分类管理</a></li> 
            </ul>
        </dd>
    </dl>
    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">作品展示管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <?php if(is_array($photosort)): $i = 0; $__LIST__ = $photosort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href='__GROUP__/Photo/index/pid/<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Photo');</script><?php break;?>
<?php case "Images": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">图集列表管理</a></dt>
        <dd id="items0" style="display:block;">
          <ul>
          <li><a href='__GROUP__/Images/imagessort'>图片列表分类管理</a></li> 
          </ul>
        </dd>
    </dl>
    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">图集列表管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <?php if(is_array($imagessort)): $i = 0; $__LIST__ = $imagessort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href='__GROUP__/Images/index/pid/<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Images');</script><?php break;?>
<?php case "Assistant": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">助手管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <li><a href='__GROUP__/Assistant'>助手管理</a></li> 
            
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Assistant');</script><?php break;?>

<?php case "Page": ?><dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">单页管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
           <li><a href='__GROUP__/Page/pagesort'>单页分类管理</a></li> 
              </ul>
        </dd>
    </dl>
    <dl>
        <dt><a href="" onclick="return showHide('items0');" target="_self">单页管理</a></dt>
        <dd id="items0" style="display:block;">
            <ul>
              <?php if(is_array($pagesort)): $i = 0; $__LIST__ = $pagesort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href='__GROUP__/Page/index/id/<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
    </dl>
<script type="text/javascript">refreshMainFrame('__GROUP__/Page');</script><?php break;?>
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