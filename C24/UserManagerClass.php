<!--UserManagerClass.php:�������û���--------------------------------->
<?php

//����User��
include_once("UserClass.php");

class UserManager extends User
{ 	
	
/********************************************* 
������	Approve
���ܣ�	��������
���������
			$pFileId=��Ҫ�����Ĺ���ID
***********************************************/ 
function Approve($pFileId)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Update File set ";
	$db->SqlString=$db->SqlString."StatusId=3";
	$db->SqlString=$db->SqlString." where FileId=$pFileId ";
	
	//�޸Ĺ���״̬Ϊ����������	
	$db->ExecuteSql();
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserApproveFile]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
	
	//�Ͽ����ݿ�
	$db->__destruct();	
}

}
?>