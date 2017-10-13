<?php 
include 'conn.php';
$id_file = $_GET['id_file'];

// query 1
$query = mysql_query("SELECT * FROM upload WHERE id_file='$id_file'");
while ($data = mysql_fetch_array($query)) {
	unlink("file/".$data['file']);
}
// query 2

mysql_query("DELETE FROM upload WHERE id_file='$id_file'") or die(mysql_error());

header("location:index.php");
?>
<!-- facaebook | twitter | Instagram : @refalsinaga-->