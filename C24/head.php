<?php session_start();?>

<div align=center>
<img src="images/logo.gif" width="50" >
<a href=Index.php>|首页|</a>

<?php
	//如果用户未登录，转到登录页面
	if(!isset($_SESSION["ss_user_id"]))
	{
		echo "<script language='javascript'>";
		echo " alert('请先登录');";
		echo " location='Login.php';";
		echo "</script>";
	}
	//如果用户已经登录，根据其权限显示系统功能
	else
	{
		include_once("UserClass.php");
		$user=new User();
		$user->InitDataByUserId($_SESSION["ss_user_id"]);
	
		if($user->mPrivilegeInfoArray[0]->RoleName=="未授权角色")
		{
			echo "<a href=FileKeyWordsQueryView.php>|个人办公|</a>";
			echo "<a href=UserView.php>|用户管理|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|公共信息|</a>";
			echo "<a href=LogView.php>|日志管理|</a>";
			echo "<a href=Exit.php>|退出系统|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="普通员工")
		{
			echo "<a href=FileKeyWordsQueryView.php>|个人办公|</a>";
			echo "<a href=UserView.php>|用户管理|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|公共信息|</a>";
			echo "<a href=LogView.php>|日志管理|</a>";
			echo "<a href=Exit.php>|退出系统|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="管理者")
		{
			echo "<a href=FileKeyWordsQueryView.php>|个人办公|</a>";
			echo "<a href=UserView.php>|用户管理|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|公共信息|</a>";
			echo "<a href=LogView.php>|日志管理|</a>";
			echo "<a href=Exit.php>|退出系统|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="系统管理员")
		{
			echo "<a href=FileKeyWordsQueryView.php>|个人办公|</a>";
			echo "<a href=UserView.php>|用户管理|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|公共信息|</a>";
			echo "<a href=LogView.php>|日志管理|</a>";
			echo "<a href=Exit.php>|退出系统|</a>";
		}
		
		if($user->mPrivilegeInfoArray[0]->RoleName=="系统秘书")
		{
			echo "<a href=FileKeyWordsQueryView.php>|个人办公|</a>";
			echo "<a href=UserView.php>|用户管理|</a>";
			echo "<a href=PublicMessageKeyWordsQueryView.php>|公共信息|</a>";
			echo "<a href=LogView.php>|日志管理|</a>";
			echo "<a href=Exit.php>|退出系统|</a>";
		}
	}
?>

</div>
<hr><hr>