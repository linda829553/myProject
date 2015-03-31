<?php
// print_r($_POST);
// exit;
header("Content-Type: text/html; charset=utf-8");
$username = $_POST["username"];
$password = $_POST["password"];

// print $username . " / " . $password;
if (!isset($username) and !isset($password)){
	echo "请输入你的用户名，密码！";
	exit;
}
	
?>