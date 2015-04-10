<!--FileClass.php:公文类------------------------------->
<?php

class File{	
	
var $mInforArray;		//公文信息数组
	
/********************************************* 
函数：	Add
功能：	增加一个新公文	
输入参数：
			$pFileInfoArray=新公文信息数组		
***********************************************/ 
function Add($pFileInfoArray)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="insert into File ";
		
	
	$db->SqlString=$db->SqlString."(FromUserId,CreateTime,ToUserName,Title,KeyWords,Content,StatusId,CategoryId) ";
	$db->SqlString=$db->SqlString." values (";
	$db->SqlString=$db->SqlString.$pFileInfoArray["FromUserId"].",";
	$db->SqlString=$db->SqlString."'".$pFileInfoArray["CreateTime"]."',";
	$db->SqlString=$db->SqlString."'".$pFileInfoArray["ToUserName"]."',";
	$db->SqlString=$db->SqlString."'".$pFileInfoArray["Title"]."',";
	$db->SqlString=$db->SqlString."'".$pFileInfoArray["KeyWords"]."',";
	$db->SqlString=$db->SqlString."'".$pFileInfoArray["Content"]."',";
	$db->SqlString=$db->SqlString.$pFileInfoArray["StatusId"].",";
	$db->SqlString=$db->SqlString.$pFileInfoArray["CategoryId"];
	$db->SqlString=$db->SqlString.") ";
	
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[FileAdd]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	Update
功能：	修改一个公文的信息
输入参数：
			$pFileId=所要修改的公文ID
			$pFileInfoArray=所要修改的信息数组
***********************************************/ 
function Update($pFileId,$pFileInfoArray)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	$db->SqlString="Update File set ";
	$db->SqlString=$db->SqlString."ToUserName='".$pFileInfoArray["ToUserName"]."',";
	$db->SqlString=$db->SqlString."Title='".$pFileInfoArray["Title"]."',";
	$db->SqlString=$db->SqlString."KeyWords='".$pFileInfoArray["KeyWords"]."',";
	$db->SqlString=$db->SqlString."Content='".$pFileInfoArray["Content"]."',";
	$db->SqlString=$db->SqlString."StatusId=".$pFileInfoArray["StatusId"].",";
	$db->SqlString=$db->SqlString."CategoryId=".$pFileInfoArray["CategoryId"];
	$db->SqlString=$db->SqlString." where FileId=$pFileId ";
	
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[FileUpdate]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	Delete
功能：	删除一个公文	
输入参数：			
			$pFileId=所要删除的公文ID
***********************************************/ 
function Delete($pFileId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Delete from File where FileId=$pFileId";
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[FileDelete]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}
	
/********************************************* 
构造函数：ShowByCategory
功能：		根据类别分页显示公文信息
输入参数：			
		$pCategoryId：公文类别号	
***********************************************/ 
function ShowByCategory($pCategoryId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");
	require_once("myDataGridClass.php");

	//实例化DataBase类
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="select * from Category where CategoryId=$pCategoryId";
	$db->Query();
	echo "&nbsp;&nbsp;&nbsp;【类别】".$db->mResultArray[0]->CategoryName;
	
	//实例化myDataGridClass类
	$view=new myDataGridClass($PAGE_MAX_LINE);	 
	$temp="select Status.StatusDesc,Category.*,File.* ";
	$temp=$temp." from File,Status,Category where File.CategoryId=$pCategoryId";
	$temp=$temp." and File.CategoryId=Category.CategoryId";
	$temp=$temp." and File.StatusId=Status.StatusId";
	$view->__set("sql",$temp);	
	$view->read_data();
	
	//如果数据为空，则返回
	if($view->current_records==0) 
	{
		echo "<tr><td colbegin_record=4> </td></tr>"; 
		return;
	}		 

	//数据不为空，显示数据
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr bgcolor='green'>"; 	
	echo "<td>标题</td>"; 
	echo "<td>撰写时间</td>"; 
	echo "<td>To</td>"; 
	echo "<td>关键字</td>";
	echo "<td>状态</td>";	
	echo "<td>类别</td>";	
	echo "</tr>"; 
	for($i=0;$i<$view->current_records;$i++)
	{ 
		if(ceil($i/2)*2==$i) 
			$bgc="white"; 
		else 
			$bgc="yellow"; 
		
		echo "<tr bgcolor=$bgc><td>"; 
		echo "<a href=FileDetail.php?fileid=".$view->result[$i]["FileId"].">".$view->result[$i]["Title"]."</a>"; 		
		echo "</td><td>"; 
		echo $view->result[$i]["CreateTime"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["ToUserName"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["KeyWords"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["StatusDesc"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["CategoryName"]; 
		echo "</td><td>"; 
		echo "<a href=FileUpdate.php?fileid=".$view->result[$i]["FileId"].">修改</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileDelete.php?fileid=".$view->result[$i]["FileId"].">删除</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileReport.php?fileid=".$view->result[$i]["FileId"].">上报</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileApprove.php?fileid=".$view->result[$i]["FileId"].">审批</a>"; 				
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//分页显示导航
	$view->navigate();	
	//关闭数据库
	$db->__destruct();	
}

/********************************************* 
构造函数：ShowByKeyWords
功能：		根据关键字分页显示公文信息
输入参数：			
		$pKeyWords：关键字
***********************************************/ 
function ShowByKeyWords($pKeyWords)
{
	require("sys_conf.inc");
	require_once("DataBase.php");
	require_once("myDataGridClass.php");

	//实例化DataBase类
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	echo "【关键字】".$pKeyWords;
	
	//实例化myDataGridClass类
	$view=new myDataGridClass($PAGE_MAX_LINE);	 
	$temp="select Status.StatusDesc,Category.CategoryName,File.* ";
	$temp=$temp." from File,Status,Category where File.KeyWords like '%$pKeyWords%'";
	$temp=$temp." and File.CategoryId=Category.CategoryId";
	$temp=$temp." and File.StatusId=Status.StatusId";
	$view->__set("sql",$temp);	
	$view->read_data();
	
	//如果数据为空，则返回
	if($view->current_records==0) 
	{
		echo "<tr><td colbegin_record=4> </td></tr>"; 
		return;
	}		 
	
	//如果数据为空，则返回
	if($view->current_records==0) 
	{
		echo "<tr><td colbegin_record=4> </td></tr>"; 
		return;
	}		 

	//数据不为空，显示数据
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr bgcolor='green'>"; 	
	echo "<td>标题</td>"; 
	echo "<td>撰写时间</td>"; 
	echo "<td>To</td>"; 
	echo "<td>关键字</td>";
	echo "<td>状态</td>";	
	echo "<td>类别</td>";	
	echo "</tr>"; 
	for($i=0;$i<$view->current_records;$i++)
	{ 
		if(ceil($i/2)*2==$i) 
			$bgc="white"; 
		else 
			$bgc="yellow"; 
		
		echo "<tr bgcolor=$bgc><td>"; 
		echo "<a href=FileDetail.php?fileid=".$view->result[$i]["FileId"].">".$view->result[$i]["Title"]."</a>"; 		
		echo "</td><td>"; 
		echo $view->result[$i]["CreateTime"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["ToUserName"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["KeyWords"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["StatusDesc"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["CategoryName"]; 
		echo "</td><td>"; 
		echo "<a href=FileUpdate.php?fileid=".$view->result[$i]["FileId"].">修改</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileDelete.php?fileid=".$view->result[$i]["FileId"].">删除</a>"; 				
		echo "</td><td>"; 
		echo "<a href=FileReport.php?fileid=".$view->result[$i]["FileId"].">上报</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileApprove.php?fileid=".$view->result[$i]["FileId"].">审批</a>"; 				
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//分页显示导航
	$view->navigate();	
	//关闭数据库
	$db->__destruct();	
}

//显示公文详细信息
function ShowDetail($pFileId)
{ 
	require("sys_conf.inc");
	require_once("DataBase.php");	

	//实例化DataBase类
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="select Content from File where FileId=$pFileId";
	$db->Query();
	
	//获取详细信息	
	$content=$db->mResultArray[0]->Content; 
	
	//显示详细信息，使用<table>
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr><td width=10%>"; 
	echo "公文内容：";
	echo "</td>";
	echo "<td>"; 
	echo $content;
	echo "</td></tr>";
	echo "</table>";	 
} 

/********************************************* 
函数：	InitData
功能：	
			获取一个公文的基本信息，放入数组mInforArray中
输入参数：			
			$pFileId=所要获取信息的公文ID
***********************************************/ 
function InitDataByFileId($pFileId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//获取基本信息
	$db->SqlString="Select * from File where FileId=$pFileId";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	$db->__destruct();	
}

}
?>