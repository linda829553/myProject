<?php
	require_once('connect.php');
	$page = intval($_POST["pageNo"]);     // 当前页
	// $page = 1;

	$result = mysql_query("SELECT id from message");
	$total = mysql_num_rows($result);        // 总记录数

	$pageSize = 3;    
	$totalPage = ceil($total/$pageSize);  // 总页数

	$startPage = $page * $pageSize;       // 开始记录

	// 构造数组
	$arr["totalPage"] = $totalPage;
	$arr["currentPageNo"] = $page + 1;
	$query = mysql_query("SELECT FROM_UNIXTIME(post_time,'%c月%d日') days,COUNT(id) COUNT FROM message GROUP BY days DESC LIMIT $startPage, $pageSize");
	
	while ($row = mysql_fetch_array($query)) {
		$arr['list'][] = array(
			'days' => urlencode($row['days']),
			'count' => $row['COUNT']
		);
		$query2 = mysql_query("SELECT message.id, content, FROM_UNIXTIME( post_time, '%c月%d日' ) days, department_name, post_time FROM  message, department
                WHERE message.depart_id = department.id and FROM_UNIXTIME(post_time,'%c月%d日') ='".$row['days']."' ORDER BY post_time DESC");
		while ($row2 = mysql_fetch_array($query2)) {
			$arr[urlencode($row2['days'])][] = array(
				'id' => intval($row2['id']),
				'depart_name' => urlencode($row2['department_name']),
				'content' => urlencode($row2['content']),
				'time' => date('h:i:sA', $row2['post_time'])
			);
		}

	}

	// function my_json_encode($var) {
 //    	return preg_replace("/u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($var));
	// }


	// echo json_encode($arr);
	// echo my_json_encode($arr);
	echo urldecode(json_encode($arr));


?>