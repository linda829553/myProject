<!--UserClass.php:用户类--------------------------------->
<?php

class User
{ 	
	var $mBasicInforArray;			//用户基本信息数组
	var $mPrivilegeInfoArray;		//用户权限信息数组	
	
/********************************************* 
函数：	InitData
功能：	
			获取一个用户的基本信息，放入数组mBasicInfomationArray中
			获取一个用户的权限信息，放入数组mPrivilegeInfoArray中
输入参数：			
			$pUserId=所要获取信息的用户ID
***********************************************/ 
function InitDataByUserId($pUserId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//获取基本信息
	$db->SqlString="Select * from User where UserId=$pUserId";
	$db->Query();	
	$this->mBasicInforArray=$db->mResultArray;
	
	//获取权限信息
	$db->SqlString="Select Privilege.*,Role.* from User,Role,Privilege";
	$db->SqlString=$db->SqlString." where UserId=$pUserId ";
	$db->SqlString=$db->SqlString."and Role.RoleId=User.RoleId ";
	$db->SqlString=$db->SqlString."and Privilege.PrivilegeId=Role.PrivilegeId";
	$db->Query();	
	$this->mPrivilegeInfoArray=$db->mResultArray;
	
	$db->__destruct();	
}

/********************************************* 
函数：	InitDataByUserName
功能：	
			获取一个用户的基本信息，放入数组mBasicInfomationArray中
			获取一个用户的权限信息，放入数组mPrivilegeInfoArray中
输入参数：			
			$pLoginName=所要获取信息的用户LoginName
			$pPassword=所要获取信息的用户口令
***********************************************/ 
function InitDataByUserName($pLoginName,$pPassword)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//获取基本信息
	$db->SqlString="Select * from User where LoginName='$pLoginName' and Password='$pPassword'";
	$db->Query();	
	$this->mBasicInforArray=$db->mResultArray;
	
	//获取权限信息
	$db->SqlString="Select Privilege.*,Role.* from User,Role,Privilege";
	$db->SqlString=$db->SqlString." where LoginName='$pLoginName' and Password='$pPassword' ";
	$db->SqlString=$db->SqlString."and Role.RoleId=User.RoleId ";
	$db->SqlString=$db->SqlString."and Privilege.PrivilegeId=Role.PrivilegeId";
	$db->Query();	
	$this->mPrivilegeInfoArray=$db->mResultArray;
	
	$db->__destruct();	
}
	
/********************************************* 
函数：	Add
功能：	增加一个新用户	
输入参数：
			$pUserInfoArray=新用户信息数组		
***********************************************/ 
function Add($pUserInfoArray)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="insert into User ";
		
	
	$db->SqlString=$db->SqlString."(LoginName,Password,RealName,Department,Email,RoleId) ";
	$db->SqlString=$db->SqlString." values (";
	$db->SqlString=$db->SqlString."'".$pUserInfoArray["LoginName"]."',";
	$db->SqlString=$db->SqlString."'".$pUserInfoArray["Password"]."',";
	$db->SqlString=$db->SqlString."'".$pUserInfoArray["RealName"]."',";
	$db->SqlString=$db->SqlString."'".$pUserInfoArray["Department"]."',";
	$db->SqlString=$db->SqlString."'".$pUserInfoArray["Email"]."',";
	$db->SqlString=$db->SqlString.$pUserInfoArray["RoleId"];
	$db->SqlString=$db->SqlString.") ";
	
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserAdd]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	Update
功能：	修改一个用户的信息
输入参数：
			$pUserId=所要修改的用户ID
			$pUserInfoArray=所要修改的信息数组
***********************************************/ 
function Update($pUserId,$pUserInfoArray)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Update User set ";
	$db->SqlString=$db->SqlString."LoginName='".$pUserInfoArray["LoginName"]."',";
	$db->SqlString=$db->SqlString."Password='".$pUserInfoArray["Password"]."',";
	$db->SqlString=$db->SqlString."RealName='".$pUserInfoArray["RealName"]."',";
	$db->SqlString=$db->SqlString."Department='".$pUserInfoArray["Department"]."',";
	$db->SqlString=$db->SqlString."Email='".$pUserInfoArray["Email"]."',";
	$db->SqlString=$db->SqlString."RoleId=".$pUserInfoArray["RoleId"];
	$db->SqlString=$db->SqlString." where UserId=$pUserId ";
		
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserUpdate]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	Delete
功能：	删除一个用户	
输入参数：			
			$pUserId=所要删除的用户ID
***********************************************/ 
function Delete($pUserId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Delete from User where UserId=$pUserId";
	$db->ExecuteSql();
	$db->__destruct();	

	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserDelete]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	IsValid
功能：	判断用户是否合法	
输入参数：			
			$pLoginName=所要判定用户的用户名
			$pPassword=所要判定用户的口令
			&$rUserId=如果用户合法，返回用户ID
返回值：
			合法用户：	1
			非法用户：	0
***********************************************/ 
function IsValid($pLoginName,$pPassword,&$rUserId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Select * from User where LoginName='$pLoginName' and Password='$pPassword' ";
	$db->Query();	
	
	if (isset($db->mResultArray))
	{
		$rUserId=$db->mResultArray[0]->UserId;
		return 1;
		$db->__destruct();	
	}
	else 
	{
		return 0;
		$db->__destruct();	
	}	
}

}
?>