<!--RoleClass.php:状态类--------------------------------->
<?php

class Role
{ 	
	var $mInforArray;			//状态基本信息数组
	
/********************************************* 
函数：	InitData
功能：	
			获取公文状态的基本信息，放入数组mInforArray中
输入参数：			
***********************************************/ 
function InitData()
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//获取基本信息
	$db->SqlString="Select * from Role";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	$db->__destruct();	
}

}