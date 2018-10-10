<?php
	if ($_SERVER['PHP_AUTH_USER'] == 'zaz' &&
	$_SERVER['PHP_AUTH_PW'] == 'jaimelespetitsponeys') {
		$pic = base64_encode(file_get_contents("../img/42.png"));
		echo "<html><body>\nHello Zaz<br />\n<img src='data:image/png;base64,";
		echo ($pic);
		echo "'>\n</body></html>\n";
	}
	else {
		header('WWW-Authenticate: Basic realm="UNIT_ITIIEVSK"');
		header('HTTP/1.0 401 Unauthorized');
		echo "<html><body>That area is accessible for members only";
		echo "</body></html>\n";
	}
?>
