<table class="item">
	<tr>
		<td class="tabimg"><a href="index.php?view=product&id=<?=$item['id']?>"><img style="width: 250px;" src="<?=$item['img']?>"></td>
	</tr>
	<tr>
		<td><a href="index.php?view=product&id=<?=$item['id']?>"><?=$item['title']?></td>
	</tr>
	<tr>
		<td class="tabdesc">Weight: <?=$item['weight']?>g / Price: $<?=$item['price']?></td>
	</tr>
	<tr>
		<td class="tabdesc">Type: <?=ucfirst($item['cat'])?> / Origin: <?=ucfirst($item['orig'])?></td>
	</tr>
</table>
