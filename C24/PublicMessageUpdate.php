<?php
	session_start();		//使用session存储用户ID信息	
	
	//包含公共信息菜单和公共信息类	
	include("PublicMessageManager.php");
	require_once("PublicMessageClass.php");
	
	//使用公共信息类的InitDataByPublicMessageId方法获取其信息数组
	$file=new PublicMessage();	
	$file->InitDataByPublicMessageId($_GET["pubmsgid"]);
		
	//当单击“确定”按钮时
	if(isset($_POST["btnUpdate"]))
	{			
		//获取表单信息
		$new_file_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//利用公共信息类的Update方法修改数据
		$file->Update($_GET["pubmsgid"],$new_file_array);
		
		//页面重定位
		echo "<script language='javascript'>";
		echo " alert('修改公告成功');";
		echo " location='PublicMessageKeyWordsQueryView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>修改公告</title>
</head>

<body>
<h1 align="center">修改公告</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmUpdate" action=<?php echo $_SERVER['PHP_SELF']."?pubmsgid=".$_GET["pubmsgid"];?>> 
	<tr>
		<td align="center" colspan=2></td> 
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