<?php
function show_menu($username){
	require_once("user_class.php");
	$user = new user;
	$user->__set(username, $username);
	$user = $user->query_one();
	// print("<pre>");
	// print_r($user);
	// print("</pre>");
	// exit;
	$group = $user->group_name;
	$position = $user->position_name;
	$mark = $user->mark;
	
	print($username . $position . "您好!");
	if ($mark == 1){
		print("<ul data-role='listview' data-inset='true'>
				<li><a href='?action=show_userlist'>
				<img src='img/album-bb.jpg'>
				<h2>系统管理</h2>
				<p>添加，删除，修改用户，用户分组，用户职位。</p></a>
				</li>
				<li><a href='#'>
				<img src='img/album-hc.jpg'>
				<h2>消息发布</h2>
				<p>消息发布，对特定的组发布消息</p></a>
				</li>
			</ul>");
	} else {
		print '<ul data-role="listview" data-inset="true">
				<li><a href="#">
				<img src="img/album-bb.jpg">
				<h2>消息</h2>
				<p>查看，回复消息</p></a>
				</li>
			</ul>';
	}
}

function show_userlist(){
	print("userlist");
}

?>