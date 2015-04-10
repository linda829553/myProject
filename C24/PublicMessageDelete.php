<?php			
	session_start();

	//包含公共信息类	
	require_once("PublicMessageClass.php");
	
	//利用公共信息类的Delete方法删除数据
	$file=new PublicMessage();	
	$file->Delete($_GET["pubmsgid"]);
		
	//页面重定向
	echo "<script language='javascript'>";
	echo " alert('删除成功');";
	echo " location='PublicMessageKeyWordsQueryView.php';";
	echo "</script>";
?>