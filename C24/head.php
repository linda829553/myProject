<?php session_start();?>

<div align=center>
<img src="images/logo.gif" width="50" >
<a href=Index.php>|��ҳ|</a>

<?php
	//����û�δ��¼��ת����¼ҳ��
	if(!isset($_SESSION["ss_user_id"]))
	{
		echo "<script language='javascript'>";
		echo " alert('���ȵ�¼');";
		echo " location='Login.php';";
		echo "</script>";
	}
	//����û��Ѿ���¼��������Ȩ����ʾϵͳ����
	else
	{
		include_once("UserClass.php");
		$user=new User();
		$user->InitDataByUserId($_SESSION["ss_user_id"]);
	
		if($user->mPrivilegeInfoArray[0]->RoleName=="δ��Ȩ��ɫ")
		{
			echo "<a href=FileKeyWordsQueryView.php>|���˰칫|</a>";
			echo "<a href=UserView.php>|�û�����|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|������Ϣ|</a>";
			echo "<a href=LogView.php>|��־����|</a>";
			echo "<a href=Exit.php>|�˳�ϵͳ|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="��ͨԱ��")
		{
			echo "<a href=FileKeyWordsQueryView.php>|���˰칫|</a>";
			echo "<a href=UserView.php>|�û�����|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|������Ϣ|</a>";
			echo "<a href=LogView.php>|��־����|</a>";
			echo "<a href=Exit.php>|�˳�ϵͳ|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="������")
		{
			echo "<a href=FileKeyWordsQueryView.php>|���˰칫|</a>";
			echo "<a href=UserView.php>|�û�����|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|������Ϣ|</a>";
			echo "<a href=LogView.php>|��־����|</a>";
			echo "<a href=Exit.php>|�˳�ϵͳ|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="ϵͳ����Ա")
		{
			echo "<a href=FileKeyWordsQueryView.php>|���˰칫|</a>";
			echo "<a href=UserView.php>|�û�����|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|������Ϣ|</a>";
			echo "<a href=LogView.php>|��־����|</a>";
			echo "<a href=Exit.php>|�˳�ϵͳ|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="ϵͳ����")
		{
			echo "<a href=FileKeyWordsQueryView.php>|���˰칫|</a>";
			echo "<a href=UserView.php>|�û�����|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|������Ϣ|</a>";
			echo "<a href=LogView.php>|��־����|</a>";
			echo "<a href=Exit.php>|�˳�ϵͳ|</a>";
		}
	}
?>

</div>
<hr><hr>