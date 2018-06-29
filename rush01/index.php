<?php

	session_start();
	include("install.php");

	if ($_COOKIE['id'] == '') {
		header('Location: login.php');
	} else {
		header('Location: game.php');
	}
?>
