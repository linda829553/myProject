<!--UserEmployeeClass.php:Ա���û���--------------------------------->
<?php

include_once("UserClass.php");

class UserEmployee extends User
{ 	
	
/********************************************* 
������	Report
���ܣ�	�ϱ�����
���������
			$pFileId=��Ҫ�ϱ��Ĺ���ID
***********************************************/ 
function Report($pFileId)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Update File set ";
	$db->SqlString=$db->SqlString."StatusId=2";
	$db->SqlString=$db->SqlString." where FileId=$pFileId ";
	
	//������pFileId��״̬��Ϊ�����ϱ���
	$db->ExecuteSql();
	$db->__destruct();	
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserReportFile]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
	
}

}
?>