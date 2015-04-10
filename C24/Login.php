<?php
	session_start();	//使用session存储用户信息
	
	//当单击“登录”时
	if(isset($_POST["cmdLogin"]))
	{
		$ss_user_id="";
		
		//利用User累的IsValid()方法判断所输入的用户名和口令是否正确
		require_once("UserClass.php");
		$user=new User();	
		//如果正确，转到系统首页
		if($user->IsValid($_POST["login_name"],$_POST["password"],$ss_user_id))
		{
			session_register("ss_user_id");
			echo "<script language='javascript'>";
			echo " location='Index.php';";
			echo "</script>";
		}
		//如果不正确，转到注册页面
		else
		{
			echo "<script language='javascript'>";
			echo " alert('请先注册');";
			echo " location='UserAdd.php';";
			echo "</script>";
		}
	}

?>
<html>
	<head>
		<title>用户登录</title>
	</head>

	<body bgcolor="#FFFFFF" text="#000000">
	<h1 align="center">欢迎光临办公自动化系统</h1>
	<table width="100%" border="0" align="center" bgcolor="#FFFFFF">
	  <tr> 
	    <td align="center"> <img src="images/logo.jpg" width="100" > 
	    <td> 
	  </tr>
	  <tr> 
	    <td align="center"> 
	      <form name="frmLogin" method="post" action="Login.php">
	        帐户名： 
	        <input type="text" name="login_name"  width="20">
	        密码： 
	        <input type="password" name="password" width="20">
	        <input type="submit" name="cmdLogin" value="登录">
	      </form>
	    </td>
	  </tr>  
	</table>
	</body>
</html>
