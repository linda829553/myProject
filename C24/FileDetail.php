<!--FileDetail.php:��ʾ������ϸ��Ϣ---------------->
<?php
	require_once("FileClass.php");
	include("FileManager.php");
	
	$bcl=new File();	
	$bcl->ShowDetail($_GET["fileid"]);
?>