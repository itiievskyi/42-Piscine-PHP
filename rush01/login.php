<?php

	echo "string";
	require "mysql_config.php";
	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	function generateCode($length = 6) {
		$ch = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($ch) - 1;
		while (strlen($code) < $length) {
			$code .= $ch[mt_rand(0, $clen)];
		}
		return $code;
	}

	if (isset($_POST['submit'])) {
		$sql = "SELECT user_id, user_password FROM users WHERE user_login = '" .
				mysqli_real_escape_string($conn, $_POST['login']) . "' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($query);

		if ($data['user_password'] === md5(md5($_POST['password']))) {
			$hash = md5(generateCode(10));
			if(!empty($_POST['not_attach_ip'])) {
				$insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
			}
			$sql = "UPDATE users SET user_hash='".$hash."' ".$insip
			." WHERE user_id='".$data['user_id']."'";
			mysqli_query($conn, $sql);
			setcookie("id", $data['user_id'], time()+60*60*24*30);
			setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true);
			header("Location: check.php");
		} else {
			echo "Incorrect password";
		}
	}

?>

<form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br>
<input name="submit" type="submit" value="Войти">
</form>
