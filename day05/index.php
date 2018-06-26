<?php

	$servername = "localhost";
	$username = "root";
	$password = "campagnA96mamp";


	$conn = mysqli_connect($servername, $username, $password);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "DROP DATABASE db_itiievsk";
	if (mysqli_query($conn, $sql)) {
		echo "DB was successfully dropped before creation.";
	} else {
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	mysqli_close($conn);



	$i = 0;
	while ($i < 1) {
		if ($i < 10) {
			$ex = '0'.$i;
		} else {
			$ex = $i;
		}
		$conn = mysqli_connect($servername, $username, $password);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		if (file_exists("ex$ex/ex$ex.sql")) {
			$sql = file_get_contents("ex$ex/ex$ex.sql");
			if (mysqli_query($conn, $sql)) {
				echo "Sql query submitted!";
			} else {
				echo "Error: " . mysqli_error($conn);
			}
		} else {
			echo "Error: file "."ex$ex/ex$ex.sql"." doesn't exist.";
		}
		mysqli_close($conn);
		$i++;
		echo "<br>";
	}



	$conn = mysqli_connect($servername, $username, $password);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "CREATE TABLE db_itiievsk.user_card SELECT * FROM test.user_card";
	if (mysqli_query($conn, $sql)) {
		echo "The tables was successfully copied.";
	} else {
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	mysqli_close($conn);


	while ($i <= 21) {
		if ($i < 10) {
			$ex = '0'.$i;
		} else {
			$ex = $i;
		}
		$conn = mysqli_connect($servername, $username, $password, 'db_itiievsk');
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		if (file_exists("ex$ex/ex$ex.sql")) {
			$sql = file_get_contents("ex$ex/ex$ex.sql");
			if (mysqli_query($conn, $sql)) {
				echo "Sql query submitted!";
			} else {
				echo "Error: " . mysqli_error($conn);
			}
		} else {
			echo "Error: file "."ex$ex/ex$ex.sql"." doesn't exist.";
		}
		mysqli_close($conn);
		$i++;
		echo "<br>";
	}

?>
