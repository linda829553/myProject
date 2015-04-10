<?php
	session_start();		//使用session存储用户ID信息	
	
	//包含公共信息管理菜单
	include("PublicMessageManager.php");
	
	//当单击“确定”时
	if(isset($_POST["btnAdd"]))
	{	
		//实例化用户对象
		require_once("PublicMessageClass.php");
		$PublicMessage=new PublicMessage();	
		
		//获取表单信息
		$new_PublicMessage_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//使用Add方法添加数据
		$PublicMessage->Add($new_PublicMessage_array);
		
		//页面重定位
		echo "<script language='javascript'>";
		echo " alert('新建公共信息成功');";
		echo " location='PublicMessageKeyWordsQueryView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>新建公共信息</title>
</head>
<body>
<h1 align="center">新建公共信息</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmAdd" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
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