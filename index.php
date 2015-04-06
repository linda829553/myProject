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
			<?php
					// echo "loginSuccess: ".$_SESSION["loginSuccess"];				// 测试
				if(!isset($_SESSION["loginSuccess"])){
					// echo "loginSuccess: ".$_SESSION["loginSuccess"];				// 测试
					echo "<script>location='login.php';</script>";
				}
				$username_S = $_SESSION["username"];
				// print $username_S .  ",您好！";
				$action=$_REQUEST["action"];
				if ($action == "show_userlist") {
					show_userlist();
				} else {
					show_menu($username_S);
				}

			?>
			
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