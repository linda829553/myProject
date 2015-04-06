<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
require("class_database.php");
require("all_func.php");
require("header.php");

?>

	<div data-role="page">
		<div data-role="header">
			<h1>移动办公-养生协会</h1>
		</div>
		<div data-role="content">
			<div>
				<ul data-role="listview">
				    <li>Acura</li>
				    <li>Audi</li>
				    <li>BMW</li>
				    <li>Cadillac</li>
				    <li>Ferrari</li>
				</ul>

			</div>

		</div>
		<div data-role="footer">
			<div data-role='controlgroup' data-type='horizontal'>
				<a href='exit.php' data-role='button' data-ajax='false'>退出</a>
				<a href='queryUnit.php' target='_blank' data-role='button' data-ajax='false'>单位转换</a>
				<a href='index.php?action=help' data-role='button' data-ajax='false'>帮助</a>
				<a href='index.php?action=lianxi' data-role='button' data-ajax='false'>联系我们</a>
			</div>
		</div>	
	</div>
	
</body>
</html>