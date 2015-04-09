<?php  
	require_once("user_class.php");
    $username = $_POST['username'];  
    $user_id = $_POST['user_id'];

    $user = new user;
    $user -> __set(username, $username);
    $rows = $user->queryRows();
    if ($user_id == -1) {
    	if ($rows != 0) { 
    		echo $rows;
    	}
    }        
?>  
