<?php
	include("FileManager.php");				//�������Ĺ���˵�
	include("UserEmployeeClass.php");	//����Ա���û���
	
	//ʹ��UserEmployee���Report()�����ϱ�����
	$emp=new UserEmployee();	
	$emp->Report($_GET["fileid"]);
		
	//ҳ���ض�λ
	echo "<script language='javascript'>";
	echo " alert('�ϱ����ĳɹ�');";
	echo " location='FileManager.php';";
	echo "</script>";
?>