<?php require_once("admin-header.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>batch add accounts</title>

<?php
require_once("../include/db_info.inc.php");

function pwGen($password,$md5ed=False) 
{
	if (!$md5ed) $password=md5($password);
	$salt = sha1(rand());
	$salt = substr($salt, 0, 4);
	$hash = base64_encode( sha1($password . $salt, true) . $salt ); 
	return $hash; 
}

if ( isset($_POST['text']) ) {
	$text=$_POST["text"];
	$arr=explode("\n", $text);
	foreach ($arr as $val) {
		//echo $val."<br>";
		$user_id=trim($val);
		$password=pwGen($user_id);
		$nick=$user_id;
		$school="NJU";
		$sql="INSERT INTO `users`("
			."`user_id`,`ip`,`accesstime`,`password`,`reg_time`,`nick`,`school`)"
			."VALUES('".$user_id."','".$_SERVER['REMOTE_ADDR']."',NOW(),'".$password."',NOW(),'".$nick."','".$school."')";
		mysql_query($sql);
		if( mysql_affected_rows() == 0 ) {
			echo "add acount failed once. user_id:".$user_id."<br>";
		}
		else {
			echo "add acount suc! user_id:".$user_id."<br>";
		}
	}
}

?>

<form action="account_add.php" method="post">
	<h2>把学生的学号输入下面的文本框，每行一个，即可批量生成学生账号。初始密码和账号相同</h2>
	<textarea name="text" cols="20" rows="300"></textarea>
	<input type="submit" value="submit"></input>
</form>
