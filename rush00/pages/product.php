<?php
	$id = $_GET['id'];
	$product = db_get_item($id);
	if ($product['title'] != '') {?>
	<div class="land" style="padding-top:60px; margin-top:0;">
		<h1><?=$product['title']?></h1>
		<img class="prodimg" src="<?=$product['img']?>">
		<p class="proddesc"><b>Category: </b><a href = "index.php?view=shop&cat=<?=$product['cat']?>"><?=ucfirst($product['cat'])?></a></p>
		<p class="proddesc"><b>Country of origin: </b><a href = "index.php?view=shop&orig=<?=$product['orig']?>"><?=ucfirst($product['orig'])?></a></p>
		<p class="proddesc"><b>Weight: </b><?=$product['weight']?>g</p>
		<p class="proddesc"><b>Price: </b>$<?=$product['price']?></p>
		<p class="proddesc"><b>About: </b><?=$product['description']?></p>
		<div class="shop_button" id="add">
			<a href="index.php?view=add_to_cart&id=<?=$product['id']?>">Add to cart</a>
		</div>
		<div class="shop_button" id="back">
			<a href="index.php?view=shop">⇐ Back to the shop</a>
		</div>
	</div>
<?php } else { ?>
	<div class="land" style="padding-top:60px; margin-top:0;">
		<h1>There is no such item :(</h1>
	</div>
<?php } ?>
