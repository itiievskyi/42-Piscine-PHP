<?php

	session_start();
	include("install.php");

	$view = empty($_GET['view']) ? 'login' : $_GET['view'];

	$arr = array('index', 'login', 'signup', 'error');
	if(!in_array($view, $arr)) {
		$view = 'error';
	}

	if ($view == "login") {
		header('Location: login.php');
	}
?>
