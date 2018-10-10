<?php
	session_start();
	if (isset($_POST['submit'])) {
		require "mysql_config.php";
		$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT user_id, user_password FROM users WHERE user_login = '" .
				mysqli_real_escape_string($conn, $_POST['login']) . "' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($query);

		if ($data['user_password'] === md5(md5($_POST['password']))) {
			$_SESSION['p2']['id'] = $data['user_id'];
			$_SESSION['p2']['login'] = $_POST['login'];
		}
		else {
			echo '<div class = "reg_err">Incorrect password for player #2</div>';
			$_SESSION['game'] = 0;
		}
		if ($_SESSION['game'] > 0) {
			$_SESSION['p1']['ships'][1] = $_POST['p1_select_1'];
			$_SESSION['p1']['ships'][2] = $_POST['p1_select_2'];
			$_SESSION['p1']['ships'][3] = $_POST['p1_select_3'];
			$_SESSION['p1']['ships'][4] = $_POST['p1_select_4'];
			$_SESSION['p1']['ships'][5] = $_POST['p1_select_5'];
			$_SESSION['p2']['ships'][1] = $_POST['p2_select_1'];
			$_SESSION['p2']['ships'][2] = $_POST['p2_select_2'];
			$_SESSION['p2']['ships'][3] = $_POST['p2_select_3'];
			$_SESSION['p2']['ships'][4] = $_POST['p2_select_4'];
			$_SESSION['p2']['ships'][5] = $_POST['p2_select_5'];
			header("Location: game.php?view=play");
			exit();
		}
	}

	$_SESSION['game'] = 1;
	$_SESSION['p1'] = array();
	$_SESSION['p2'] = array();
	$_SESSION['p1']['ships'] = array();
	$_SESSION['p2']['ships'] = array();
	$_SESSION['p2']['ships'][1] = '';
	$_SESSION['p2']['ships'][2] = '';
	$_SESSION['p2']['ships'][3] = '';
	$_SESSION['p2']['ships'][4] = '';
	$_SESSION['p2']['ships'][5] = '';
	$_SESSION['p1']['id'] = $_COOKIE['id'];
	$_SESSION['p1']['login'] = $_COOKIE['login'];
	$_SESSION['p1']['ships'][1] = '';
	$_SESSION['p1']['ships'][2] = '';
	$_SESSION['p1']['ships'][3] = '';
	$_SESSION['p1']['ships'][4] = '';
	$_SESSION['p1']['ships'][5] = '';
?>

<center><form class="setgame" action="game.php?view=setoff" method="post">
<table class="set">
	<tr><td colspan="5" style="font-size:60px;"><?php print($_COOKIE['login']) ?></td></tr>
	<tr><td colspan="5" style="font-size:30px;"><p>Select your ships:</p></td></tr>
	<tr>
		<td>
			<select class="ship_select" name="p1_select_1" required>
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p1_select_2">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p1_select_3">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p1_select_4">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p1_select_5">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
	</tr>
</table>
<table class="set">
	<tr><td colspan="5" style="font-size:60px;">Player #2</td></tr>
	<tr><td colspan="5" style="font-size:30px;"><p>Select your ships:</p></td></tr>
	<tr>
		<td>
			<select class="ship_select" name="p2_select_1" required>
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p2_select_2">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p2_select_3">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p2_select_4">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
		<td>
			<select class="ship_select" name="p2_select_5">
				<option value="">None</option>
				<option value="frigate">Frigate</option>
				<option value="scout">Scout</option>
				<option value="striker">Striker</option>
				<option value="terror">Terror</option>
			</select>
		</td>
	</tr>
	<tr><td colspan="5" style="font-size:30px;"><p>Authorise yourself:</p></td></tr>
	<tr>
		<td></td>
		<td colspan="1" style="font-size:30px;">
			<p>
				<p>Login</p>
				<input type="text" name="login"
				value="<?php echo @$_POST['login']; ?>" required>
			</p>
		</td>
		<td></td>
		<td colspan="1" style="font-size:30px;">
			<p>
				<p>Password</p>
				<input type="password" name="password"
				value="<?php echo @$_POST['password']; ?>" required>
			</p>
		</td>
		<td></td>
	</tr>
</table>
<table class="set" style="width:150px;">
	<tr>
		<td>
			<button name="submit" type="submit" value="set_all"
			style="font-size: 30px;">Start!</button>
		</td>
	</tr>
</table>
</form>
