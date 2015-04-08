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
		print("<div data-role='collapsibleset' date-theme='a' data-inset='true'>
				<div data-role='collapsible' data-theme='a' data-content-theme='a'>
					<h2>系统管理</h2>
					<ul data-role='listview'>
						<li><a href='index.php?action=user_manage'>管理用户</a></li>
						<li><a href='?action=department'>管理部门</a></li>
					</ul>
				</div>
				<div data-role='collapsible' data-theme='a' data-content-theme='a'>
					<h2>消息管理</h2>
					<ul data-role='listview'>
						<li><a href='index.html'>消息管理</a></li>
						<li><a href='index.html'>发布消息</a></li>
					</ul>
				</div>
			</div>");
	} else {
		print("<ul data-role='listview' data-inset='true'>
				<li><a href='#'>查看消息</a></li>
				<li><a href='#'>发布消息</a></li>
			</ul>");
	}
}

function show_userlist(){
	print("userlist");
}

/***************************** 部门管理页 *********************************/
function show_departments(){
	require_once("department_class.php");
	print("<a data-rel='dialog' data-transition='pop' href='index.php?action=add_department'>添加部门</a><br/><br/>");

	$dp = new department;
	$arr_result = $dp -> query_all();
	print("<ul data-role='listview'>");
	foreach ($arr_result as $item) {
		print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_details&id=" .$item->id. "'>".$item->department_name."</a></li>");
	}

	print("</ul>");

}

/*添加部门表单显示*/
function show_one_department($id){
	$name = "";
	$id = trim($id);
	if (empty($id)) { echo "发生错误！";exit;};
	if ($id != -1){
		require_once("department_class.php");
		$dp = new department;
		$dp -> __set(id, $id);
		$one_result = $dp -> query_one();

		$name = $one_result->department_name;
		print("<a rel=\"external\" href=\"javascript:deleteEntry_department($id)\">删除</a>");
	}
	print("<form action='index.php' method='post' rel='external' onsubmit='return checkForm();'>
			<input type='hidden' name='action' value='upsert'>
			<input type='hidden' name='id' value='".$id."'>
			<div class='ui-field-contain'>
				<label for='department-1'>部  门：</label>
				<input type='text' id='department-1' name='department' placeholder='部门名称' value='".$name."'>
			</div>
			<button type='submit' value='Save'>保 存</button>
		</form>\n");
}

/* 添加部门 */
function add_department($name){
		require_once("department_class.php");
		$dp = new department;
		$dp -> __set(department_name, $name);
		$dp -> add_new();
}

/* 编辑部门 */
function update_department($id, $name){
		require_once("department_class.php");
		$dp = new department;
		$dp -> __set(id, $id);
		$dp -> __set(department_name, $name);
		$dp -> update();
}

/* 删除部门 */

function kill_department($id){
		require_once("department_class.php");
		$dp = new department;
		$dp -> __set(id, $id);
		$dp -> delete();
}

/********************用户管理页 ******************************/
function show_users(){
	require_once("user_class.php");
	print("<a data-rel='dialog' data-transition='pop' href='index.php?action=add_user'>添加用户</a><br/><br/>");

	$dp = new user;
	$arr_result = $dp -> query_all();
	print("<ul data-role='listview'>");
	foreach ($arr_result as $item) {
		print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_users&id=" .$item->user_id. "'>".$item->username."</a></li>");
	}

	print("</ul>");

}

/*添加用户表单显示*/
function show_one_user($id){
	$name = "";
	$id = trim($id);
	if (empty($id)) { echo "发生错误！";exit;};
	require_once("department_class.php");
	/* 部门初始化*/ 
	$dp = new department;
	$arr_results = $dp -> query_all();
	// echo "<pre>";
	// print_r($arr_results);
	// echo "</pre>";
	// exit;
	/* init department_id*/
	$department_id = 0;
	if ($id != -1){
		require_once("user_class.php");
		$user = new user;
		$user -> __set(id, $id);
		$one_result = $user -> query_one();

		$username = $one_result->user_name;
		$password = $one_result->password;
		$mobile = $one_result->mobile;
		$department_id = $one_result->department_id;

		print("<a rel=\"external\" href=\"javascript:deleteEntry_user($id)\">删除</a>");
	}
	print("<form action='index.php' method='post' rel='external' onsubmit='return checkForm();'>
			<input type='hidden' name='action' value='upsert_user'>
			<input type='hidden' name='id' value='".$id."'>
			<fieldset>
			<div class='ui-field-contain'>
				<label for='username'>用户名：</label>
				<input type='text' id='username' name='username' placeholder='用户名' value='".$username."'>
			</div>
			<div class='ui-field-contain'>
				<label for='password'>密  码：</label>
				<input type='text' id='password' name='password' placeholder='密  码' value='".$password."'>
			</div>

				<fieldset data-role='controlgroup'>
					<legend>性  别:</legend>
					<input type='radio' name='sex' id='radio-choice-1' value='1' checked='checked'>
					<label for='radio-choice-1'>男</label>
					<input type='radio' name='sex' id='radio-choice-2' value='0'>
					<label for='radio-choice-2'>女</label>
				</fieldset>

			<div class='ui-field-contain'>
				<label for='mobile'>手  机：</label>
				<input type='text' id='moblie' name='mobile' placeholder='手机号码' value='".$mobile."'>
			</div>
			
			<label for='select-choice-1' class='select'>部  门</label>
			<select name='department' id='select-choice-1'>");
	foreach ($arr_results as $item){
		print("<option ");
		if ($item->id == $department_id) {
			print("selected='selected'");
		}
		print(">" .$item->department_name);
		print("</option>");

	}

	print("
			</select>

			</fieldset>
			<button type='submit' value='Save'>保 存</button>
		</form>\n");
}



?>