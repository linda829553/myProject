<?php
require_once("class_database.php");
require_once("department_class.php");
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



	function query_all(){
		$sql="SELECT * FROM message ORDER BY post_time DESC";
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}



	function add_new(){
		//		id	content	post_time	depart_id	user_id	parent_id
		$sql="INSERT INTO message (content, post_time, depart_id, user_id)";
		$sql.=" VALUES('$this->content', $this->post_time, $this->depart_id, $this->user_id)";
    	// echo $sql;
    	// exit;
		$db=new database;
		$db->execute($sql);
		$db=null;
	}

	function query_one($condition){
		if (($condition=="") || ($condition==NULL)) $condition="";
		else $condition="where ".$condition;
		$sql = "SELECT * FROM message ". $condition;
		$db = new database;
		$line = $db -> executeSFOR($sql);
		return $line;
	}

	function query_by_date(){
		$sql="SELECT FROM_UNIXTIME(post_time,'%c月%d日') days,COUNT(id) COUNT FROM message GROUP BY days DESC";
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	function query_one_date($days){
		$sql="SELECT * FROM message WHERE FROM_UNIXTIME(post_time,'%c月%d日') ='".$days."' ORDER BY post_time DESC";
		// echo $sql;
		// exit;
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	function update(){
		// id	content	post_time	depart_id	user_id	parent_id
		$sql="UPDATE message  SET content='$this->content', post_time=$this->post_time, depart_id=$this->depart_id, user_id=$this->user_id";
		$sql.=" WHERE id=$this->id";
    // echo $sql;
		$db=new database;
		$db->execute($sql);
		$db=null;
	}

	function delete(){
		$sql="DELETE FROM message";
		$sql.=" WHERE id=$this->id";
    // echo $sql;
		$db=new database;
		$db->execute($sql);
		$db=null;
	}

	function get_departname($id){
		$dp = new department;
		$dp -> __set(id, $id);
		$one_result = $dp ->query_one();
		return $one_result->department_name;
	}
}

?>