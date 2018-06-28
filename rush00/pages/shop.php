<div class="land" style="padding-top:9px;">
	<div class="navcat">
		<p>By type:</p>
		<a href="index.php?view=shop&cat=fresh">Fresh</a>
		<a href="index.php?view=shop&cat=soft">Soft</a>
		<a href="index.php?view=shop&cat=firm">Firm</a>
		<a href="index.php?view=shop&cat=blue">Blue</a>
		<p>By origin:</p>
		<a href="index.php?view=shop&orig=france">France</a>
		<a href="index.php?view=shop&orig=italy">Italy</a>
		<a href="index.php?view=shop&orig=world">World</a>
		<a href="index.php?view=shop" style="margin-left:100px"><b>RESET FILTER</b></a>
	</div>
	<br><br><br><br>
	<h1 style="font-size:60px;">Available <?php if ($cat && !$orig) echo "$cat "?>
		cheese<?php if (!$cat && $orig) echo " from ".ucfirst($orig)?>:</h1>
	<?php
	if (!$cat && !$orig) {
		$products = db_get_products();
		foreach($products as $item) {
			include("pages/item.php");
		}
	}
	else if ($cat) {
		$products = db_get_products_cat($cat);
		foreach($products as $item) {
			include("pages/item.php");
		}
	}
	else if ($orig) {
		$products = db_get_products_orig($orig);
		foreach($products as $item) {
			include("pages/item.php");
		}
	}
	?>
</div>
