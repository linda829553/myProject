<!--PublicMessageDetail.php:��ʾ������Ϣ��ϸ��Ϣ---------------->
<?php
	//����������Ϣ����˵��͹�����Ϣ��
	require_once("PublicMessageClass.php");
	include("PublicMessageManager.php");
	
	//���ù�����Ϣ���ShowDetail������ʾ��ϸ��Ϣ
	$bcl=new PublicMessage();	
	$bcl->ShowDetail($_GET["pubmsgid"]);
?>