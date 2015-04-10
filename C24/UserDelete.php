<?php			
	session_start();

	//利用用户类的Delete方法删除用户信息	
	require_once("UserClass.php");
	$user=new User();	
	$user->Delete($_SESSION["ss_user_id"]);
	
	//注销Session变量
	session_unregister("ss_user_id");
		
	//页面重定位
	echo "<script language='javascript'>";
	echo " alert('注销成功');";
	echo " location='Login.php';";
	echo "</script>";
?>