<?php
	session_start();		//使用session存储用户ID信息	
	
	//利用File类的InitDataByFileId()获取当前公文信息数组
	include("FileManager.php");
	require_once("FileClass.php");
	$file=new File();	
	$file->InitDataByFileId($_GET["fileid"]);

	//当单击“确定”时
	if(isset($_POST["btnUpdate"]))
	{	
		//获取表单信息
		$new_file_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"ToUserName"=>$_POST["ToUserName"],
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"StatusId"=>$_POST["StatusSelect"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//使用File类的Update方法修改公文信息
		$file->Update($_GET["fileid"],$new_file_array);
		
		//页面重定位
		echo "<script language='javascript'>";
		echo " alert('修改公文成功');";
		echo " location='FileKeyWordsQueryView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>修改公文</title>
</head>

<body>
<h1 align="center">修改公文</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmUpdate" action=<?php echo $_SERVER['PHP_SELF']."?fileid=".$_GET["fileid"];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">TO:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="ToUserName" size="40" value=<? echo $file->mInforArray[0]->ToUserName;?>> 
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">标题:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="text" name="Title"  value=<? echo $file->mInforArray[0]->Title;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">关键字:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="KeyWords" size="40"  value=<? echo $file->mInforArray[0]->KeyWords;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">内容:</td> 
		<td colspan="2" height="29" width="78%">	
			<textarea rows="10" name="Content" cols="100" wrap="VIRTUAL"><? echo $file->mInforArray[0]->Content;?></textarea> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">状态:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php include("StatusSelect.php");?>
		</td> 
	</tr> 		
	<tr>	
		<td width="30%" height="29">类别:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php  include("CategorySelect.php");?>
		</td> 		
	</tr>
	<tr>	
		<td colspan="3" height="24">	
			<div align="center"><font color="#00FF00">	
			<input type="submit" name="btnUpdate" value="确定">
			&nbsp;&nbsp;&nbsp;	
			<input type="reset" value="重 写" name="cencel"> 
			</font></div> 
		</td> 
	</tr>
	</form>
</table>
</body>
</html>