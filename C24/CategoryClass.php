<!--CategoryClass.php:����״̬��--------------------------------->
<?php

class Category
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

	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//��ȡ������Ϣ
	$db->SqlString="Select * from Category";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	//�Ͽ����ݿ�
	$db->__destruct();	
}

}