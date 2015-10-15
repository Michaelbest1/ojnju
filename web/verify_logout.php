<?php
session_start();

if ($_POST['admin_psw'] == "woaicjiajia") {
	unset($_SESSION['user_id']);
	session_destroy();

	echo "<script language='javascript'>\n";
	echo "history.go(-2);\n";
	echo "</script>";
}

?>

