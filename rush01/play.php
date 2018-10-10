<<<<<<< HEAD
<table class="field">
	<tr>
		<td rowspan="100" colspan="50"></td>
	</tr>
	<?php
		$a = 1;
		while ($a++ <= 99) {
		echo "	<tr>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>&nbsp</td>
			</tr>";
	} ?>
</table>


























<!--
<img id="scream" src="images/ship_frigate.png" alt="">

<script type="text/javascript">
	function loadCanvas(id) {
		var canvas = document.createElement('canvas');
		div = document.getElementById(id);
		canvas.id     = "CursorLayer";
		canvas.width  = 1800;
		canvas.height = 1200;
		canvas.style.zIndex   = 8;
		canvas.style.position = "absolute";
		canvas.style.marginTop = "100px";
		canvas.style.marginLeft = "200px";
		canvas.style.border   = "1px solid";
		canvas.style.backgroundColor = "rgba(255, 255, 255, 0.5)";
		div.appendChild(canvas)
=======
<?php
	$p1 = $_SESSION['p1']['id'];
	$p2 = $_SESSION['p2']['id'];
	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	$sql = "SELECT `user_image`, `user_id`, `user_login`, `user_points`
	FROM `users`
	WHERE `user_id` = '$p1' OR `user_id` = '$p2'
	ORDER BY `user_points` DESC";
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($query)) {
		if ($p1 == $row['user_id']) {
			$_SESSION['p1']['img'] = $row['user_image'];
		}
		if ($p2 == $row['user_id']) {
			$_SESSION['p2']['img'] = $row['user_image'];
		}
>>>>>>> b87c7a152c74b182f394d12fae4d2091d921a975
	}
?>

<table class="playfield">
	<tr>
		<td class="player_bar" style="width:12.5%; background: rgba(0, 0, 255, 0.5);">
			<img class="p_img" src="<?php echo $_SESSION['p1']['img'] ?>" alt="p1_img">
			<p style="font-size: 25px; color: white; margin-bottom:5px;"><?php echo $_SESSION['p1']['login'] ?></p>
			<table style="height: 400px;">
				<?php
					$i = 1;
					foreach ($_SESSION['p1']['ships'] as $ship) {
						if ($ship != '') {
							echo "<tr><td style='height:80px;'><img src = 'images/ship_"
							.$ship.".png' id = 'p1s" . $i . "' style='max-width:200px; max-height:75px;'></td></tr>";
						} else {
							echo "&nbsp";
						}
						$i++;
				} ?>
			</table>
		</td>
		<td style="background: rgba(255, 255, 255, 0.7);">
		<canvas id="grid"></canvas></td>
		<td class="player_bar" style="width:12.5%; background: rgba(255, 0, 0, 0.5);">
			<img class="p_img" src="<?php echo $_SESSION['p2']['img'] ?>" alt="p2_img">
			<p style="font-size: 25px; color: white; margin-bottom:5px;"><?php echo $_SESSION['p2']['login'] ?></p>
			<table style="height: 400px;">
				<?php
					$i = 1;
					foreach ($_SESSION['p2']['ships'] as $ship) {
						if ($ship != '') {
							echo "<tr><td style='height:80px; text-align:right;'><img src = 'images/ship_"
							.$ship.".png' id = 'p2s" . $i . "' style='max-width:200px; max-height:75px; transform: scaleX(-1);'></td></tr>";
						} else {
							echo "&nbsp";
						}
						$i++;
				} ?>
			</table>
		</td>
	</tr>

</table>

<script>
var drawGrid = function(w, h, id) {
	var canvas = document.getElementById(id);
	var ctx = canvas.getContext('2d');
	ctx.canvas.width  = w;
	ctx.canvas.height = h;

	var data = '<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"> \
		<defs> \
		<pattern id="smallGrid" width="10" height="10" patternUnits="userSpaceOnUse"> \
		<path d="M 10 0 L 0 0 0 10" fill="none" stroke="gray" stroke-width="1" /> \
		</pattern> \
		<pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"> \
		<rect width="100" height="100" fill="url(#smallGrid)" /> \
		<path d="M 100 0 L 0 0 0 100" fill="none" stroke="gray" stroke-width="1" /> \
		</pattern> \
		</defs> \
		<rect width="100%" height="100%" fill="url(#smallGrid)" /> \
		</svg>';

	var DOMURL = window.URL || window.webkitURL || window;

	var img = new Image();
	var svg = new Blob([data], {type: 'image/svg+xml;charset=utf-8'});
	var url = DOMURL.createObjectURL(svg);

	img.onload = function () {
		ctx.drawImage(img, 0, 0);
		DOMURL.revokeObjectURL(url);
	}
	img.src = url;

}
drawGrid(1500, 1000, "grid");

var aster1 = new Image();
aster1.src = "images/aster1.gif";
var aster2 = new Image();
aster2.src = "images/aster2.png";
var aster3 = new Image();
aster3.src = "images/aster3.png";
var aster4 = new Image();
aster4.src = "images/aster4.png";

var p1s1 = document.getElementById('p1s1');
var p1s2 = document.getElementById('p1s2');
var p1s3 = document.getElementById('p1s3');
var p1s4 = document.getElementById('p1s4');
var p1s5 = document.getElementById('p1s5');

var p2s1 = document.getElementById('p2s1');
var p2s2 = document.getElementById('p2s2');
var p2s3 = document.getElementById('p2s3');
var p2s4 = document.getElementById('p2s4');
var p2s5 = document.getElementById('p2s5');

window.onload = function() {
	var c = document.getElementById("grid");
	var ctx = c.getContext("2d");
	ctx.drawImage(aster1, 270, 300, 50, 50);
	ctx.drawImage(aster2, 600, 600, 60, 90);
	ctx.drawImage(aster3, 1000, 760, 100, 30);
	ctx.drawImage(aster4, 900, 300, 100, 100);

	ctx.drawImage(p1s1, 10, 10, p1s1.naturalWidth / 10, p1s1.naturalHeight / 10);
	ctx.drawImage(p1s2, 10, 40, p1s2.naturalWidth / 10, p1s2.naturalHeight / 10);
	ctx.drawImage(p1s3, 10, 70, p1s3.naturalWidth / 10, p1s3.naturalHeight / 10);
	ctx.drawImage(p1s4, 10, 100, p1s4.naturalWidth / 10, p1s4.naturalHeight / 10);
	ctx.drawImage(p1s5, 10, 130, p1s5.naturalWidth / 10, p1s5.naturalHeight / 10);

	ctx.drawImage(p2s1, 100, 100, p2s1.naturalWidth / 10, p2s1.naturalHeight / 10);
	ctx.drawImage(p2s2, 100, 40, p2s2.naturalWidth / 10, p2s2.naturalHeight / 10);
	ctx.drawImage(p2s3, 100, 70, p2s3.naturalWidth / 10, p2s3.naturalHeight / 10);
	ctx.drawImage(p2s4, 100, 100, p2s4.naturalWidth / 10, p2s4.naturalHeight / 10);
	ctx.drawImage(p2s5, 100, 130, p2s5.naturalWidth / 10, p2s5.naturalHeight / 10);
}
</script>



<<<<<<< HEAD
=======

>>>>>>> b87c7a152c74b182f394d12fae4d2091d921a975
<table class="set" style="width:300px;">
	<tr>
		<td> <?php print_r($_SESSION); ?> </td>
	</tr>
	<tr>
		<td> <?php print_r($_COOKIE); ?></td>
	</tr>
	<tr>
		<td> <?php print_r($top); ?></td>
	</tr>
	<tr>
		<td> <?php echo $p1; ?></td>
	</tr>
</table>
