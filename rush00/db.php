<?php

function db_get_products()
{
	$servername = 'localhost';
	$username = 'root';
	$password = 'campagnA96mamp';
	$db = 'shop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM products ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$products[] = $row;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	return($products);
}

function db_get_products_cat($cat)
{
	$servername = 'localhost';
	$username = 'root';
	$password = 'campagnA96mamp';
	$db = 'shop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM products WHERE cat='$cat' ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$products[] = $row;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	return($products);
}

function db_get_products_orig($orig)
{
	$servername = 'localhost';
	$username = 'root';
	$password = 'campagnA96mamp';
	$db = 'shop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM products WHERE orig='$orig' ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$products[] = $row;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	return($products);
}

function db_get_cats()
{
	$servername = 'localhost';
	$username = 'root';
	$password = 'campagnA96mamp';
	$db = 'shop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM cats ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$cats[] = $row;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	return($cats);
}

function db_get_item($id)
{
	$servername = 'localhost';
	$username = 'root';
	$password = 'campagnA96mamp';
	$db = 'shop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM products WHERE id='$id' ";
	$result = mysqli_query($conn,$sql);
	$item = mysqli_fetch_array($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
	return($item);
}

?>
