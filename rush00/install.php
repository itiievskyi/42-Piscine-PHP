<?php

	$servername = "localhost";
	$username = "root";
	$password = "campagnA96mamp";
	$db = "shop";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Create database checking whether it exists
	$sql = "CREATE DATABASE IF NOT EXISTS $db";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating database: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	// Create connection with created db
	$conn = mysqli_connect($servername, $username, $password, $db);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// sql to create table with products
	$sql = "CREATE TABLE IF NOT EXISTS products (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(50) NOT NULL,
		description TEXT NOT NULL,
		weight INT(3) NOT NULL,
		price DECIMAL(4,2),
		img VARCHAR(100) NOT NULL,
		cat VARCHAR(100) NOT NULL,
		orig VARCHAR(100) NOT NULL
	)ENGINE = InnoDB";

	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}

	// loading data into table 'products'
	$sql = "LOAD DATA LOCAL INFILE 'db/prods.csv'
			INTO TABLE products
			FIELDS ENCLOSED BY '\"'
			TERMINATED BY ','
			IGNORE 1 ROWS";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	// sql to create table with categories
	$sql = "CREATE TABLE IF NOT EXISTS cats (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		description TEXT NOT NULL,
		cat_id VARCHAR(100) NOT NULL
	)ENGINE = InnoDB";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}

	// loading data into table 'categories'
	$sql = "LOAD DATA LOCAL INFILE 'db/cats.csv'
			INTO TABLE cats
			FIELDS ENCLOSED BY '\"'
			TERMINATED BY ','
			IGNORE 1 ROWS";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	// sql to create table with origins
	$sql = "CREATE TABLE IF NOT EXISTS origins (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		orig_id VARCHAR(100) NOT NULL
	)ENGINE = InnoDB";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}

	// loading data into table 'origins'
	$sql = "LOAD DATA LOCAL INFILE 'db/origins.csv'
			INTO TABLE origins
			FIELDS ENCLOSED BY '\"'
			TERMINATED BY ','
			IGNORE 1 ROWS";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	// sql to create table with orders
	$sql = "CREATE TABLE IF NOT EXISTS orders (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		product VARCHAR(50) NOT NULL,
		prod_id INT NOT NULL,
		price DECIMAL(4,2),
		qty INT NOT NULL,
		name VARCHAR(100) NOT NULL,
		s_name VARCHAR(100) NOT NULL,
		email VARCHAR(100) NOT NULL,
		o_date DATE NOT NULL,
		o_time TIME NOT NULL
	)ENGINE = InnoDB";

	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}

	mysqli_close($conn);
?>
