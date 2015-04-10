<!--FileClass.php:������------------------------------->
<?php

class File{	
	
var $mInforArray;		//������Ϣ����
	
/********************************************* 
������	Add
���ܣ�	����һ���¹���	
���������
			$pFileInfoArray=�¹�����Ϣ����		
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
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[FileAdd]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	Update
���ܣ�	�޸�һ�����ĵ���Ϣ
���������
			$pFileId=��Ҫ�޸ĵĹ���ID
			$pFileInfoArray=��Ҫ�޸ĵ���Ϣ����
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
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[FileUpdate]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}

/********************************************* 
������	Delete
���ܣ�	ɾ��һ������	
���������			
			$pFileId=��Ҫɾ���Ĺ���ID
***********************************************/ 
function Delete($pFileId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="Delete from File where FileId=$pFileId";
	$db->ExecuteSql();
	$db->__destruct();	
	
	//�����־
	include_once("LogClass.php");
	$log=new Log();
	$action=addcslashes("[FileDelete]".$db->SqlString,"'");
	$log->add(date("y-m-d"),$action);
}
	
/********************************************* 
���캯����ShowByCategory
���ܣ�		��������ҳ��ʾ������Ϣ
���������			
		$pCategoryId����������	
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
	$temp="select Status.StatusDesc,Category.*,File.* ";
	$temp=$temp." from File,Status,Category where File.CategoryId=$pCategoryId";
	$temp=$temp." and File.CategoryId=Category.CategoryId";
	$temp=$temp." and File.StatusId=Status.StatusId";
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
	echo "<td>To</td>"; 
	echo "<td>�ؼ���</td>";
	echo "<td>״̬</td>";	
	echo "<td>���</td>";	
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
		echo "<a href=FileUpdate.php?fileid=".$view->result[$i]["FileId"].">�޸�</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileDelete.php?fileid=".$view->result[$i]["FileId"].">ɾ��</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileReport.php?fileid=".$view->result[$i]["FileId"].">�ϱ�</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileApprove.php?fileid=".$view->result[$i]["FileId"].">����</a>"; 				
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
���ܣ�		���ݹؼ��ַ�ҳ��ʾ������Ϣ
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
	$temp="select Status.StatusDesc,Category.CategoryName,File.* ";
	$temp=$temp." from File,Status,Category where File.KeyWords like '%$pKeyWords%'";
	$temp=$temp." and File.CategoryId=Category.CategoryId";
	$temp=$temp." and File.StatusId=Status.StatusId";
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
	echo "<td>To</td>"; 
	echo "<td>�ؼ���</td>";
	echo "<td>״̬</td>";	
	echo "<td>���</td>";	
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
		echo "<a href=FileUpdate.php?fileid=".$view->result[$i]["FileId"].">�޸�</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileDelete.php?fileid=".$view->result[$i]["FileId"].">ɾ��</a>"; 				
		echo "</td><td>"; 
		echo "<a href=FileReport.php?fileid=".$view->result[$i]["FileId"].">�ϱ�</a>"; 		
		echo "</td><td>"; 
		echo "<a href=FileApprove.php?fileid=".$view->result[$i]["FileId"].">����</a>"; 				
		echo "</td></tr>"; 
	} 
	echo "</table>";
	//��ҳ��ʾ����
	$view->navigate();	
	//�ر����ݿ�
	$db->__destruct();	
}

//��ʾ������ϸ��Ϣ
function ShowDetail($pFileId)
{ 
	require("sys_conf.inc");
	require_once("DataBase.php");	

	//ʵ����DataBase��
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	$db->SqlString="select Content from File where FileId=$pFileId";
	$db->Query();
	
	//��ȡ��ϸ��Ϣ	
	$content=$db->mResultArray[0]->Content; 
	
	//��ʾ��ϸ��Ϣ��ʹ��<table>
	echo "<table width='95%' border='1' align='center'>";
	echo "<tr><td width=10%>"; 
	echo "�������ݣ�";
	echo "</td>";
	echo "<td>"; 
	echo $content;
	echo "</td></tr>";
	echo "</table>";	 
} 

/********************************************* 
������	InitData
���ܣ�	
			��ȡһ�����ĵĻ�����Ϣ����������mInforArray��
���������			
			$pFileId=��Ҫ��ȡ��Ϣ�Ĺ���ID
***********************************************/ 
function InitDataByFileId($pFileId)
{
	require("sys_conf.inc");
	require_once("DataBase.php");

	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);	
	
	//��ȡ������Ϣ
	$db->SqlString="Select * from File where FileId=$pFileId";
	$db->Query();	
	$this->mInforArray=$db->mResultArray;
	
	$db->__destruct();	
}

}
?>