#!/usr/bin/php
<?php
if ($argc < 3)
	return (0);
$my_key = $argv[1];
$i = 0;
foreach ($argv as $elem)
{
	if ($i > 1 && $elem)
	{
		$temp = explode(":", $elem);
		if (!strcmp($my_key, $temp[0]) && count($temp) == 2)
			$result = $temp[1];
	}
	$i++;
}
if ($result)
	echo $result."\n";
?>
