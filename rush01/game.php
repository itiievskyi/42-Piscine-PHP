<?php
	session_start();
	require "mysql_config.php";
//	require "classes/BattleShip.Class.php";
	echo "GAME";

	if ($_COOKIE['id'] == '') {
		header('Location: login.php');
		exit(-1);
	}

	$view = empty($_GET['view']) ? 'menu' : $_GET['view'];

	$arr = array('play', 'logout', 'profile', 'menu', 'online', 'top', 'setoff');
	if(!in_array($view, $arr)) {
		header('Location: error.php');
	}

?>

<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Awesome Starships Battles II</title>
		<link href="styles/game.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar">
			<a href="index.php?view=menu">Menu</a>
			<a href="game.php?view=profile">Profile</a>
			<a href="game.php?view=top">Top players</a>
			<p>Hello, <?php print($_COOKIE['login']) ?>!</p>
			<a href="logout.php" style="float:right; color:#fc7e37;">
			Log out</a>
		</div>
		<?php
		if ($view == "menu") {
			include("$view.php");
		}
		if ($view == "top") {
			include("$view.php");
		}
		if ($view == "play") {
			include("$view.php");
		}
		if ($view == "setoff") {
			include("$view.php");
		}
		?>
	</body>
</html>
