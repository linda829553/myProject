<?php			
	session_start();

	//�����û����Delete����ɾ���û���Ϣ	
	require_once("UserClass.php");
	$user=new User();	
	$user->Delete($_SESSION["ss_user_id"]);
	
	//ע��Session����
	session_unregister("ss_user_id");
		
	//ҳ���ض�λ
	echo "<script language='javascript'>";
	echo " alert('ע���ɹ�');";
	echo " location='Login.php';";
	echo "</script>";
?>