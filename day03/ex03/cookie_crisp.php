<?php
	$tab = $_GET;
	if ($tab["action"]) {
		if ($tab["action"] == "set" && $tab["name"] != '' && $tab["value"] != '') {
			setcookie($tab["name"], $tab["value"], time() + (86400 * 30), '/');
		}
		if ($tab["action"] == "get" && $tab["name"] != '' && !$tab["value"]) {
			$name = $tab["name"];
			if ($_COOKIE[$name]) {
				echo "$_COOKIE[$name]\n";
			}
		}
		if ($tab["action"] == "del" && $tab["name"] != '' && !$tab["value"]) {
			setcookie($tab["name"], '', time() - 3600);
		}
	}
?>
