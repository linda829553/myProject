<?php
	session_start();

	//�����û�����˵�
	include("UserManager.php");	
	//�����û���
	require_once("UserClass.php");
	
	//����User���InitDataByUserId()������ȡ�û���Ϣ����
	$user=new User();	
	$user->InitDataByUserId($_SESSION["ss_user_id"]);
?> 

<!--UserView.php:��ʾ--------------->
<html>
<head>
<title>��ʾ�û���Ϣ</title>
</head>
<body>
<h1 align="center">��ʾ�û���Ϣ</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">��¼��:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->LoginName;?>
		</td> 
	</tr>
	<tr>	
		<td width="30%" height="29">��¼����:</td> 
		<td colspan="3" valign="middle" align="left">	
			<?php echo $user->mBasicInforArray[0]->Password;?>
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">��ʵ����:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->RealName;?>
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">���ڲ���:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->Department;?>
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">�����ʼ�:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mBasicInforArray[0]->Email;?>
		</td> 
	</tr> 		
	<tr>	
		<td width="30%" height="29">�û���ɫ:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php echo $user->mPrivilegeInfoArray[0]->RoleName;?>
		</td> 		
	</tr>	
</table>
</body>
</html>