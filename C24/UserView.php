<?php
	session_start();

	//包含用户管理菜单
	include("UserManager.php");	
	//包含用户类
	require_once("UserClass.php");
	
	//利用User类的InitDataByUserId()方法获取用户信息数组
	$user=new User();	
	$user->InitDataByUserId($_SESSION["ss_user_id"]);
?> 

<!--UserView.php:显示--------------->
<html>
<head>
<title>显示用户信息</title>
</head>
<body>
<h1 align="center">显示用户信息</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">登录名:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->LoginName;?>
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">登录口令:</td> 
		<td colspan="3" valign="middle" align="left">	
			<?php echo $user->mBasicInforArray[0]->Password;?>
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">真实姓名:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->RealName;?>
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">所在部门:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->Department;?>
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">电子邮件:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->Email;?>
		</td> 
	</tr> 		
	<tr>	
		<td width="30%" height="29">用户角色:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mPrivilegeInfoArray[0]->RoleName;?>
		</td> 		
	</tr>	
</table>
</body>
</html>