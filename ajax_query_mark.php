<?php
	require_once("user_class.php");
    $user_id = $_POST['user_id'];

    $user = new user;
    $row = $user->query_one("user_id='".$user_id."'");
	echo $row -> mark;  
?>