<!--CategoryClass.php:公文状态类--------------------------------->
<?php

class Category
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

	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//获取基本信息
	$db->SqlString="Select * from Category";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	//断开数据库
	$db->__destruct();	
}

}