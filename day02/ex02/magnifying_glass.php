#!/usr/bin/php
<?php
if ($argc == 2 && file_exists($argv[1])) {

	$str = file_get_contents($argv[1]);

	$str = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/si",
	function($matches) {
		$matches[0] = preg_replace_callback("/( title=\")(.*?)(\")/mi",
		function($matches)
			{
				return ($matches[1]."".strtoupper($matches[2])."".$matches[3]);
			}, $matches[0]);
		$matches[0] = preg_replace_callback("/(>)(.*?)(<)/si",
		function($matches) {
			return ($matches[1]."".strtoupper($matches[2])."".$matches[3]);
		}, $matches[0]);
		return ($matches[0]);
	},
	$str);

	echo $str;
} else if ($argc != 2) {
	$arg = $argc - 1;
	echo "There can be only one argument (you have $arg)\n";
} else if (!file_exists($argv[1])) {
	echo "ERROR: Specified file doesn't exist\n";
}
?>
