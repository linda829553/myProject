<?php
	require_once("msg_class.php");
	$depart_id = $_POST['department_id'];

	$msg = new message;
	$arr_result = $msg -> query_by_date_depart($depart_id);
	date_default_timezone_set("Asia/Shanghai");
	foreach ($arr_result as $item) {
		print("<li data-role='list-divider'>$item->days<span class='ui-li-count'>$item->COUNT</span></li>");
		$arr_day_result = $msg -> query_one_date_depart($depart_id, $item->days);
		foreach ($arr_day_result as $item2) {
			$depart_name = $msg->get_departname($item2->depart_id);
			if (empty($depart_name)) {$depart_name = '全部';}
			print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_one_msg&id=" .$item2->id. "'>
							<p>".$depart_name."</p>
							<h3>".$item2->content."</h3>						
							<p class='ui-li-aside'><strong>".date('h:i:sA', $item2->post_time)."</strong></p>
							</a></li>");
		}
			
	}

	


?>