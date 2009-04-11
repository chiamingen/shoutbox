<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'shoutbox';

$link = mysql_connect($host, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db($database, $link);
if (!$db_selected) {
    die ('Can\'t use '.$database.' : ' . mysql_error());
}

?>