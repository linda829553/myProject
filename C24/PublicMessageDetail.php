<!--PublicMessageDetail.php:显示公共信息详细信息---------------->
<?php
	//包含公共信息管理菜单和公共信息类
	require_once("PublicMessageClass.php");
	include("PublicMessageManager.php");
	
	//利用公共信息类的ShowDetail方法显示详细信息
	$bcl=new PublicMessage();	
	$bcl->ShowDetail($_GET["pubmsgid"]);
?>