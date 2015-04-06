<?php
// print_r($_POST);
// exit;
require_once("class_database.php");
header("Content-Type: text/html; charset=utf-8");
$username = $_POST["username"];
$password = $_POST["password"];

// print $username . " / " . $password;
if (!isset($username) and !isset($password)){
	echo "请输入你的用户名，密码！";
	exit;
}
$db = new database;
$sql = "INSERT INTO user (username, password)";
$sql .= "VALUES ($username, $password)";
$db->execute($sql);
$db = NULL;


	
?>