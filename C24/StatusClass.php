<!--StatusClass.php:����״̬��--------------------------------->
<?php

class Status
{ 	
	var $mInforArray;			//״̬������Ϣ����
	
/********************************************* 
������	InitData
���ܣ�	
			��ȡ����״̬�Ļ�����Ϣ����������mInforArray��
���������			
***********************************************/ 
function InitData()
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//��ȡ������Ϣ
	$db->SqlString="Select * from Status";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	$db->__destruct();	
}

}