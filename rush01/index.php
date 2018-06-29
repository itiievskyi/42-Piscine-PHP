<?php

	session_start();
	include("install.php");

	$view = empty($_GET['view']) ? 'login' : $_GET['view'];

	$arr = array('index', 'login', 'signup', 'error');
	if(!in_array($view, $arr)) {
		header('Location: error.php');
	}

	if ($view == "login" && $_COOKIE['id'] == '') {
		header('Location: login.php');
	} else {
		header('Location: game.php');
	}
?>
