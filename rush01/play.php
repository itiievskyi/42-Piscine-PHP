
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
	}
</script>

<div id="divGameStage"></div>
<script type="text/javascript">
	loadCanvas("divGameStage");
</script>

<script>
window.onload = function() {
	var c = document.getElementById("CursorLayer");
	var ctx = c.getContext("2d");
	var img = document.getElementById("scream");
	ctx.drawImage(img, 15, 15, 150, 180);
}
</script>



<!--
<table class="set" style="width:300px;">
	<tr>
		<td> <?php// print_r($_SESSION); ?> </td>
	</tr>
	<tr>
		<td> <?php// print_r($_COOKIE); ?></td>
	</tr>
</table>
!>
