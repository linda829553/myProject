<?php
	
	include("FileManager.php");			//�������Ĺ���˵�
	include("UserManagerClass.php");//�����������û���
	
	//����UserManager��Approve������������
	$mag=new UserManager();	
	$mag->Approve($_GET["fileid"]);
		
	//ҳ���ض�λ
	echo "<script language='javascript'>";
	echo " alert('�������ĳɹ�');";
	echo " location='FileManager.php';";
	echo "</script>";
	
?>