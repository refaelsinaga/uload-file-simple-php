<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$database = "upload";

$conn = mysql_connect($localhost, $username, $password) or die(mysql_error());
		mysql_select_db($database) or die(mysql_error());

?>