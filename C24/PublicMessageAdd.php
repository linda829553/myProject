<?php
	session_start();		//ʹ��session�洢�û�ID��Ϣ	
	
	//����������Ϣ����˵�
	include("PublicMessageManager.php");
	
	//��������ȷ����ʱ
	if(isset($_POST["btnAdd"]))
	{	
		//ʵ�����û�����
		require_once("PublicMessageClass.php");
		$PublicMessage=new PublicMessage();	
		
		//��ȡ����Ϣ
		$new_PublicMessage_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//ʹ��Add�����������
		$PublicMessage->Add($new_PublicMessage_array);
		
		//ҳ���ض�λ
		echo "<script language='javascript'>";
		echo " alert('�½�������Ϣ�ɹ�');";
		echo " location='PublicMessageKeyWordsQueryView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>�½�������Ϣ</title>
</head>
<body>
<h1 align="center">�½�������Ϣ</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmAdd" action=<?php echo $_SERVER['PHP_SELF'];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">����:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="text" name="Title"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">�ؼ���:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="KeyWords" size="40"> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">����:</td> 
		<td colspan="2" height="29" width="78%">	
					<textarea rows="5" name="Content" cols="50" wrap="VIRTUAL"></textarea> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">���:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php  include("CategorySelect.php");?>
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