<?php
// checkinput
function checkinput($str, $len, $msg){
	$isValid = true;
 	  if(strlen($str) < $len ||strlen($str) >30){
          echo "<script>alert('你输入的 ". $msg ." 不能少于 " . $len . " 个字符');</script>";
 	  	$isValid = false;
 	  }else{
 	  	return mysql_escape_string($str);

 	  }

 	  if (!$isValid){
 	  	echo "<script>location.href='login.php';</script>";
 	  }
}
?>