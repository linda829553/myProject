<!--UserManagerClass.php:管理者用户类--------------------------------->
<?php

//包含User类
include_once("UserClass.php");

class UserManager extends User
{ 	
	
/********************************************* 
函数：	Approve
功能：	审批公文
输入参数：
			$pFileId=所要审批的公文ID
***********************************************/ 
function Approve($pFileId)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Update File set ";
	$db->SqlString=$db->SqlString."StatusId=3";
	$db->SqlString=$db->SqlString." where FileId=$pFileId ";
	
	//修改公文状态为”已审批“	
	$db->ExecuteSql();
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserApproveFile]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
	
	//断开数据库
	$db->__destruct();	
}

}
?>