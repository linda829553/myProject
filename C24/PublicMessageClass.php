<!--PublicMessageClass.php:������Ϣ��------------------------------->
<?php

class PublicMessage{	
	
var $mInforArray;		//������Ϣ��Ϣ����
	
/********************************************* 
������	Add
���ܣ�	����һ���¹�����Ϣ	
���������
			$pPublicMessageInfoArray=�¹�����Ϣ����		
***********************************************/ 
function Add($pPublicMessageInfoArray)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="insert into PublicMessage ";
		
	//����Insert���
	$db->SqlString=$db->SqlString."(FromUserId,CreateTime,Title,KeyWords,Content,CategoryId) ";
	$db->SqlString=$db->SqlString." values (";
	$db->SqlString=$db->SqlString.$pPublicMessageInfoArray["FromUserId"].",";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["CreateTime"]."',";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["Title"]."',";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["KeyWords"]."',";
	$db->SqlString=$db->SqlString."'".$pPublicMessageInfoArray["Content"]."',";
	$db->SqlString=$db->SqlString.$pPublicMessageInfoArray["CategoryId"];
	$db->SqlString=$db->SqlString.") ";
	
	//ִ��SQL
	$db->ExecuteSql();
	$db->__destruct();	
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[PublicMessageAdd]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	Update
���ܣ�	�޸�һ��������Ϣ����Ϣ
���������
			$pPublicMessageId=��Ҫ�޸ĵĹ�����ϢID
			$pPublicMessageInfoArray=��Ҫ�޸ĵ���Ϣ����
***********************************************/ 
function Update($pPublicMessageId,$pPublicMessageInfoArray)
{	
	require("sys_conf.inc");
	require_once("DataBase.php");
	
	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//����Update���
	$db->SqlString="Update PublicMessage set ";
	$db->SqlString=$db->SqlString."Title='".$pPublicMessageInfoArray["Title"]."',";
	$db->SqlString=$db->SqlString."KeyWords='".$pPublicMessageInfoArray["KeyWords"]."',";
	$db->SqlString=$db->SqlString."Content='".$pPublicMessageInfoArray["Content"]."',";
	$db->SqlString=$db->SqlString."CategoryId=".$pPublicMessageInfoArray["CategoryId"];
	$db->SqlString=$db->SqlString." where PublicMessageId=$pPublicMessageId ";
	
	//ִ��SQL
	$db->ExecuteSql();
	$db->__destruct();	
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[PublicMessageUpdate]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	Delete
���ܣ�	ɾ��һ��������Ϣ	
���������			
			$pPublicMessageId=��Ҫɾ���Ĺ�����ϢID
***********************************************/ 
function Delete($pPublicMessageId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	//�������ݿ�
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//����Delete���
	$db->SqlString="Delete from PublicMessage where PublicMessageId=$pPublicMessageId";
	
	//ִ��SQL
	$db->ExecuteSql();	
	$db->__destruct();	

	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[PublicMessageDelete]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}
	
/********************************************* 
���캯����ShowByCategory
���ܣ�		��������ҳ��ʾ������Ϣ��Ϣ
���������			
		$pCategoryId��������Ϣ����	
***********************************************/ 
function ShowByCategory($pCategoryId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");
	require_once("myDataGridClass.php");

	//ʵ����DataBase��
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="select * from Category where CategoryId=$pCategoryId";
	$db->Query();
	echo "&nbsp;&nbsp;&nbsp;�����".$db->mResultArray[0]->CategoryName;
	
	//ʵ����myDataGridClass��
	$view=new myDataGridClass($PAGE_MAX_LINE);	 
	$temp="select Category.*,PublicMessage.* ";
	$temp=$temp." from PublicMessage,Category where PublicMessage.CategoryId=$pCategoryId";
	$temp=$temp." and PublicMessage.CategoryId=Category.CategoryId";
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
	echo "<td>����</td>"; 
	echo "<td>׫дʱ��</td>"; 
	echo "<td>�ؼ���</td>";
	echo "<td>���</td>";	
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
		echo "<a href=PublicMessageUpdate.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">�޸�</a>"; 		
		echo "</td><td>"; 
		echo "<a href=PublicMessageDelete.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">ɾ��</a>"; 				
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//��ҳ��ʾ����
	$view->navigate();	
	//�ر����ݿ�
	$db->__destruct();	
}

/********************************************* 
���캯����ShowByKeyWords
���ܣ�		���ݹؼ��ַ�ҳ��ʾ������Ϣ��Ϣ
���������			
		$pKeyWords���ؼ���
***********************************************/ 
function ShowByKeyWords($pKeyWords)
{
	require("sys_conf.inc");
	require_once("DataBase.php");
	require_once("myDataGridClass.php");

	//ʵ����DataBase��
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	echo "���ؼ��֡�".$pKeyWords;
	
	//ʵ����myDataGridClass��
	$view=new myDataGridClass($PAGE_MAX_LINE);	 
	$temp="select Category.CategoryName,PublicMessage.* ";
	$temp=$temp." from PublicMessage,Category where PublicMessage.KeyWords like '%$pKeyWords%'";
	$temp=$temp." and PublicMessage.CategoryId=Category.CategoryId";
	$view->__set("sql",$temp);	
	$view->read_data();
	
	//�������Ϊ�գ��򷵻�
	if($view->current_records==0) 
	{
		echo "<tr><td colbegin_record=4> </td></tr>"; 
		return;
	}		 
	
	//�������Ϊ�գ��򷵻�
	if($view->current_records==0) 
	{
		echo "<tr><td colbegin_record=4> </td></tr>"; 
		return;
	}		 

	//���ݲ�Ϊ�գ���ʾ����
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr bgcolor='green'>"; 	
	echo "<td>����</td>"; 
	echo "<td>׫дʱ��</td>"; 
	echo "<td>�ؼ���</td>";
	echo "<td>���</td>";	
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
		echo "<a href=PublicMessageUpdate.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">�޸�</a>"; 		
		echo "</td><td>"; 
		echo "<a href=PublicMessageDelete.php?pubmsgid=".$view->result[$i]["PublicMessageId"].">ɾ��</a>"; 				
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//��ҳ��ʾ����
	$view->navigate();	
	//�ر����ݿ�
	$db->__destruct();	
}

//��ʾ������Ϣ��ϸ��Ϣ
function ShowDetail($pPublicMessageId)
{ 
	require("sys_conf.inc");
	require_once("DataBase.php");	

	//ʵ����DataBase��
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="select Content from PublicMessage where PublicMessageId=$pPublicMessageId";
	$db->Query();
	
	//��ȡ��ϸ��Ϣ	
	$content=$db->mResultArray[0]->Content; 
	
	//��ʾ��ϸ��Ϣ��ʹ��<table>
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr><td width=10%>"; 
	echo "������Ϣ���ݣ�";
	echo "</td>";
	echo "<td>"; 
	echo $content;
	echo "</td></tr>";
	echo "</table>";	 
} 

/********************************************* 
������	InitData
���ܣ�	
			��ȡ������Ϣ����������var $mInforArray��
���������			
			$pPublicMessageId=��Ҫ��ȡ��Ϣ�Ĺ�����ϢID
***********************************************/ 
function InitDataByPublicMessageId($pPublicMessageId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//��ȡ������Ϣ
	$db->SqlString="Select * from PublicMessage where PublicMessageId=$pPublicMessageId";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	$db->__destruct();	
}

}
?>