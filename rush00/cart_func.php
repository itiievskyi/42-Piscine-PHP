<?php

function add_to_cart($id) {
	if(isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]++;
		return true;
	} else {
		$_SESSION['cart'][$id] = 1;
		return true;
	}
	return false;
}

function update_cart() {
	foreach($_SESSION['cart'] as $id => $qty) {
		if($_POST[$id] == '0') {
			unset($_SESSION['cart'][$id]);
		} else {
			$_SESSION['cart'][$id] = $_POST[$id];
		}
	}
}

function total_items($cart) {
	$num_items = 0;
	if(is_array($cart)) {
		foreach($cart as $id => $qty) {
			$num_items += $qty;
		}
	}
	return $num_items;
}

function total_price($cart) {
	$total_price = 0.0;
	$servername = 'localhost';
	$username = 'root';
	$password = 'campagnA96mamp';
	$db = 'shop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if(is_array($cart)) {
		foreach($cart as $id => $qty) {
			$sql = "SELECT * FROM products WHERE id='$id'";
			$result = mysqli_query($conn,$sql);
			if($result) {
				$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$item_price = $line['price'];
				$total_price += $item_price * $qty;
			}
		}
	}
	return $total_price;
}

function archive_order() {
	
}

?>
