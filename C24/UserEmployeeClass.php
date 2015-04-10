<!--UserEmployeeClass.php:员工用户类--------------------------------->
<?php

include_once("UserClass.php");

class UserEmployee extends User
{ 	
	
/********************************************* 
函数：	Report
功能：	上报公文
输入参数：
			$pFileId=所要上报的公文ID
***********************************************/ 
function Report($pFileId)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Update File set ";
	$db->SqlString=$db->SqlString."StatusId=2";
	$db->SqlString=$db->SqlString." where FileId=$pFileId ";
	
	//将公文pFileId的状态变为“已上报”
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserReportFile]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
	
}

}
?>