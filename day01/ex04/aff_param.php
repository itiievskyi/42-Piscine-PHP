#!/usr/bin/php
<?php
$arg = 1;
foreach ($argv as $elem)
{
	if ($arg++ > 1)
		echo "$elem"."\n";
}
?>
