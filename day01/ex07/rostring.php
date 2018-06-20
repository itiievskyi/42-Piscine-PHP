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
	$arr[$size] = $arr[0];
	unset($arr[0]);
	foreach ($arr as $elem)
	{
		echo "$elem";
		$i++;
		if ($i < $size)
			echo " ";
		else
			echo "\n";
	}
}
?>
