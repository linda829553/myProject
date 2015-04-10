<?
	session_start();		//使用session存储用户ID信息	
	
	//包含用户管理菜单
	include("UserManager.php");
	
	//利用User类的InitDataByUserId()方法得到用户信息数组，并在页面表单上显示
	require_once("UserClass.php");
	$user=new User();	
	$user->InitDataByUserId($_SESSION["ss_user_id"]);
		
	//当用户单击“确定”时
	if(isset($_POST["btnUpdate"]))
	{	
		//获取表单信息
		$new_user_array=Array(
			"LoginName"=>$_POST["LoginName"],
			"Password"=>$_POST["Password"],
			"RealName"=>$_POST["RealName"],
			"Department"=>$_POST["Department"],
			"Email"=>$_POST["Email"],
			"RoleId"=>$_POST["RoleSelect"]
		);
		
		//利用User类的Update方法修改用户信息
		$user->Update($_SESSION["ss_user_id"],$new_user_array);
		
		//页面重定位
		echo "<script language='javascript'>";
		echo " alert('用户修改成功');";
		echo " location='UserView.php';";
		echo "</script>";
	}
?> 

<html>
<head>
<title>修改用户信息</title>
</head>
<body onload="init_role();">
<h1 align="center">修改用户信息</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmUpdate" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">登录名:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="LoginName" size="40" value=<?php echo $user->mBasicInforArray[0]->LoginName;?>> 
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">登录口令:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="password" name="Password"  value=<?php echo $user->mBasicInforArray[0]->Password;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">真实姓名:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="RealName" size="40"  value=<?php echo $user->mBasicInforArray[0]->RealName;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">所在部门:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Department" size="40"  value=<?php echo $user->mBasicInforArray[0]->Department;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">电子邮件:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Email" size="40"  value=<?php echo $user->mBasicInforArray[0]->Email;?>> 
		</td> 
	</tr> 		
	<tr>	
		<td width="30%" height="29">用户角色:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php include("RoleSelect.php");?>
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