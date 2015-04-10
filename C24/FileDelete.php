<?php			
	session_start();

	//包含File类	
	require_once("FileClass.php");
	$file=new File();	
	
	//利用File的Delete方法删除当前公文
	$file->Delete($_GET["fileid"]);
		
	//页面重定向
	echo "<script language='javascript'>";
	echo " alert('删除成功');";
	echo " location='FileKeyWordsQueryView.php';";
	echo "</script>";
?>