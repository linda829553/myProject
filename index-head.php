<?php

require("header.php");

?>

	<div data-role="page" id="page1">
		<div data-role="header">
			  <a href="#" data-rel="back" data-icon="back">返回</a>
			  <h1>主页</h1>
			  <a href="#" data-role="button">首页</a>
		</div>
		<div data-role="content">
			
			<?php
				require("aaa.php");
			?>
		</div>

	</div>
	
</body>
</html>