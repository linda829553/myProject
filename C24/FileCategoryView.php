<?php
	session_start(); 										//װ��Session�⣬һ��Ҫ�������� 

	//�����û��ύ����ȡ��Ҫ��ѯ�ķ���ID
	if(isset($_POST["btnSearch"]))
		$cat_id=$_POST["CategorySelect"];
	else
		$cat_id=1;

	//�������Ĺ���˵�		
	include("FileManager.php");
	
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
	//����File��
	require_once("FileClass.php");
	
	//����File��ShowByCategory()������ʾ��ѯ���
	$file=new File();
	$file->ShowByCategory($cat_id);
?>