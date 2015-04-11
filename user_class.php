<?php
	require_once("class_database.php");
	class user
	{
		private $user_id;
		private $username;
		private $password;
		private $department_id;
		private $position_name;
		private $sex;
		private $mobile;
		private $remark;

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

 		function queryRows(){
 			$sql="SELECT * FROM user ";
 			$sql.="where username='$this->username' and password='$this->password'";
            // echo $sql;
 			$db=new database;
 			$rows=$db->queryRows($sql);
 			$db=mull;
 			return $rows;
 		}

 		function query_all(){
 			$sql="SELECT * FROM user ";
 			$db=new database;
 			$user=$db->query($sql);
 			$db=null;
 			return $user;
 		}

 		function queryId(){
 			$sql="SELECT user_id FROM user ";
 			$sql.="where username='$this->username'";
 			$db=new database;
            // echo $sql;
 			$user_id=$db->executeSFOR($sql);
 			$db=null;
 			return $user_id->user_id;

 		}

 		function add_new(){
 			$sql="INSERT INTO user (username, password, department_id, position_name, sex, mobile, remark)";
 			$sql.=" VALUES('$this->username', '$this->password', $this->department_id, '$this->position_name', 
 				$this->sex, '$this->mobile', '$this->remark')";
            // echo $sql;
 			$db=new database;
 			$db->execute($sql);
 			$db=null;
 		}

 		function query_one($condition){
 			if (($condition=="") || ($condition==NULL)) $condition="";
 			else $condition="where ".$condition;
 			$sql = "SELECT * FROM user ". $condition;
 			// echo $sql.'show_menu';
 			// exit;
 			$db = new database;
 			$line = $db -> executeSFOR($sql);
 			return $line;
 		}

 		function query_id_mark(){
 			$sql="SELECT * FROM user ";
 			$sql.="where username='$this->username' and password='$this->password'";
            // echo $sql;
 			$db=new database;
 			$rows=$db->executeSFOR($sql);
 			$db=mull;
 			return $rows;
 		}

 		function update_user(){
 			$sql="UPDATE user  SET username='$this->username', password='$this->password', department_id=$this->department_id, 
 			position_name='$this->position_name', sex=$this->sex, mobile='$this->mobile', remark='$this->remark'";
 			$sql.=" WHERE user_id=$this->user_id";
            // echo $sql;
 			$db=new database;
 			$db->execute($sql);
 			$db=null;
 		}

 		function delete(){
 			$sql="DELETE FROM user";
 			$sql.=" WHERE user_id=$this->user_id";
            // echo $sql;
 			$db=new database;
 			$db->execute($sql);
 			$db=null;
 		}

 		// function is_a_repeat_name(){
 		// 	$rows = self::queryRows();
 		// 	if ($rows != 0) {
 		// 		return $rows;
 		// 	}
 		// }
	}
?>