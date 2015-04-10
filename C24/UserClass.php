<!--UserClass.php:�û���--------------------------------->
<?php

class User
{ 	
	var $mBasicInforArray;			//�û�������Ϣ����
	var $mPrivilegeInfoArray;		//�û�Ȩ����Ϣ����	
	
/********************************************* 
������	InitData
���ܣ�	
			��ȡһ���û��Ļ�����Ϣ����������mBasicInfomationArray��
			��ȡһ���û���Ȩ����Ϣ����������mPrivilegeInfoArray��
���������			
			$pUserId=��Ҫ��ȡ��Ϣ���û�ID
***********************************************/ 
function InitDataByUserId($pUserId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//��ȡ������Ϣ
	$db->SqlString="Select * from User where UserId=$pUserId";
	$db->Query();	
	$this->mBasicInforArray=$db->mResultArray;
	
	//��ȡȨ����Ϣ
	$db->SqlString="Select Privilege.*,Role.* from User,Role,Privilege";
	$db->SqlString=$db->SqlString." where UserId=$pUserId ";
	$db->SqlString=$db->SqlString."and Role.RoleId=User.RoleId ";
	$db->SqlString=$db->SqlString."and Privilege.PrivilegeId=Role.PrivilegeId";
	$db->Query();	
	$this->mPrivilegeInfoArray=$db->mResultArray;
	
	$db->__destruct();	
}

/********************************************* 
������	InitDataByUserName
���ܣ�	
			��ȡһ���û��Ļ�����Ϣ����������mBasicInfomationArray��
			��ȡһ���û���Ȩ����Ϣ����������mPrivilegeInfoArray��
���������			
			$pLoginName=��Ҫ��ȡ��Ϣ���û�LoginName
			$pPassword=��Ҫ��ȡ��Ϣ���û�����
***********************************************/ 
function InitDataByUserName($pLoginName,$pPassword)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//��ȡ������Ϣ
	$db->SqlString="Select * from User where LoginName='$pLoginName' and Password='$pPassword'";
	$db->Query();	
	$this->mBasicInforArray=$db->mResultArray;
	
	//��ȡȨ����Ϣ
	$db->SqlString="Select Privilege.*,Role.* from User,Role,Privilege";
	$db->SqlString=$db->SqlString." where LoginName='$pLoginName' and Password='$pPassword' ";
	$db->SqlString=$db->SqlString."and Role.RoleId=User.RoleId ";
	$db->SqlString=$db->SqlString."and Privilege.PrivilegeId=Role.PrivilegeId";
	$db->Query();	
	$this->mPrivilegeInfoArray=$db->mResultArray;
	
	$db->__destruct();	
}
	
/********************************************* 
������	Add
���ܣ�	����һ�����û�	
���������
			$pUserInfoArray=���û���Ϣ����		
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
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserAdd]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	Update
���ܣ�	�޸�һ���û�����Ϣ
���������
			$pUserId=��Ҫ�޸ĵ��û�ID
			$pUserInfoArray=��Ҫ�޸ĵ���Ϣ����
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
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserUpdate]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	Delete
���ܣ�	ɾ��һ���û�	
���������			
			$pUserId=��Ҫɾ�����û�ID
***********************************************/ 
function Delete($pUserId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Delete from User where UserId=$pUserId";
	$db->ExecuteSql();
	$db->__destruct();	

	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[UserDelete]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	IsValid
���ܣ�	�ж��û��Ƿ�Ϸ�	
���������			
			$pLoginName=��Ҫ�ж��û����û���
			$pPassword=��Ҫ�ж��û��Ŀ���
			&$rUserId=����û��Ϸ��������û�ID
����ֵ��
			�Ϸ��û���	1
			�Ƿ��û���	0
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