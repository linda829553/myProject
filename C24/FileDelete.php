<?php			
	session_start();

	//����File��	
	require_once("FileClass.php");
	$file=new File();	
	
	//����File��Delete����ɾ����ǰ����
	$file->Delete($_GET["fileid"]);
		
	//ҳ���ض���
	echo "<script language='javascript'>";
	echo " alert('ɾ���ɹ�');";
	echo " location='FileKeyWordsQueryView.php';";
	echo "</script>";
?>