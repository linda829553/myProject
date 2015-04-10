<?php
	
	include("FileManager.php");			//包含公文管理菜单
	include("UserManagerClass.php");//包含管理者用户类
	
	//利用UserManager的Approve方法审批公文
	$mag=new UserManager();	
	$mag->Approve($_GET["fileid"]);
		
	//页面重定位
	echo "<script language='javascript'>";
	echo " alert('审批公文成功');";
	echo " location='FileManager.php';";
	echo "</script>";
	
?>