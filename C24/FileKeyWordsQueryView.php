<?php
	session_start(); 							//װ��Session�⣬һ��Ҫ�������� 
	include("FileManager.php");		//�������Ĺ���˵�
	
	//���ղ�ѯ�ؼ�����Ϣ��������$key_words�����û�У����ÿգ���ѯ���й��ģ�
	if(isset($_POST["btnSearch"]))
		$key_words=$_POST["txtKeyWords"];
	else
		$key_words="";

	//�õ���ҳ��ʾ����Ҫ�ĵ�ǰҳ��ʼ���������Ϣ
	if(isset($_GET["begin_record"]))
		$g_begin_record=$_GET["begin_record"]; 
	else
		$g_begin_record=0; 
	//����session��������
	session_register("g_begin_record");		//ע���ҳ��ʾ��g_begin_record����,ע��û��$����
?>
<div align=right>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method=post>
	<input type="text" name="txtKeyWords" value=<?php echo $key_words;?>>
	<input type="submit" name="btnSearch" value="��ѯ">
</from>
</div>

<?php
	//����File��
	require_once("FileClass.php");
	$file=new File();
	//����File��ShowByKeyWords��ʾ��ѯ�������
	$file->ShowByKeyWords($key_words);
?>