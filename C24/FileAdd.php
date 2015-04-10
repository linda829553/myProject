<?php
	session_start();		//使用session存储用户ID信息	
	
	include("FileManager.php");
	
	if(isset($_POST["btnAdd"]))
	{	
		//实例化用户对象
		require_once("FileClass.php");
		$File=new File();	
		
		//获取表单信息
		$new_File_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"ToUserName"=>$_POST["ToUserName"],
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"StatusId"=>$_POST["StatusSelect"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//利用File的Add()方法添加数据
		$File->Add($new_File_array);
		
		//页面重定位
		echo "<script language='javascript'>";
		echo " alert('新建公文成功');";
		echo " location='FileKeyWordsQueryView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>新建公文</title>
</head>

<body>
<h1 align="center">新建公文</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmAdd" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">TO:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="ToUserName" size="40" > 
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">标题:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="text" name="Title"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">关键字:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="KeyWords" size="40"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">内容:</td> 
		<td colspan="2" height="29" width="78%">	
					<textarea rows="5" name="Content" cols="50" wrap="VIRTUAL"></textarea> 
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
			<input type="submit" name="btnAdd" value="确定">
			&nbsp;&nbsp;&nbsp;	
			<input type="reset" value="重 写" name="cencel"> 
			</font></div> 
		</td> 
	</tr>
	</form>
</table>
</body>
</html>