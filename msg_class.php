<?php
require_once("class_database.php");
// require_once("department_class.php");
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
		$sql="SELECT FROM_UNIXTIME(post_time,'%c月%d日') days,COUNT(id) COUNT FROM message GROUP BY days DESC LIMIT 3";
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

	function query_by_date_user($username){
		$sql = "SELECT FROM_UNIXTIME(post_time,'%c月%d日') days,COUNT(id) COUNT FROM message ,user";
		$sql .= " WHERE (message.depart_id=user.department_id or depart_id=-1) and user.username='$username'";
		$sql .= " GROUP BY days DESC";
		// echo $sql. "111111111111";
		// exit;
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	function query_one_date_user($username, $days){
		$sql = "SELECT * FROM message, user";
		$sql .= " WHERE FROM_UNIXTIME(post_time,'%c月%d日') ='$days'";
		$sql .= " AND (message.depart_id=user.department_id or depart_id=-1) and user.username='$username'";
		$sql .= " ORDER BY post_time DESC";
		// echo $sql. "222222222222";
		// exit;
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	/* 根据部门查询日期分组显示*/
	function query_by_date_depart($depart_id){
		$sql="SELECT FROM_UNIXTIME(post_time,'%c月%d日') days,COUNT(id) COUNT FROM message";
		$sql .= " WHERE depart_id=$depart_id";
		$sql .= " GROUP BY days DESC";
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	function query_one_date_depart($depart_id, $days){
		$sql="SELECT * FROM message";
		$sql .= " WHERE FROM_UNIXTIME(post_time,'%c月%d日') ='".$days."' AND depart_id=$depart_id";
		$sql .= " ORDER BY post_time DESC";
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
		$sql="SELECT department_name FROM department WHERE id=".$id;
		$db=new database;
		$msg=$db->executeSFOR($sql);
		$db=null;
		return $msg->department_name;
	}

	function query_by_depart(){
		$sql="SELECT * FROM message WHERE depart_id=$this->depart_id";
		$sql .= " ORDER BY post_time DESC";
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	function query_by_username($username){
		$sql="SELECT * FROM message, user WHERE ";
		$sql .= "message.depart_id=user.department_id and user.username=".$username;
		$sql .= " ORDER BY post_time DESC";
		// echo $sql;
		// exit;
		$db=new database;
		$msg=$db->query($sql);
		$db=null;
		return $msg;
	}

	function query_all_departs(){
		$sql="SELECT * FROM department";
		$db=new database;
		$arr_dps=$db->query($sql);
		$db=null;
		return $arr_dps;
	}
}

?>