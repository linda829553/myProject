<?php
	//����Category��
	include_once("CategoryClass.php");

	//ʹ��Category��InitData()�����õ����ķ�����Ϣ
	$cat=new Category();
	$cat->InitData();

	//ѭ�����������Ϣ���γ�������
	echo "<select name=CategorySelect>";
	foreach($cat->mInforArray as $item)
	{
		echo "<option value=".$item->CategoryId.">".$item->CategoryName."</option>";
	}
	echo "</select>"
?>