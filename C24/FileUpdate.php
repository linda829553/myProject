<?php
	session_start();		//ʹ��session�洢�û�ID��Ϣ	
	
	//����File���InitDataByFileId()��ȡ��ǰ������Ϣ����
	include("FileManager.php");
	require_once("FileClass.php");
	$file=new File();	
	$file->InitDataByFileId($_GET["fileid"]);

	//��������ȷ����ʱ
	if(isset($_POST["btnUpdate"]))
	{	
		//��ȡ������Ϣ
		$new_file_array=Array(
			"FromUserId"=>$_SESSION["ss_user_id"],
			"CreateTime"=>date("y-m-d"),
			"ToUserName"=>$_POST["ToUserName"],
			"Title"=>$_POST["Title"],
			"KeyWords"=>$_POST["KeyWords"],
			"Content"=>$_POST["Content"],
			"StatusId"=>$_POST["StatusSelect"],
			"CategoryId"=>$_POST["CategorySelect"]
		);
		
		//ʹ��File���Update�����޸Ĺ�����Ϣ
		$file->Update($_GET["fileid"],$new_file_array);
		
		//ҳ���ض�λ
		echo "<script language='javascript'>";
		echo " alert('�޸Ĺ��ĳɹ�');";
		echo " location='FileKeyWordsQueryView.php';";
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
	<form method="POST" name="frmUpdate" action=<?php echo $_SERVER['PHP_SELF']."?fileid=".$_GET["fileid"];?>> 
	<tr>
		<td align="center" colspan=2></td> 
	</tr>
	<tr>	
		<td width="30%" height="29">TO:</td> 
		<td colspan="2" height="29" width="78%">	
			<input type="text" name="ToUserName" size="40" value=<? echo $file->mInforArray[0]->ToUserName;?>> 
		</td> 
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
		<td width="30%" height="29">״̬:</td> 
		<td colspan="2" height="29" width="78%">	
			<?php include("StatusSelect.php");?>
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