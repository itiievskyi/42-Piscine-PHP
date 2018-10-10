<?php
	require_once('auth.php');
	session_start();
	if ($_GET['login'] && $_GET['passwd'] && auth($_GET['login'], $_GET['passwd'])) {
		$_SESSION['loggued_on_user'] = $_GET['login'];
		echo "OK\n";
	} else {
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
?>
