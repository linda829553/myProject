<?
	session_start();		//ʹ��session�洢�û�ID��Ϣ	
	
	//�����û�����˵�
	include("UserManager.php");
	
	//����User���InitDataByUserId()�����õ��û���Ϣ���飬����ҳ�������ʾ
	require_once("UserClass.php");
	$user=new User();	
	$user->InitDataByUserId($_SESSION["ss_user_id"]);
		
	//���û�������ȷ����ʱ
	if(isset($_POST["btnUpdate"]))
	{	
		//��ȡ����Ϣ
		$new_user_array=Array(
			"LoginName"=>$_POST["LoginName"],
			"Password"=>$_POST["Password"],
			"RealName"=>$_POST["RealName"],
			"Department"=>$_POST["Department"],
			"Email"=>$_POST["Email"],
			"RoleId"=>$_POST["RoleSelect"]
		);
		
		//����User���Update�����޸��û���Ϣ
		$user->Update($_SESSION["ss_user_id"],$new_user_array);
		
		//ҳ���ض�λ
		echo "<script language='javascript'>";
		echo " alert('�û��޸ĳɹ�');";
		echo " location='UserView.php';";
		echo "</script>";
	}
?> 

<html>
<head>
<title>�޸��û���Ϣ</title>
</head>
<body onload="init_role();">
<h1 align="center">�޸��û���Ϣ</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmUpdate" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">��¼��:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="LoginName" size="40" value=<?php echo $user->mBasicInforArray[0]->LoginName;?>> 
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">��¼����:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="password" name="Password"  value=<?php echo $user->mBasicInforArray[0]->Password;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">��ʵ����:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="RealName" size="40"  value=<?php echo $user->mBasicInforArray[0]->RealName;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">���ڲ���:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Department" size="40"  value=<?php echo $user->mBasicInforArray[0]->Department;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">�����ʼ�:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Email" size="40"  value=<?php echo $user->mBasicInforArray[0]->Email;?>> 
		</td> 
	</tr> 		
	<tr>	
		<td width="30%" height="29">�û���ɫ:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php include("RoleSelect.php");?>
		</td> 		
	</tr>
	<tr>	
		<td colspan="3" height="24">	
			<div align="center"><font color="#00FF00">	
			<input type="submit" name="btnUpdate" value="ȷ��">
			&nbsp;&nbsp;&nbsp;	
			<input type="reset" value="�� д" name="cencel"> 
			</font></div> 
		</td> 
	</tr>
	</form>
</table>
</body>
</html>