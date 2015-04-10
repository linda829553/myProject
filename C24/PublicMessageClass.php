<!--PublicMessageClass.php:公共信息类------------------------------->
<?php

class PublicMessage{	
	
var $mInforArray;		//公共信息信息数组
	
/********************************************* 
函数：	Add
功能：	增加一个新公共信息	
输入参数：
			$pPublicMessageInfoArray=新公共信息数组		
***********************************************/ 
function Add($pPublicMessageInfoArray)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="insert into PublicMessage ";
		
	//构造Insert语句
	$db->SqlString=$db->SqlString."(FromUserId,CreateTime,Title,KeyWords,Content,CategoryId) ";
	$db->SqlString=$db->SqlString." values (";
	$db->SqlString=$db->SqlString.$pPublicMessageInfoArray["FromUserId"].",";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["CreateTime"]."',";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["Title"]."',";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["KeyWords"]."',";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["Content"]."',";
	$db->SqlString=$db->SqlString.$pPublicMessageInfoArray["CategoryId"];
	$db->SqlString=$db->SqlString.") ";
	
	//执行SQL
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[PublicMessageAdd]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	Update
功能：	修改一个公共信息的信息
输入参数：
			$pPublicMessageId=所要修改的公共信息ID
			$pPublicMessageInfoArray=所要修改的信息数组
***********************************************/ 
function Update($pPublicMessageId,$pPublicMessageInfoArray)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//构造Update语句
	$db->SqlString="Update PublicMessage set ";
	$db->SqlString=$db->SqlString."Title='".$pPublicMessageInfoArray["Title"]."',";
	$db->SqlString=$db->SqlString."KeyWords='".$pPublicMessageInfoArray["KeyWords"]."',";
	$db->SqlString=$db->SqlString."Content='".$pPublicMessageInfoArray["Content"]."',";
	$db->SqlString=$db->SqlString."CategoryId=".$pPublicMessageInfoArray["CategoryId"];
	$db->SqlString=$db->SqlString." where PublicMessageId=$pPublicMessageId ";
	
	//执行SQL
	$db->ExecuteSql();
	$db->__destruct();	
	
	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[PublicMessageUpdate]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
函数：	Delete
功能：	删除一个公共信息	
输入参数：			
			$pPublicMessageId=所要删除的公共信息ID
***********************************************/ 
function Delete($pPublicMessageId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//构造Delete语句
	$db->SqlString="Delete from PublicMessage where PublicMessageId=$pPublicMessageId";
	
	//执行SQL
	$db->ExecuteSql();	
	$db->__destruct();	

	//添加日志
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[PublicMessageDelete]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}
	
/********************************************* 
构造函数：ShowByCategory
功能：		根据类别分页显示公共信息信息
输入参数：			
		$pCategoryId：公共信息类别号	
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
	$temp="select Category.*,PublicMessage.* ";
	$temp=$temp." from PublicMessage,Category where PublicMessage.CategoryId=$pCategoryId";
	$temp=$temp." and PublicMessage.CategoryId=Category.CategoryId";
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
	echo "<td>关键字</td>";
	echo "<td>类别</td>";	
	echo "</tr>"; 
	for($i=0;$i<$view->current_records;$i++)
	{ 
		if(ceil($i/2)*2==$i) 
			$bgc="white"; 
		else 
			$bgc="yellow"; 
		
		echo "<tr bgcolor=$bgc><td>"; 
		echo "<a href=PublicMessageDetail.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">".$view->result[$i]["Title"]."</a>"; 		
		echo "</td><td>"; 
		echo $view->result[$i]["CreateTime"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["KeyWords"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["CategoryName"]; 
		echo "</td><td>"; 
		echo "<a href=PublicMessageUpdate.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">修改</a>"; 		
		echo "</td><td>"; 
		echo "<a href=PublicMessageDelete.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">删除</a>"; 				
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
功能：		根据关键字分页显示公共信息信息
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
	$temp="select Category.CategoryName,PublicMessage.* ";
	$temp=$temp." from PublicMessage,Category where PublicMessage.KeyWords like '%$pKeyWords%'";
	$temp=$temp." and PublicMessage.CategoryId=Category.CategoryId";
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
	echo "<td>关键字</td>";
	echo "<td>类别</td>";	
	echo "</tr>"; 
	for($i=0;$i<$view->current_records;$i++)
	{ 
		if(ceil($i/2)*2==$i) 
			$bgc="white"; 
		else 
			$bgc="yellow"; 
		
		echo "<tr bgcolor=$bgc><td>"; 
		echo "<a href=PublicMessageDetail.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">".$view->result[$i]["Title"]."</a>"; 		
		echo "</td><td>"; 
		echo $view->result[$i]["CreateTime"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["KeyWords"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["CategoryName"]; 
		echo "</td><td>"; 
		echo "<a href=PublicMessageUpdate.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">修改</a>"; 		
		echo "</td><td>"; 
		echo "<a href=PublicMessageDelete.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">删除</a>"; 				
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//分页显示导航
	$view->navigate();	
	//关闭数据库
	$db->__destruct();	
}

//显示公共信息详细信息
function ShowDetail($pPublicMessageId)
{ 
	require("sys_conf.inc");
	require_once("DataBase.php");	

	//实例化DataBase类
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="select Content from PublicMessage where PublicMessageId=$pPublicMessageId";
	$db->Query();
	
	//获取详细信息	
	$content=$db->mResultArray[0]->Content; 
	
	//显示详细信息，使用<table>
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr><td width=10%>"; 
	echo "公共信息内容：";
	echo "</td>";
	echo "<td>"; 
	echo $content;
	echo "</td></tr>";
	echo "</table>";	 
} 

/********************************************* 
函数：	InitData
功能：	
			获取基本信息，放入数组var $mInforArray中
输入参数：			
			$pPublicMessageId=所要获取信息的公共信息ID
***********************************************/ 
function InitDataByPublicMessageId($pPublicMessageId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//获取基本信息
	$db->SqlString="Select * from PublicMessage where PublicMessageId=$pPublicMessageId";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	$db->__destruct();	
}

}
?>