<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	margin:0px;
	padding:0px;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
}

input {
	border:1px solid #666;
	background:#efefef;
	font-size:11px;
	padding:2px 4px;
}

table {
	margin-bottom:5px;
}
</style>

<script type="text/javascript">

window.onload = function () {
	var window_width = document.getElementById('table').clientWidth;
	var suitable_width = (window_width - 25)/2;
	document.getElementById('name_field').style.width =  suitable_width + 'px';
	document.getElementById('email_field').style.width = suitable_width + 'px';

	document.getElementById('content_field').style.width = (window_width - 5 - 40) + 'px';
}

function on_focus(e, default_msg) {
	var target = window.event ? window.event.srcElement : e.target;
	if (target.value == default_msg) {
		target.value = "";
	}
}

function lose_focus(e, default_msg) {
	 var target = window.event ? window.event.srcElement : e.target;
	 if (target.value == "") {
		 target.value = default_msg;
	 }
}

function do_post() {
	var name = document.getElementById('name_field');
	var content = document.getElementById('content_field');
	var email = document.getElementById('email_field');

	var is_valid = true;

	if (name.value == 'name') {
		is_valid = false;
		alert("Please enter a name");
	} else if (content.value == 'message') {
		is_valid = false;
		alert("Please enter a message");
	}

	if (is_valid) {
		if (email.value == 'email / url') {
			email.value = ""
		}
		document.getElementById('message_form').submit();
		name.value = "name";
		content.value = "message";
		email.value = "email / url";
	}

	return false;
}
</script>

</head>

<body>
<form id="message_form" action="main.php" target="shoutbox_main" method="post" onsubmit="return do_post();">
    <table width="100%" id="table" cellpadding="0" cellspacing="0">
        <tr>
            <td><input name="name" id="name_field" type="text" value="name" size="1" onfocus="on_focus(event, 'name')" onblur="lose_focus(event, 'name')" maxlength="20"/></td>
            <td width="5px"></td>
            <td><input name="email" id="email_field"  type="text" value="email / url" size="1" onfocus="on_focus(event, 'email / url')" onblur="lose_focus(event, 'email / url')"  maxlength="100"/></td>
        </tr>
    </table>

	<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td><input name="content" id="content_field" type="text" value="message" size="1" onfocus="on_focus(event, 'message')" onblur="lose_focus(event, 'message')" /></td>
            <td width="5px"></td>
            <td><input width="40px" type="submit" value="Go" /></td>
        </tr>
    </table>
    <input type="hidden" name="submit_message" />
</form>
</body>
</html>

