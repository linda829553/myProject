<?php
	require_once("msg_class.php");
	require_once("department_class.php");
	$depart_id = $_POST['department_id'];

	$msg = new message;
	$msg -> __set(depart_id, $depart_id);
	$arr_depart_result = $msg -> query_by_depart();
	date_default_timezone_set("Asia/Shanghai");
	foreach ($arr_depart_result as $item2) {
		print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_one_msg&id=" .$item2->id. "'>
							<p>".$msg->get_departname($item2->depart_id)."</p>
							<h3>".$item2->content."</h3>						
							<p class='ui-li-aside'><strong>".date('h:i:sA', $item2->post_time)."</strong></p>
							</a></li>");
	}
	


?>