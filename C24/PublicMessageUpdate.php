<?php
	session_start();		//ʹ��session�洢�û�ID��Ϣ	
	
	//����������Ϣ�˵��͹�����Ϣ��	
	include("PublicMessageManager.php");
	require_once("PublicMessageClass.php");
	
	//ʹ�ù�����Ϣ���InitDataByPublicMessageId������ȡ����Ϣ����
	$file=new PublicMessage();	
	$file->InitDataByPublicMessageId($_GET["pubmsgid"]);
		
	//��������ȷ������ťʱ
	if(isset($_POST["btnUpdate"]))
	{			
		//��ȡ����Ϣ
		$new_file_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//���ù�����Ϣ���Update�����޸�����
		$file->Update($_GET["pubmsgid"],$new_file_array);
		
		//ҳ���ض�λ
		echo "<script language='javascript'>";
		echo " alert('�޸Ĺ���ɹ�');";
		echo " location='PublicMessageKeyWordsQueryView.php';";
		echo "</script>";
	}
?>

<html>
<head>
<title>�޸Ĺ���</title>
</head>

<body>
<h1 align="center">�޸Ĺ���</h1>
<table width="90%" border="1" align="center"  bgcolor="#F0F0F0">
	<form method="POST" name="frmUpdate" action=<?php echo $_SERVER['PHP_SELF']."?pubmsgid=".$_GET["pubmsgid"];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">����:</td> 
		<td colspan="3" valign="middle" align="left">	
			<input type="text" name="Title"  value=<? echo $file->mInforArray[0]->Title;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">�ؼ���:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="KeyWords" size="40"  value=<? echo $file->mInforArray[0]->KeyWords;?>> 
		</td> 
	</tr> 
	<tr>	
		<td width="30%" height="29">����:</td> 
		<td colspan="2" height="29" width="78%">	
			<textarea rows="10" name="Content" cols="100" wrap="VIRTUAL"><? echo $file->mInforArray[0]->Content;?></textarea> 
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