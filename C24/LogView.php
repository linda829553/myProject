<?php
	session_start(); 										//װ��Session�⣬һ��Ҫ�������� 
	session_unregister("create_time");
	include("LogManager.php");
	
	//���ղ�ѯ������Ϣ��������$key_words�����û�У����ѯ������Ϣ
	if(isset($_POST["btnSearch"]))
	{
		$create_time=$_POST["txtCreateTime"];
	}
	else
	{
		$create_time=date("y-m-d");
	}
	
	//��ȡ��ע���ҳ��ʾ����Ҫ�ĵ�ǰҳ��ʼ��¼���Session����
	if(isset($_GET["begin_record"]))
		$g_begin_record=$_GET["begin_record"]; 
	else
		$g_begin_record=0; 
	session_register("g_begin_record");		//ע���ҳ��ʾ��g_begin_record����,ע��û��$����
?>

<div align=right>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method=post>
	<input type="text" name="txtCreateTime" value=<?php echo $create_time?>>
	<input type="submit" name="btnSearch" value="��ѯ">
</from>
</div>

<?php

	//����Log���ShowByCreateTime��ʾ����ѯ����־
	require_once("LogClass.php");
	$log=new Log();
	$log->ShowByCreateTime($create_time);
?>