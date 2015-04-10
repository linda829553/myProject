<?php
	session_start(); 										//装载Session库，一定要放在首行 
	
	//根据用户提交表单获取所要查询的分类ID
	if(isset($_POST["btnSearch"]))
		$pubmsg_id=$_POST["CategorySelect"];
	else
		$pubmsg_id=1;
		
	include("PublicMessageManager.php");
		
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
	//根据公共信息类的ShowByCategory()方法显示查询结果
	require_once("PublicMessageClass.php");
	$bcl=new PublicMessage();
	$bcl->ShowByCategory($pubmsg_id);
?>