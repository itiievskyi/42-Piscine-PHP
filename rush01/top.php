<?php

	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	$sql = "SELECT `user_image`, `user_login`, `user_points`
	FROM `users`
	ORDER BY `user_points` DESC";
	$top = array();
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($query)) {
		$top[] = $row;
	}
	$i = 0;
?>

<table class="top_table">
	<tr>
		<th>Rank</th>
		<th colspan="2">Player</th>
		<th>Points</th>
	</tr>
	<?php
		foreach ($top as $user) {
			$i++;
			include("top_player.php");
		}
	?>
</table>
