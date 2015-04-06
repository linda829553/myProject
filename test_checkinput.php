<?php
header("Content-Type: text/html; charset=utf-8");
require("base_func.php");

$username = "jiajia";
$password = "123456";

echo checkinput($username, 6, "用户名");
echo checkinput($password, 8, "密码");
?>