<?php
	session_start();		//使用session存储用户ID信息	
	
	//包含用户管理菜单
	include("UserManager.php");
	
	//当单击“确定”时
	if(isset($_POST["btnAdd"]))
	{	
		//实例化用户对象
		require_once("UserClass.php");
		$user=new User();	
		
		//判断是否有相同的登录名，如果有，返回
		$user_id=-1;
		if($user->IsValid($_POST["LoginName"],$_POST["Password"],$user_id))
		{
			echo "<script language='javascript'>";
			echo " alert('已经存在同名用户！');";
			echo " history.go(-1);";
			echo "</script>";
			return;
		}
		
		//获取表单信息
		$new_user_array=Array(
			"LoginName"=>$_POST["LoginName"],
			"Password"=>$_POST["Password"],
			"RealName"=>$_POST["RealName"],
			"Department"=>$_POST["Department"],
			"Email"=>$_POST["Email"],
			"RoleId"=>$_POST["RoleSelect"]
		);
		
		//利用用户类的Add()方法添加新用户
		$user->Add($new_user_array);
		
		//注册ss_user_id Session
		$user->InitDataByUserName($_POST["LoginName"],$_POST["Password"]);
		$ss_user_id	=$user->mBasicInforArray[0]->UserId;
		session_register("ss_user_id");
	
		//页面重定位
		echo "<script language='javascript'>";
		echo " alert('用户添加成功');";
		echo " location='UserView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>添加用户</title>
</head>

<body>
<h1 align="center">添加新用户</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmAdd" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">登录名:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="LoginName" size="40" > 
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">登录口令:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="password" name="Password"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">真实姓名:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="RealName" size="40"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">所在部门:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Department" size="40"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">电子邮件:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Email" size="40"> 
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