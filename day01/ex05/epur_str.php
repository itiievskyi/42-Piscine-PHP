#!/usr/bin/php
<?php
if ($argc > 1)
{
	$str = trim($argv[1]);
	$str = preg_replace('/ +/', ' ', $str);
	if ($str)
		echo "$str"."\n";
}
?>
