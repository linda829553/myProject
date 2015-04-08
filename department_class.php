<?php
	require_once("class_database.php");
	class department{
		private $id;
		private $department_name;

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

 		// __construct : 构造函数
 		function __construct(){

 		}

 		// __destruct : 析构函数
 		function __destruct(){

 		}

 		function query_all(){
 			$sql="SELECT * FROM department";
 			$db=new database;
 			$department=$db->query($sql);
 			$db=null;
 			return $department;
 		}


 		function add_new(){
 			$sql="INSERT INTO department (department_name)";
 			$sql.=" VALUES('$this->department_name')";
            // echo $sql;
 			$db=new database;
 			$db->execute($sql);
 			$db=null;
 		}

 		function query_one(){
 			$sql = "SELECT * FROM department ";
 			$sql .= "WHERE id='$this->id'";
 			$db = new database;
 			$line = $db -> executeSFOR($sql);
 			return $line;
 		}

 		function update(){
 			$sql = "UPDATE department SET department_name='$this->department_name'";
 			$sql .= " WHERE id=$this->id";
 			$db = new database;
 			$db->execute($sql);
 			$db=NULL;
 		}

 		function delete(){
 			$sql = "DELETE FROM department WHERE id=$this->id";
 			$db = new database;
 			$db->execute($sql);
 			$db=NULL;
 		}

	}
?>