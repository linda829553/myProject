<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
require("header.php");
	// echo "loginSuccess: ".$_SESSION["loginSuccess"];				// 测试
if(!isset($_SESSION["loginSuccess"])){
	// echo "loginSuccess: ".$_SESSION["loginSuccess"];				// 测试
	echo "<script>location='login.php';</script>";
}
?>

	<div data-role="page">
		<div data-role="header">
			<h1>短信群发</h1>	
		</div>
		<div data-role="content">
		<form action="send.php" method="post"  data-ajax="false" onsubmit="return checkForm(this)">
			<div data-role="ui-field-contain">
				<label for="textarea-1">手机号:(多个手机号可用逗号隔开)</label>
				<textarea name="telphone" id="textarea-1"></textarea>
			</div>
			<div data-role="ui-field-contain">
				<label for="textarea-2">短信内容:</label>
				<textarea name="content" id="textarea-2"></textarea>
			</div>
			<button type="submit" name="submit" value="Send">发 送</button>
		</form>
		


		</div>
		<div data-role="footer">
			<div data-role='controlgroup' data-type='horizontal'>
				<a href='exit.php' data-role='button' data-ajax='false'>退出</a>
			</div>
		</div>	
	</div>
	
</body>

<script>
function checkForm() {
	try {
		if ($.trim($('#textarea-1').val()) == "") {
				alert("请填写手机号码!");
				return false;
			}
		if ($.trim($('#textarea-2').val()) == "") {
				alert("请填写发送内容!");
				return false;
			}
	} catch (e) {
		alert(e);
		return false;
	}
	return true;
}
</script>
</html>