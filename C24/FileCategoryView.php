<?php
	session_start(); 										//装载Session库，一定要放在首行 

	//根据用户提交表单获取所要查询的分类ID
	if(isset($_POST["btnSearch"]))
		$cat_id=$_POST["CategorySelect"];
	else
		$cat_id=1;

	//包含公文管理菜单		
	include("FileManager.php");
	
	//注册分页显示所需要的当前页起始行Session变量
	if(isset($_GET["begin_record"]))
		$g_begin_record=$_GET["begin_record"]; 
	else
		$g_begin_record=0; 
	session_register("g_begin_record");		//注册分页显示的g_begin_record变量,注意没有$符号
	
?>

<div align=right>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method=post>
	<?php include_once("CategorySelect.php");?>
	<input type="submit" name="btnSearch" value="查询">
</from>
</div>

<?php
	//包含File类
	require_once("FileClass.php");
	
	//根据File的ShowByCategory()方法显示查询结果
	$file=new File();
	$file->ShowByCategory($cat_id);
?>