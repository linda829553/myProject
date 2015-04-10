<!--LogClass.php:日志类------------------------------->
<?php

class Log{	
	
var $mInforArray;		//日志信息数组
	
/********************************************* 
函数：	Add
功能：	增加一个新日志	
输入参数：
			$pCreateTime＝操作日期
			$pLogContent＝操作动作
***********************************************/ 
function Add($pCreateTime,$pLogContent)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	//连接数据库
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="insert into Log ";
		
	//构造Insert语句
	$db->SqlString=$db->SqlString."(CreateTime,LogContent) ";
	$db->SqlString=$db->SqlString." values (";
	$db->SqlString=$db->SqlString."'".$pCreateTime."',";
	$db->SqlString=$db->SqlString."'".$pLogContent."'";
	$db->SqlString=$db->SqlString.") ";
	
	//执行SQL
	$db->ExecuteSql();
	$db->__destruct();	
}
	
/********************************************* 
构造函数：ShowByCreateTime
功能：		根据日志创建时间显示日志信息
输入参数：			
		$pCreateTime：日志创建时间	
***********************************************/ 
function ShowByCreateTime($pCreateTime)
{
	require("sys_conf.inc");
	require_once("DataBase.php");
	require_once("myDataGridClass.php");
	
	//实例化DataBase类
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	echo "【操作时间】".$pCreateTime;
	
	//实例化myDataGridClass类
	$view=new myDataGridClass($PAGE_MAX_LINE);	 
	$temp="select * from Log where CreateTime='$pCreateTime'";
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
	echo "<td>时间</td>"; 
	echo "<td>操作内容</td>";	
	echo "</tr>"; 
	for($i=0;$i<$view->current_records;$i++)
	{ 
		if(ceil($i/2)*2==$i) 
			$bgc="white"; 
		else 
			$bgc="yellow"; 
		
		echo "<tr bgcolor=$bgc><td>"; 
		echo $view->result[$i]["CreateTime"]; 
		echo "</td><td>"; 
		echo $view->result[$i]["LogContent"]; 
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//分页显示导航
	$view->navigate();	
	//关闭数据库
	$db->__destruct();	
}

}
?>