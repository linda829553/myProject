<?php
	include("FileManager.php");				//包含公文管理菜单
	include("UserEmployeeClass.php");	//包含员工用户类
	
	//使用UserEmployee类的Report()方法上报公文
	$emp=new UserEmployee();	
	$emp->Report($_GET["fileid"]);
		
	//页面重定位
	echo "<script language='javascript'>";
	echo " alert('上报公文成功');";
	echo " location='FileManager.php';";
	echo "</script>";
?>