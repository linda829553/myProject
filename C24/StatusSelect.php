<!--StatusSelect.php:����״̬������------------------->
<?php
	include_once("StatusClass.php");
	
	//����Status���InitData()������ȡ����״̬���� 
	$status=new Status();
	$status->InitData();

	//ѭ��������״̬д��������ѡ����
	echo "<select name=StatusSelect>";
	foreach($status->mInforArray as $item)
	{
		echo "<option value=".$item->StatusId.">".$item->StatusDesc."</option>";
	}
	echo "</select>"
?>