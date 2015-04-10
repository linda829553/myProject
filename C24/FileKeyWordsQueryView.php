<?php
	session_start(); 							//装载Session库，一定要放在首行 
	include("FileManager.php");		//包含公文管理菜单
	
	//接收查询关键字信息，并赋予$key_words，如果没有，则置空（查询所有公文）
	if(isset($_POST["btnSearch"]))
		$key_words=$_POST["txtKeyWords"];
	else
		$key_words="";

	//得到分页显示所需要的当前页起始数据序号信息
	if(isset($_GET["begin_record"]))
		$g_begin_record=$_GET["begin_record"]; 
	else
		$g_begin_record=0; 
	//利用session传递数据
	session_register("g_begin_record");		//注册分页显示的g_begin_record变量,注意没有$符号
?>
<div align=right>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method=post>
	<input type="text" name="txtKeyWords" value=<?php echo $key_words;?>>
	<input type="submit" name="btnSearch" value="查询">
</from>
</div>

<?php
	//包含File类
	require_once("FileClass.php");
	$file=new File();
	//利用File的ShowByKeyWords显示查询结果数据
	$file->ShowByKeyWords($key_words);
?>