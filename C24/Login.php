<?php
	session_start();	//ʹ��session�洢�û���Ϣ
	
	//����������¼��ʱ
	if(isset($_POST["cmdLogin"]))
	{
		$ss_user_id="";
		
		//����User�۵�IsValid()�����ж���������û����Ϳ����Ƿ���ȷ
		require_once("UserClass.php");
		$user=new User();	
		//�����ȷ��ת��ϵͳ��ҳ
		if($user->IsValid($_POST["login_name"],$_POST["password"],$ss_user_id))
		{
			session_register("ss_user_id");
			echo "<script language='javascript'>";
			echo " location='Index.php';";
			echo "</script>";
		}
		//�������ȷ��ת��ע��ҳ��
		else
		{
			echo "<script language='javascript'>";
			echo " alert('����ע��');";
			echo " location='UserAdd.php';";
			echo "</script>";
		}
	}

?>
<html>
	<head>
		<title>�û���¼</title>
	</head>

	<body bgcolor="#FFFFFF" text="#000000">
	<h1 align="center">��ӭ���ٰ칫�Զ���ϵͳ</h1>
	<table width="100%" border="0" align="center" bgcolor="#FFFFFF">
	  <tr> 
	    <td align="center"> <img src="images/logo.jpg" width="100" > 
	    <td> 
	  </tr>
	  <tr> 
	    <td align="center"> 
	      <form name="frmLogin" method="post" action="Login.php">
	        �ʻ����� 
	        <input type="text" name="login_name"  width="20">
	        ���룺 
	        <input type="password" name="password" width="20">
	        <input type="submit" name="cmdLogin" value="��¼">
	      </form>
	    </td>
	  </tr>  
	</table>
	</body>
</html>
