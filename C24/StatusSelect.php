<!--StatusSelect.php:公文状态下拉框------------------->
<?php
	include_once("StatusClass.php");
	
	//利用Status类的InitData()方法获取公文状态数据 
	$status=new Status();
	$status->InitData();

	//循环将公文状态写入下拉框选项中
	echo "<select name=StatusSelect>";
	foreach($status->mInforArray as $item)
	{
		echo "<option value=".$item->StatusId.">".$item->StatusDesc."</option>";
	}
	echo "</select>"
?>