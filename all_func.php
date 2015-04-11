<?php
function show_menu($username){
	require_once("user_class.php");
	$user = new user;
	// $user->__set(username, $username);
	$one_result = $user->query_one("username='$username'");
	// print("<pre>");
	// print_r($user);
	// print("</pre>");
	// exit;
	$group = $one_result->group_name;
	$position = $one_result->position_name;
	$mark = $one_result->mark;

	
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
			</div>
			<ul data-role='listview' data-inset='true'>
				<li><a href='index.php?action=msg_manage'>消息管理</a></li>
			</ul>");
	// } else {
	// 	print("<ul data-role='listview' data-inset='true'>
	// 			<li><a href='#'>查看消息</a></li>
	// 		</ul>");
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
		print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_one_user&id=" .$item->user_id. "'>".$item->username."</a></li>");
	}

	print("</ul>");

}

/*添加用户表单显示*/
function show_one_user($id){
	$name = "";
	$id = trim($id);
	$sex = 1;
	if (empty($id)) { echo "发生错误！";exit;};

	// echo $id . "---------------";
	// exit;
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
		// echo $id . "---------------if";
		// exit;
		require_once("user_class.php");
		$user = new user;
		// $user -> __set(user_id, $id);
		$one_result = $user -> query_one("user_id=$id");
		// echo "<pre>";
		// print_r($one_result);
		// echo "</pre>";
		// exit;
		$username = $one_result->username;
		$password = $one_result->password;
		$mobile = $one_result->mobile;
		$department_id = $one_result->department_id;
		$sex = $one_result->sex;
		$position = $one_result->position_name;
		$remark = $one_result->remark;

		print("<a rel=\"external\" href=\"javascript:deleteEntry_user($id)\">删除</a>");
	}
	print("<form action='index.php' id='AjaxForm1' method='post' rel='external'>
			<input type='hidden' name='action' value='upsert_user'>
			<input type='hidden' name='id' id='user_id' value='".$id."'>
			<input type='hidden' name='department_id'  value='".$department_id."'>
			<fieldset>
			<div class='ui-field-contain'>
				<label for='username' id='hint'>用户名：</label>
				<input type='text' id='username' name='username' placeholder='用户名' value='".$username."'>
			</div>
			<div class='ui-field-contain'>
				<label for='password'>密  码：</label>
				<input type='text' id='password' name='password' placeholder='密  码' value='".$password."'>
			</div>

				<fieldset data-role='controlgroup' data-type='horizontal'>
					<legend>性  别:</legend>
					<input type='radio' name='sex' id='radio-choice-1' value='1' ");
	if ($sex == 1) {print("checked='checked'");}
	print(">
					<label for='radio-choice-1'>男</label>
					<input type='radio' name='sex' id='radio-choice-2' value='0' ");
	if ($sex == 0) {print("checked='checked'");}
	print(">
					<label for='radio-choice-2'>女</label>
				</fieldset>

			<div class='ui-field-contain'>
				<label for='mobile'>手  机：</label>
				<input type='text' id='moblie' name='mobile' placeholder='手机号码' value='".$mobile."'>
			</div>
			
			<label for='select-department' class='select'>部  门</label>
			<select name='department_id' id='select-department'>
			<option value='-1'>-请选择-</option>");
	foreach ($arr_results as $item){
		print("<option value='".$item->id."'");
		if ($item->id == $department_id) {
			print("selected='selected'");
		}
		print(">" .$item->department_name);
		print("</option>");

	}

	print("
			</select>

			<div class='ui-field-contain'>
				<label for='position'>职  位：</label>
				<input type='text' id='position' name='position' placeholder='职位信息' value='".$position."'>
			</div>

			<div class='ui-field-contain'>
				<label for='remark'>备  注：</label>
				<input type='text' id='remark' name='remark' placeholder='备注信息' value='".$remark."'>
			</div>

			</fieldset>
			<button type='submit' id='submit2' value='Save'>保 存</button>
		</form>\n");
	print("
		<script>
			$(document).ready(function() {  
					    $('#submit2').click(function(){  

						    try {
								if ($.trim($('#username').val()) == '') {
									alert('请填写用户名称!');
									return false;
								} else if ($.trim($('#password').val()) == '') {
									alert('请填写用户密码!');
									return false;
								} 
							} catch (e) {
								alert(e);
								return false;
							}

							function onSuccess(data, status)  
					        {  
					            data = $.trim(data); 
					            if (data) {
					            	if (!$('#hint b').length) {
										$('#hint').append('<b style=color:red>重</b>');
					            	}
									
					            } else {
					 				$('#AjaxForm1').submit();
					            }
					            
					        }  
					    
					        function onError(data, status)  
					        {  
					            // handle an error  
					        }       

					        var formData = 'username=' + $('#AjaxForm1 #username').val() + '&'
					        			   + 'user_id=' + $('#user_id').val();  

					        $.ajax({  
					            type: 'POST',  
					            url: 'ajax_form_username.php',  
					            cache: false,  
					            data: formData,
					            success: onSuccess,  
					            error: onError  
					        });

							return false;

							

					    });  
					});  
		</script>
		
	");
}


/* 添加用户 */
function add_user($name, $password, $department_id, $position, $sex, $mobile, $remark){
		require_once("user_class.php");
		$user = new user;
		$user -> __set(username, $name);
		$user -> __set(password, $password);
		$user -> __set(department_id, $department_id);
		$user -> __set(position_name, $position);
		$user -> __set(sex, $sex);
		$user -> __set(mobile, $mobile);
		$user -> __set(remark, $remark);
		$user -> add_new();
}

/* 编辑用户 */
function update_user($id, $name, $password, $department_id, $position, $sex, $mobile, $remark){
		require_once("user_class.php");
		$user = new user;
		$user -> __set(user_id, $id);
		$user -> __set(username, $name);
		$user -> __set(password, $password);
		$user -> __set(department_id, $department_id);
		$user -> __set(position_name, $position);
		$user -> __set(sex, $sex);
		$user -> __set(mobile, $mobile);
		$user -> __set(remark, $remark);
		$user -> update_user();
}

/* 删除用户 */

function kill_user($id){
		require_once("user_class.php");
		$user = new user;
		$user -> __set(user_id, $id);
		$user -> delete();
}

/******************************* 消息管理 *****************************************/

// function show_messages(){
// 	require_once("msg_class.php");
// 	print("<a data-rel='dialog' data-transition='pop' href='index.php?action=add_msg'>发布消息</a><br/><br/>");
// 	// <p>Hey Stephen, if you're available at 10am tomorrow, we've got a meeting with the jQuery team.</p>
// 	// <p class="ui-li-aside"><strong>6:24</strong>PM</p>
// 	$msg = new message;
// 	$arr_result = $msg -> query_all();
// 	print("<ul data-role='listview'>");
// 	foreach ($arr_result as $item) {
// 		print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_one_msg&id=" .$item->id. "'>
// 			<h3>".$item->content."</h3>
// 			<p class='ui-li-aside'><strong>6:24</strong>PM</p>
// 			</a></li>");
// 	}

// 	print("</ul>");
// }

function show_messages(){
	require_once("msg_class.php");
	$msg = new message;
	$arr_departs = $msg -> query_all_departs();
	print("<form action='index.php' id='AjaxForm_depart' method='post' rel='external' data-ajax='false' onsubmit='return post_response();'>
			<div class='ui-grid-a'>
				<div class='ui-block-a'>
				<select name='department_id' id='select-department'>
				<option value='-1'>-请选择部门-</option>");

				foreach ($arr_departs as $dp_item) {
					print("<option value='".$dp_item->id."'");
					print(">" .$dp_item->department_name);
					print("</option>");
				}

				print("
				</select>
				</div>
			
				<div class='ui-block-b'>
					<button type='submit' id='submit_select_menu' value='Save'>查 询</button>
				</div>
			</div>
		</form>\n");

	print("<a data-rel='dialog' data-transition='pop' href='index.php?action=add_msg'>发布消息</a><br/>");
	// <p>Hey Stephen, if you're available at 10am tomorrow, we've got a meeting with the jQuery team.</p>
	// <p class="ui-li-aside"><strong>6:24</strong>PM</p>

	$arr_result = $msg -> query_by_date();
	print("<ul id='list_date' data-role='listview' data-inset='true'>");
	date_default_timezone_set("Asia/Shanghai");
	foreach ($arr_result as $item) {
		print("<li data-role='list-divider'>$item->days<span class='ui-li-count'>$item->COUNT</span></li>");
		$arr_day_result = $msg -> query_one_date($item->days);
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

	print("</ul>");
	print("
		<script>
			// 内联页面强制刷新
			// $.mobile.changePage(page1, {
			//  'reloadPage' : true,
			// });

			function post_response(){
				// alert('改变了');
				// $('#list_date').html('<li></li>');
				function onSuccess(data, status)  
		        {  
		            data = $.trim(data); 
		            // alert(data);
		            // return;
		            if (data) {
		            	$('#list_date').html(data).listview('refresh');
		            	// alert();
		            	// $('#list_data').trigger('create');
		            	// $('#list_data').listview();
		            	// $('#list_data').listview('refresh');

		            }
		            
		        }  
		    
		        function onError(data, status)  
		        {  
		            // handle an error  
		        }       

		        var formData = $('#AjaxForm_depart').serialize();
				// alert(formData);
		        $.ajax({  
		            type: 'POST',  
		            url: 'ajax_select_depart.php',  
		            cache: false,  
		            data: formData,
		            success: onSuccess,  
		            error: onError  
		        });

				return false;
			}
			
			$(document).ready(function() {  
				/* change 事件不成功的时候，可以提交*/
				// $('#submit_select_menu').click(function(){
				// 	alert(222222);
				// 	 	post_response();
				// });
			    $('#select-department').change(function(){  
						post_response();

			    });  
			});  
		</script>
		
	");
}

/* 显示普通用户登录后的页面------------------------因为和管理员的信息管理页面比较类似就写到这里了*/
function show_user_msg($username){
	require_once("msg_class.php");
	$msg = new message;
	// $arr_depart_result = $msg -> query_by_username($username);
	// date_default_timezone_set("Asia/Shanghai");
	// print("<ul id='list_date' data-role='listview' data-inset='true'>");
	// foreach ($arr_depart_result as $item2) {
	// 	print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_one_msg&id=" .$item2->id. "'>
	// 						<p>".$msg->get_departname($item2->depart_id)."</p>
	// 						<h3>".$item2->content."</h3>						
	// 						<p class='ui-li-aside'><strong>".date('h:i:sA', $item2->post_time)."</strong></p>
	// 						</a></li>");
	// }
	// print("</ul>");

	$arr_result = $msg -> query_by_date_user($username);
	print("<ul id='list_date' data-role='listview' data-inset='true'>");
	date_default_timezone_set("Asia/Shanghai");
	foreach ($arr_result as $item) {
		print("<li data-role='list-divider'>$item->days<span class='ui-li-count'>$item->COUNT</span></li>");
		$arr_day_result = $msg -> query_one_date_user($username, $item->days);
		foreach ($arr_day_result as $item2) {
			$depart_name = $msg->get_departname($item2->depart_id);
			if (empty($depart_name)) {$depart_name = '全部';}
			print("<li><a data-rel='dialog' data-transition='pop' href='index.php?action=show_one_user_msg&id=" .$item2->id. "'>
							<p>".$depart_name."</p>
							<h3>".$item2->content."</h3>						
							<p class='ui-li-aside'><strong>".date('h:i:sA', $item2->post_time)."</strong></p>
							</a></li>");
		}
			
	}

	print("</ul>");
}

function show_one_user_msg($id){
	require_once("msg_class.php");
	$msg = new message;
	$msg -> __set(id, $id);
	$cond = 'id='.$id;
	$one_msg = $msg -> query_one($cond);
	print("
		<div class='ui-field-contain'>
			<label for='textarea-10'>查看消息：</label>
			<textarea readonly cols='40' rows='20' name='textarea-10' id='textarea-10'>$one_msg->content</textarea>
		</div>
		");
}

/*添加消息表单显示*/
function show_one_msg($id){
	// session_start();
	$user_id = $_SESSION['user_id'];
	// echo $user_id . "---------------";
	// exit;
	$name = "";
	$id = trim($id);
	$sex = 1;
	if (empty($id)) { echo "发生错误！";exit;};

	// echo $id . "---------------";
	// exit;
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
		// echo $id . "---------------if";
		// exit;
		require_once("msg_class.php");
		$msg = new message;
		// $user -> __set(user_id, $id);
		$one_result = $msg -> query_one("id=$id");
		// echo "<pre>";
		// print_r($one_result);
		// echo "</pre>";
		// exit;
		$content = $one_result->content;
		$post_time = $one_result->post_time;
		$depart_id = $one_result->depart_id;
		$user_id = $one_result->user_id;


		print("<a rel=\"external\" href=\"javascript:deleteEntry_msg($id)\">删除</a>");
	}
	print("<form action='index.php' id='AjaxForm2' method='post' rel='external'>
			<input type='hidden' name='action' value='upsert_msg'>
			<input type='hidden' name='id' id='msg_id' value='".$id."'>
			<input type='hidden' name='user_id'  value='".$user_id."'>
			<fieldset>
			<div class='ui-field-contain'>
				<label for='content' id='hint'>消  息:</label>
				<textarea cols='40' rows='20' name='content' id='content'>".$content."</textarea>
			</div>

			
			<label for='select-department' class='select'>部  门:</label>
			<select name='department_id' id='select-department'>
			<option value='-1'>-请选择-</option>");
	foreach ($arr_results as $item){
		print("<option value='".$item->id."'");
		if ($item->id == $depart_id) {
			print("selected='selected'");
		}
		print(">" .$item->department_name);
		print("</option>");

	}

	print("
			</select>

			</fieldset>
			<button type='submit' id='submit3' value='Save'>发  布</button>
		</form>\n");
	print("
		<script>
			$(document).ready(function() {  
					    $('#submit3').click(function(){  

						    try {
								if ($.trim($('#content').val()) == '') {
									alert('请填写消息内容!');
									return false;
								}
							} catch (e) {
								alert(e);
								return false;
							}

					    });  
					});  
		</script>
		
	");
}



/* 添加消息 */
	/** id	content	post_time	depart_id	user_id	parent_id **/
function add_msg($content, $department_id, $user_id){
		require_once("msg_class.php");
		$msg = new message;
		$msg -> __set(content, $content);
		$msg -> __set(post_time, time());
		$msg -> __set(depart_id, $department_id);
		$msg -> __set(user_id, $user_id);
		$msg -> add_new();
}

/* 编辑信息 */
function update_msg($id, $content, $department_id, $user_id){
		require_once("msg_class.php");
		$msg = new message;
		$msg -> __set(id, $id);
		$msg -> __set(content, $content);
		$msg -> __set(post_time, time());
		$msg -> __set(depart_id, $department_id);
		$msg -> __set(user_id, $user_id);
		$msg -> update();
}

/* 删除信息 */

function kill_msg($id){
		require_once("msg_class.php");
		$msg = new message;
		$msg -> __set(id, $id);
		$msg -> delete();
}
?>