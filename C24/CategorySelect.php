<?php
	//包含Category类
	include_once("CategoryClass.php");

	//使用Category的InitData()方法得到公文分类信息
	$cat=new Category();
	$cat->InitData();

	//循环输出分类信息，形成下拉框
	echo "<select name=CategorySelect>";
	foreach($cat->mInforArray as $item)
	{
		echo "<option value=".$item->CategoryId.">".$item->CategoryName."</option>";
	}
	echo "</select>"
?>