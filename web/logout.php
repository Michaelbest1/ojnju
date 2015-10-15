<?php 
session_start();

if ( !isset($_SESSION['user_id']) ) {
	exit(0);
}

if ( !isset($_SESSION['inContest']) || isset($_SESSION['administrator']) ) {
	//allow logout.
	unset($_SESSION['user_id']);
	session_destroy();

	echo "<script language='javascript'>\n";
	echo "history.go(-1);\n";
	echo "</script>";
}
else {
	//need verification
?>
<form action="verify_logout.php" method="post">
administrator password: <input type="password", name="admin_psw">
<input type="submit" value="logout">
</form>
<?php
}
?>
