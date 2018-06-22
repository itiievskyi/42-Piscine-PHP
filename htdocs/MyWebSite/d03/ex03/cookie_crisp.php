<?php
	$cook = $_GET;
	if (array_key_exists("action", $cook)) {
		if ($tab[$action] == "set" && $tab[$value] && $tab[$name]) {
			setcookie($tab[$name], $tab[$value], time() + (86400 * 30), '/');
		}
		else if ($tab[$action] == "get" && $tab[$name]) {
			echo "$_COOKIE[$name]\n";
		}
		else if ($tab[$action] == "del" && $tab[$name]) {
			echo "$_COOKIE[$name]\n";
		}
	}
?>
