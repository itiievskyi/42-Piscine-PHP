#!/usr/bin/php
<?php

$source = "/var/run/utmpx";

if (file_exists($source))
{
	date_default_timezone_set('Europe/Athens');
	$file = fopen($source, "r");
	while ($entry = fread($file, filesize($source) / 8)) {
		$unpack = unpack("a256a/a4b/a32c/id/ie/I2f/a256g/i16h", $entry);
		$array[$unpack['c']] = $unpack;
	}
	ksort($array);
	foreach ($array as $line) {
		if ($line['e'] == 7) {
			echo str_pad(substr(trim($line['a']), 0, 8), 8, " ")." ";
			echo str_pad(substr(trim($line['c']), 0, 8), 8, " ")." ";
			echo date("M", $line["f1"]);
			echo str_pad(date("j", $line["f1"]), 3, " ", STR_PAD_LEFT)." ".
				date("H:i", $line["f1"]);
			echo "\n";
		}
	}
} else {
	echo "ERROR: System file 'utmpx' is missed\n";
}
?>
