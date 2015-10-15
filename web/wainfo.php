<?php 
require_once('./include/db_info.inc.php');

if ( !isset($_GET['sid']) ) {
	echo "no sid!";
	exit(0);
}

$sid=$_GET['sid'];
$sql="select `desc` from solution where solution_id='$sid'";
$result=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($result);
print_r($row[0]);

?>
