<!--LogClass.php:��־��------------------------------->
<?php

class Log{	
	
var $mInforArray;		//��־��Ϣ����
	
/********************************************* 
������	Add
���ܣ�	����һ������־	
���������
			$pCreateTime����������
			$pLogContent����������
***********************************************/ 
function Add($pCreateTime,$pLogContent)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="insert into Log ";
		
	//����Insert���
	$db->SqlString=$db->SqlString."(CreateTime,LogContent) ";
	$db->SqlString=$db->SqlString." values (";
	$db->SqlString=$db->SqlString."'".$pCreateTime."',";
	$db->SqlString=$db->SqlString."'".$pLogContent."'";
	$db->SqlString=$db->SqlString.") ";
	
	//ִ��SQL
	$db->ExecuteSql();
	$db->__destruct();	
}
	
/********************************************* 
���캯����ShowByCreateTime
���ܣ�		������־����ʱ����ʾ��־��Ϣ
���������			
		$pCreateTime����־����ʱ��	
***********************************************/ 
function ShowByCreateTime($pCreateTime)
{
	require("sys_conf.inc");
	require_once("DataBase.php");
	require_once("myDataGridClass.php");
	
	//ʵ����DataBase��
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	echo "������ʱ�䡿".$pCreateTime;
	
	//ʵ����myDataGridClass��
	$view=new myDataGridClass($PAGE_MAX_LINE);	 
	$temp="select * from Log where CreateTime='$pCreateTime'";
	$view->__set("sql",$temp);	
	$view->read_data();
	
	//�������Ϊ�գ��򷵻�
	if($view->current_records==0) 
	{
		echo "<tr><td colbegin_record=4> </td></tr>"; 
		return;
	}		 

	//���ݲ�Ϊ�գ���ʾ����
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr bgcolor='green'>"; 	
	echo "<td>ʱ��</td>"; 
	echo "<td>��������</td>";	
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
	//��ҳ��ʾ����
	$view->navigate();	
	//�ر����ݿ�
	$db->__destruct();	
}

}
?>