<?php
	session_start();		//ʹ��session�洢�û�ID��Ϣ	
	
	//�����û�����˵�
	include("UserManager.php");
	
	//��������ȷ����ʱ
	if(isset($_POST["btnAdd"]))
	{	
		//ʵ�����û�����
		require_once("UserClass.php");
		$user=new User();	
		
		//�ж��Ƿ�����ͬ�ĵ�¼��������У�����
		$user_id=-1;
		if($user->IsValid($_POST["LoginName"],$_POST["Password"],$user_id))
		{
			echo "<script language='javascript'>";
			echo " alert('�Ѿ�����ͬ���û���');";
			echo " history.go(-1);";
			echo "</script>";
			return;
		}
		
		//��ȡ����Ϣ
		$new_user_array=Array(
			"LoginName"=>$_POST["LoginName"],
			"Password"=>$_POST["Password"],
			"RealName"=>$_POST["RealName"],
			"Department"=>$_POST["Department"],
			"Email"=>$_POST["Email"],
			"RoleId"=>$_POST["RoleSelect"]
		);
		
		//�����û����Add()����������û�
		$user->Add($new_user_array);
		
		//ע��ss_user_id Session
		$user->InitDataByUserName($_POST["LoginName"],$_POST["Password"]);
		$ss_user_id	=$user->mBasicInforArray[0]->UserId;
		session_register("ss_user_id");
	
		//ҳ���ض�λ
		echo "<script language='javascript'>";
		echo " alert('�û���ӳɹ�');";
		echo " location='UserView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>����û�</title>
</head>

<body>
<h1 align="center">������û�</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmAdd" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">��¼��:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="LoginName" size="40" > 
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">��¼����:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="password" name="Password"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">��ʵ����:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="RealName" size="40"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">���ڲ���:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Department" size="40"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">�����ʼ�:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="Email" size="40"> 
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
			<input type="submit" name="btnAdd" value="ȷ��">
			&nbsp;&nbsp;&nbsp;	
			<input type="reset" value="�� д" name="cencel"> 
			</font></div> 
		</td> 
	</tr>
	</form>
</table>
</body>
</html>