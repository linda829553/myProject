<?php			
	session_start();

	//����������Ϣ��	
	require_once("PublicMessageClass.php");
	
	//���ù�����Ϣ���Delete����ɾ������
	$file=new PublicMessage();	
	$file->Delete($_GET["pubmsgid"]);
		
	//ҳ���ض���
	echo "<script language='javascript'>";
	echo " alert('ɾ���ɹ�');";
	echo " location='PublicMessageKeyWordsQueryView.php';";
	echo "</script>";
?>