<?php

	require "mysql_config.php";
	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	/*
	** Data validation and saving into the `users` table
	*/

	$data = $_POST;
	if (isset($data['do_signup'])) {
		$errors = array();

		// login
		if (trim($data['login']) == '') {
			$errors[] = 'Type your login!';
		}
		if (!preg_match("/^[a-zA-Z0-9]+$/",trim($data['login']))) {
			$errors[] = "Login must contain only latin symbols and digits!";
		}
		if (strlen(trim($data['login'])) > 10) {
			$errors[] = "Login must be not longer than 10 symbols!";
		}
		$sql = "SELECT user_id FROM users WHERE user_login='".
			mysqli_real_escape_string($conn, $data['login'])."'";
		if ($ans = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($ans) > 0) {
				$errors[] = 'This login exists! Use another one or log in.';
			}
		}

		// email
		if (trim($data['email']) == '') {
			$errors[] = 'Type your email!';
		}

		// password
		if ($data['password'] == '') {
			$errors[] = 'Type your password!';
		} else if (strlen($data['password']) < 7) {
			$errors[] = "Password must be longer than 6 symbols!";
		}
		if ($data['password'] != $data['password_2']) {
			$errors[] = "Passwords don't match!";
		}

		// final if no errors
		if (empty($errors)) {
			$login = $data['login'];
			$password = md5(md5($data['password']));
			$sql = "INSERT INTO users SET user_login='".
					$login."', user_password='".$password."'";
			if (mysqli_query($conn, $sql)) {
				echo "";
			} else {
				echo "Error inserting into database: " . mysqli_error($conn);
			}
			header("Location: login.php");

		// final if error
		} else {
			echo '<div class = "reg_err">' . array_shift($errors) .
			'</div>';
		}
	}
?>

	<!--
		Creating a form for registration
	-->
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Awesome Starships Battles II</title>
		<link href="styles/login.css" rel="stylesheet">
	</head>
	<body>
		<div class="d_signup">
		<p>Welcome to our community!<br>Fill the form to sign up...</p>
		<hr>
		<form id="signup" action="signup.php" method="post">
			<p>
				<p>Your login</p>
				<input type="text" name="login"
				value="<?php echo @$data['login']; ?>">
			</p>
			<p>
				<p>Your email</p>
				<input type="email" name="email"
				value="<?php echo @$data['email']; ?>">
			</p>
			<p>
				<p>Type your password</p>
				<input type="password" name="password"
				value="<?php echo @$data['password']; ?>">
			</p>
			<p>
				<p>Type the password again</p>
				<input type="password" name="password_2"
				value="<?php echo @$data['password_2']; ?>">
			</p>
			<p>
				<button type="submit" name="do_signup">Sign up</button>
			</p>
		</form>
		<hr>
		<p>... or <a href="login.php">log in</a></p>
		</div>
	</body>
</html>
