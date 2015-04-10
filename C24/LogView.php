<?php
	session_start(); 										//装载Session库，一定要放在首行 
	session_unregister("create_time");
	include("LogManager.php");
	
	//接收查询日期信息，并赋予$key_words，如果没有，则查询当天信息
	if(isset($_POST["btnSearch"]))
	{
		$create_time=$_POST["txtCreateTime"];
	}
	else
	{
		$create_time=date("y-m-d");
	}
	
	//获取并注册分页显示所需要的当前页起始记录序号Session变量
	if(isset($_GET["begin_record"]))
		$g_begin_record=$_GET["begin_record"]; 
	else
		$g_begin_record=0; 
	session_register("g_begin_record");		//注册分页显示的g_begin_record变量,注意没有$符号
?>

<div align=right>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method=post>
	<input type="text" name="txtCreateTime" value=<?php echo $create_time?>>
	<input type="submit" name="btnSearch" value="查询">
</from>
</div>

<?php

	//利用Log类的ShowByCreateTime显示所查询的日志
	require_once("LogClass.php");
	$log=new Log();
	$log->ShowByCreateTime($create_time);
?>