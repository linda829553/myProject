<?php
	session_start(); 										//װ��Session�⣬һ��Ҫ�������� 
	
	//�����û��ύ����ȡ��Ҫ��ѯ�ķ���ID
	if(isset($_POST["btnSearch"]))
		$pubmsg_id=$_POST["CategorySelect"];
	else
		$pubmsg_id=1;
		
	include("PublicMessageManager.php");
		
	//ע���ҳ��ʾ����Ҫ�ĵ�ǰҳ��ʼ��Session����
	if(isset($_GET["begin_record"]))
		$g_begin_record=$_GET["begin_record"]; 
	else
		$g_begin_record=0; 
	session_register("g_begin_record");		//ע���ҳ��ʾ��g_begin_record����,ע��û��$����
	
?>

<div align=right>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method=post>
	<?php include_once("CategorySelect.php");?>
	<input type="submit" name="btnSearch" value="��ѯ">
</from>
</div>

<?php
	//���ݹ�����Ϣ���ShowByCategory()������ʾ��ѯ���
	require_once("PublicMessageClass.php");
	$bcl=new PublicMessage();
	$bcl->ShowByCategory($pubmsg_id);
?>