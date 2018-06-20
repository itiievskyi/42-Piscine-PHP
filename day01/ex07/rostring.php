#!/usr/bin/php
<?php

function ft_split($str)
{
	$arr = preg_split("/ +/", trim($str));
	return (array_filter($arr, 'strlen'));
}
$i = 0;
if ($argc > 1)
{
	$arr = ft_split($argv[1]);
	$size = count($arr);
	if ($size > 1)
		$arr[$size] = $arr[0];
	foreach ($arr as $elem)
	{
		if ($size > 1)
		{
			if ($i > 0)
				echo "$elem";
			$i++;
			if ($arr[$i] && $i > 1)
				echo " ";
			else if ($i > 1)
				echo "\n";
		}
		else
			echo $arr[0]."\n";
	}
}
?>
