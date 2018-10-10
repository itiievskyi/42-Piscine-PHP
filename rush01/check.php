<?php

	require "mysql_config.php";
	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
	{
		$query = mysqli_query($conn,
		"SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".
		intval($_COOKIE['id'])."' LIMIT 1");
		$userdata = mysqli_fetch_assoc($query);
		if(($userdata['user_hash'] !== $_COOKIE['hash']) or
			($userdata['user_id'] !== $_COOKIE['id'])) {
			setcookie("id", "", time() - 3600*24*30*12, "/");
			setcookie("hash", "", time() - 3600*24*30*12, "/");
			print_r($_COOKIE);
			print "userdata['user_id'] = ";
			print($userdata['user_id']);
			print "Something's going wrong...";
		} else {
			header("Location: game.php");
			exit();
		}
	}
	else {
		print "You need to activate cookies";
	}

 ?>
