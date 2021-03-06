<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
require("class_database.php");
require("all_func.php");
require("header.php");


?>

	<div data-role="page" id="page1">
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
				$mark_S = $_SESSION["mark"];
				// print $username_S .  ",您好！";
				$action=$_REQUEST["action"];
				if ($mark_S == 1){
						/* department 部门管理*/
					if ($action == "department"){
						show_departments();
					} else if ($action == "add_department") {
						show_one_department(-1);		
					} else if ($action == "show_details") {
						show_one_department($_REQUEST['id']);
					} else if ($action == "upsert") {
						if ($_REQUEST['id'] == -1) {
							add_department($_REQUEST['department']);
						} else {
							update_department($_REQUEST['id'], $_REQUEST['department']);
						}
						show_departments();
					} else if ($action == "delete_department") {
						kill_department($_REQUEST['id']);
						show_departments();
						/* end 部门管理*/
						/* 用户管理 */
					} else if ($action == "user_manage"){
						show_users();
					} else if ($action == "add_user") {
						show_one_user(-1);		
					} else if ($action == "show_one_user") {
						show_one_user($_REQUEST['id']);
					} else if ($action == "upsert_user") {
						if ($_REQUEST['id'] == -1) {
							add_user($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['department_id'], 
								$_REQUEST['position'], $_REQUEST['sex'], $_REQUEST['mobile'], $_REQUEST['remark']);
						} else {
							update_user($_REQUEST['id'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['department_id'], 
								$_REQUEST['position'], $_REQUEST['sex'], $_REQUEST['mobile'], $_REQUEST['remark']);
						}
						show_users();
					} else if ($action == "delete_user") {
						if (!is_manager($_REQUEST['id'])) {
							kill_user($_REQUEST['id']);							
						}
						show_users();
						/* 用户管理 end */
						/* 信息管理 begin */
					} else if ($action == "msg_manage"){
						show_messages();
					} else if ($action == "add_msg") {
						show_one_msg(-1);		
					} else if ($action == "show_one_msg") {
						show_one_msg($_REQUEST['id']);
					} else if ($action == "upsert_msg") {
							// print("<pre>");
							// print_r($_POST);
							// print("</pre>");
							// print($_REQUEST['content'].'22222222222');
							// exit;
						if ($_REQUEST['id'] == -1) {
							// print($_REQUEST['content'].'@@@@@@@@@@@');
							// exit;
							/* 	id	content	post_time	depart_id	user_id	parent_id */
							add_msg($_REQUEST['content'], $_REQUEST['department_id'], $_REQUEST['user_id']);
						} else {
							update_msg($_REQUEST['id'], $_REQUEST['content'], $_REQUEST['department_id'], $_REQUEST['user_id']);
						}
						show_messages();
					} else if ($action == "delete_msg") {
						kill_msg($_REQUEST['id']);
						show_messages();
						/* 信息管理 end */
					} else {

						show_menu($username_S);
					}
				} else {
					/*************************普通用户模块********************************************/
					if ($action == "show_one_user_msg"){
						show_one_user_msg($_REQUEST['id']);
						
					}else{
						show_user_msg($username_S);
					}
				}



			?>
			
		</div>
		<div data-role="footer">
			<div data-role='controlgroup' data-type='horizontal'>
				<a href='exit.php' data-role='button' data-ajax='false'>退出</a>
			</div>
		</div>	
	</div>
	
</body>
</html>