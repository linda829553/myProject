<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>登录-移动办公-养生协会</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="js/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>
		String.prototype.Trim = function() { return this.replace(/(^\s*)|(\s*$)/g, "");}     // 去掉左右空格
		function validate_required(field,alerttxt,len)
		{
			with (field)
			  {
			  if (value==null||value=="")
			    {alert(alerttxt);return false}
			  else if (value.Trim().length < len){
			  	alerttxt = alerttxt.substr(0, len)
			  	alert(alerttxt + "不能小于" + len + "个字符！");return false
			  }
			  else {return true}
			  }
		}

		function validate_form(thisform)
		{
			with (thisform)
			  {
			  if (validate_required(username,"用户名 必须填写！", 3)==false)
			    {username.focus();return false}

			  if (validate_required(password,"密 码 必须填写！", 6)==false)
			    {password.focus();return false}
			  }
			
		}
	</script>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<h2>登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;录</h2>
		</div>
		<div data-role="content">
			<form method="post" action="check_user.php" data-ajax="false" id="frmLogin" onsubmit="return validate_form(this)">
			  <div data-role="fieldcontain">
			    <label for="username">用户名:</label>
			    <input type="text" name="username" id="username">
			  </div>

			  <div data-role="fieldcontain">
			    <label for="password">密码:</label>
			    <input type="password" name="password" id="password">
			  </div>


			  <input type="submit" data-inline="true" value="登 录">

			</form>
		</div>
		<div data-role="footer">
			<h3>欢迎登录养生协会移动办公系统</h3>
		</div>	
	</div>
	
</body>
</html>