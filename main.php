<?php
include('db.php');

if (isset($_POST['submit_message'])) {
	$name = $_POST['name'];
	$content = $_POST['content'];
	$email = $_POST['email'];
	
	$sql = "INSERT INTO message(name, content, email) VALUES ('$name', '$content', '$email')";
	$result = mysql_query($sql);										  
	
	if (!$result) {
		echo "Could not successfully run query ($sql) from DB: " . mysql_error();
		exit;
	}
}

$sql = "SELECT *, DATE_FORMAT(time, '%b %e, %y, %H:%i') AS formated_time FROM message ORDER BY time DESC LIMIT 20";
$result = mysql_query($sql);

if (!$result) {
	echo "Could not successfully run query ($sql) from DB: " . mysql_error();
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	margin:0px;
	padding:0px;
	font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
}

.time {
	text-align:right;
	color:#666;
	font-size:10px;
}

.name {
	font-weight:bold;
}

.alt_row {
	background:#efefef;
}

.message {
	padding:5px;
}

</style>
</head>

<body>
<?php 
if (mysql_num_rows($result) == 0) {
	echo "No Message";
	exit;
}

$counter = 1;
while ($row = mysql_fetch_assoc($result)) {
	if ($counter % 2 == 0) {
		echo "<div class='message'>";
	} else {
		echo "<div class='alt_row message'>";
	}
	$counter++;
	echo "<div class='time'>".$row["formated_time"]."</div>";
	echo "<div class='content'><span class='name'>";
	if (strlen($row["email"]) != 0) {
		if (preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $row["email"])) {
			echo "<a href='mailto:".$row["email"]."'>".$row["name"]."</a>";
		} else {
            if (preg_match( "/^http:\/\/.+$/", $row["email"])) {
			    echo "<a href='".$row["email"]."' target='blank'>".$row["name"]."</a>";
            } else {
                echo "<a href='http://".$row["email"]."' target='blank'>".$row["name"]."</a>";
            }
		}
	} else {
		echo $row["name"];
	}
	echo '</span>: '.$row["content"]."</div>";
	echo '</div>';
}
?>
</body>
</html>