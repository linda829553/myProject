function checkForm() {
	try {
		if ($.trim($('#department-1').val()) == "") {
				alert("请填写部门名称!");
				return false;
			}
	} catch (e) {
		alert(e);
		return false;
	}
	// return true;
}

function deleteEntry_department(id) {
	try {
		var confirmString = "删除这个部门.  确定吗?\n" + $.trim($('#department-1').val()) + "\n建议修改部门，删除后和部门对应的消息将不再显示！";
		if (window.confirm(confirmString)) {
			window.location="index.php?action=delete_department&id=" + id;
		}
	} catch (e) {
		alert(e);
		return false;
	}
	// return true;

}

function deleteEntry_msg(id) {
	try {
		var confirmString = "删除这个消息.  确定吗?\n" + $.trim($('#content').val());
		if (window.confirm(confirmString)) {
			window.location="index.php?action=delete_msg&id=" + id;
		}
	} catch (e) {
		alert(e);
		return false;
	}
	// return true;

}


function deleteEntry_user(id) {

	try {
		
		/* ajax 查询数据返回管理员标识*/
		function onSuccess(data, status){
			data = $.trim(data);
			if (data == 1) {
				alert("你不能删除管理员账户!");
				return false;
			} else {
				var confirmString = "删除这个用户.  确定吗?\n" + $.trim($('#hint').val());
				if (window.confirm(confirmString)) {
					window.location="index.php?action=delete_user&id=" + id;
				}
			}
			
		}

		function onError(data, status){

		}

		var query_str = 'user_id=' + id;

		$.ajax({
			type: 'POST',
			url: 'ajax_query_mark.php',
			cache: false,
			data: query_str,
			success: onSuccess,
			error: onError
		});

		
	} catch (e) {
		alert(e);
		return false;
	}
	// return true;

}

// function checkForm_user() {
// 	try {
// 		if ($.trim($('#username').val()) == "") {
// 			alert("请填写用户名称!");
// 			return false;
// 		} else if ($.trim($('#password').val()) == "") {
// 			alert("请填写用户密码!");
// 			return false;
// 		} 
// 	} catch (e) {
// 		alert(e);
// 		return false;
// 	}
// 	return true;
// }

function onSuccess(data, status)  
{  
    data = $.trim(data);  
    $("#notification").text(data);  
}  

function onError(data, status)  
{  
    // handle an error  
}          

