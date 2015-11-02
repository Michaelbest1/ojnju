<?php

require_once("./include/db_info.inc.php");
require_once("./psw.php");

session_start();

if ($_POST['admin_psw'] == $OJ_SUPER_PSW) {
	unset($_SESSION['user_id']);
	session_destroy();

	echo "<script language='javascript'>\n";
	echo "history.go(-2);\n";
	echo "</script>";
}

?>

