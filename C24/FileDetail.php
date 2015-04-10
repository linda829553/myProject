<!--FileDetail.php:显示公文详细信息---------------->
<?php
	require_once("FileClass.php");
	include("FileManager.php");
	
	$bcl=new File();	
	$bcl->ShowDetail($_GET["fileid"]);
?>