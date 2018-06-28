<?php

	session_start();
	if(!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
		$_SESSION['total_items'] = 0;
		$_SESSION['total_price'] = '0.00';
	}

	include("install.php");
	include("db.php");
	include("cart_func.php");
	$view = empty($_GET['view']) ? 'landing' : $_GET['view'];
	$cat = empty($_GET['cat']) ? '' : $_GET['cat'];
	$orig = empty($_GET['orig']) ? '' : $_GET['orig'];

	$arr = array('index','shop','product','cart','add_to_cart','update_cart','order', 'error', 'blue', 'firm', 'fresh', 'soft', 'landing', 'about', 'empty_cart');
	if(!in_array($view,$arr)) {
		$view = 'error';
	}
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>BestCheese</title>
		<link href="pages/styles/landing.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar">
			<a href="index.php?view=landing">Home</a>
			<a href="index.php?view=about">About cheeses</a>
			<a href="index.php?view=shop">Shop</a>
			<a href="index.php?view=cart" style="float:right; color:#fc7e37;">
			<img src="images/cart.png" style="height:20px; margin: 0 10px;
			padding:0;" alt="cart">My cart (<?=$_SESSION['total_items'];?>) - $<?=$_SESSION['total_price'];?></a>
		</div>
		<?php
			if ($view == "add_to_cart") {
				$id = $_GET['id'];
				$add_item = add_to_cart($id);
				$_SESSION['total_items'] = total_items($_SESSION['cart']);
				$_SESSION['total_price'] = total_price($_SESSION['cart']);
				header('Location: index.php?view=product&id='.$id);
			} else if ($view == "empty_cart") {
				$_SESSION['cart'] = array();
				$_SESSION['total_items'] = 0;
				$_SESSION['total_price'] = '0.00';
				header('Location: index.php?view=cart');
			} else if ($view == "update_cart") {
				update_cart();
				$_SESSION['total_items'] = total_items($_SESSION['cart']);
				$_SESSION['total_price'] = total_price($_SESSION['cart']);
				header('Location: index.php?view=cart');
			} else if ($view == "error") {
				include("pages/$view.php");
			} else if ($view == "order" && $_SESSION['total_items'] != 0) {
				archive_order();
				$_SESSION['cart'] = array();
				$_SESSION['total_items'] = 0;
				$_SESSION['total_price'] = '0.00';
				include("pages/$view.php");
			} else if ($view == "order" && $_SESSION['total_items'] == 0) {
				header('Location: index.php?view=error');
			} else {
				include("pages/$view.php");
			}
		?>
	</body>
</html>
