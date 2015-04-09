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
	return true;
}

function deleteEntry_department(id) {
	try {
		var confirmString = "删除这个部门.  确定吗?\n" + $.trim($('#department-1').val());
		if (window.confirm(confirmString)) {
			window.location="index.php?action=delete_department&id=" + id;
		}
	} catch (e) {
		alert(e);
		return false;
	}
	return true;

}

function deleteEntry_user(id) {
	try {
		var confirmString = "删除这个用户.  确定吗?\n" + $.trim($('#hint').val());
		if (window.confirm(confirmString)) {
			window.location="index.php?action=delete_user&id=" + id;
		}
	} catch (e) {
		alert(e);
		return false;
	}
	return true;

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

