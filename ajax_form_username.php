<?php  
	require_once("user_class.php");
    $username = $_REQUEST['username'];  
    $user_id = $_REQUEST['user_id'];
    // echo $username;
    // echo $user_id;
    // exit;

    $user = new user;
    $user -> __set(username, $username);
    $rows = $user->queryRowsOfUsername();
    if ($user_id == -1) {
    	if ($rows != 0) { 
    		echo $rows;
    	}
    }        
?>  
