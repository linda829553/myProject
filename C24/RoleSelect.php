<!--RoleSelect.php:�û���ɫ������--------------->
<?php
	include_once("RoleClass.php");
	
	//����Role���InitData()��ȡ�û���ɫ��Ϣ
	$Role=new Role();
	$Role->InitData();

	//ѭ�����û���ɫд��������ѡ����
	echo "<select name=RoleSelect>";
	foreach($Role->mInforArray as $item)
	{
		echo "<option value=".$item->RoleId.">".$item->RoleName."</option>";
	}
	echo "</select>"
?>