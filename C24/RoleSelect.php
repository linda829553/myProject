<!--RoleSelect.php:用户角色下拉框--------------->
<?php
	include_once("RoleClass.php");
	
	//利用Role类的InitData()读取用户角色信息
	$Role=new Role();
	$Role->InitData();

	//循环将用户角色写入下拉框选项中
	echo "<select name=RoleSelect>";
	foreach($Role->mInforArray as $item)
	{
		echo "<option value=".$item->RoleId.">".$item->RoleName."</option>";
	}
	echo "</select>"
?>