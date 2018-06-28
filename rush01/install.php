<?php

	require "mysql_config.php";

	/*
	** Creating database for all game data
	*/
	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "CREATE DATABASE IF NOT EXISTS rush01";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating database: " . mysqli_error($conn);
	}
	mysqli_close($conn);

	/*
	** Creating users table
	*/
	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "CREATE TABLE IF NOT EXISTS users (
		`user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`user_login` VARCHAR(10) NOT NULL,
		`user_password` VARCHAR(32) NOT NULL,
		`user_hash` VARCHAR(32) NOT NULL default '',
		`user_ip` INT(10) unsigned NOT NULL default '0',
		`user_points` INT NOT NULL default 0
	)ENGINE = InnoDB";

	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}

	mysqli_close($conn);
?>
