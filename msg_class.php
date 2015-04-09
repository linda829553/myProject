<?php
require_once("class_database.php");
class message
{
	private $id;
	private $content;
	private $post_time;
	private $depart_id;
	private $user_id;
	private $parent_id;

// 方法
// __get(): 获取属性值
	function __get($property_name){
		if (isset($property_name)){
			return $this->$property_name;		// 这里的 property_name 前必须加 $
		}else{
			return null;
		}

	}

	// __set(): 设置属性值
	function __set($property_name, $value){
		$this->$property_name=$value;			// 这里的 property_name 前必须加 $
	}

	
}

?>