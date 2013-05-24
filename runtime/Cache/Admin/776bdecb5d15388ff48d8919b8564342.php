<?php if (!defined('THINK_PATH')) exit();?>
	<div id="append"></div><div class="container">
	<h3>服务器环境</h3>
	<ul class="memlist fixwidth">
		<li><em>操作系统及PHP:</em><?php echo ($serverinfo); ?></li>
		<li><em>上传许可:</em><?php echo ($fileupload); ?></li>
		<li><em>Magic_quote_gpc:</em><?php echo ($magic_quote_gpc); ?></li>
	</ul>
	
</div>

</body>
</html>