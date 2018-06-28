<div class="land" style="padding-top:30px;">
	<h1 style="font-size:60px;">Check out your current order</h1>
	<?php if($_SESSION['cart']) {?>
		<form action="index.php?view=update_cart" method="post" id="cart-form">
		<table class="cart">
			<tr>
				<th colspan="2">Item</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
			<?php
				foreach($_SESSION['cart'] as $id => $quantity) {
					$product = db_get_item($id);
					include("cart_item.php");
				}
			?>
			<tr>
				<td colspan="4" style="font-size:25px;"><b>Total cost of your order:</b></td>
				<th style="font-size:25px;">$<?=number_format($_SESSION['total_price'],2);?></th>
			</tr>
		</table>
		<br><br>
		<table class="cart">
			<tr>
				<td colspan="2" style="font-size:25px; background: none;">
					<div class="shop_button" id="cart_1">
						<a><input type="submit" name="update" value="Update cart" /></a>
					</div>
				</td>
				<td style="background: none;"></td>
				<td colspan="2" style="font-size:25px; background: none;">
					<div class="shop_button" id="cart_2">
						<a href="index.php?view=empty_cart">Empty cart</a>
					</div>
				</td>
			</tr>
		</table>
		<div class="shop_button">
			<a href="index.php?view=order">Confirm order</a>
		</div>
	<?php } else {
			echo "<p align='center' style='color:#333;'>Your cart is empty now :(</p>";
		}
	?>
</div>
