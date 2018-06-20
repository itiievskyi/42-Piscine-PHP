#!/usr/bin/php
<?php
if ($argc != 2)
	return (0);

$arr = file('php://stdin');
unset($arr[0]);

if ($argv[1] == "average")
{
	$grade = 0;
	$count = 0;
	foreach ($arr as $elem)
	{
		$temp = explode(";", $elem);
		if ($temp[1] != '' && $temp[2] != "moulinette")
		{
			$grade += $temp[1];
			$count++;
		}
	}
	if ($count > 0)
		echo $grade / $count."\n";
}
if ($argv[1] == "average_user")
{
	asort($arr);
	$count = 0;
	foreach ($arr as $elem)
	{
		$temp = explode(";", $elem);
		$list[$temp[0]] = 0;
	}
	foreach ($list as $user => $key)
	{
		$count = 0;
		$grade = 0;
		foreach ($arr as $elem)
		{
			$temp = explode(";", $elem);
			if ($temp[1] != '' && $temp[0] == $user && $temp[2] != "moulinette")
			{
				$grade += $temp[1];
				$count++;
			}
		}
		if ($count > 0)
			echo $user.":".($grade / $count)."\n";
	}
}
if ($argv[1] == "moulinette_variance")
{
	asort($arr);
	$count = 0;
	foreach ($arr as $elem)
	{
		$temp = explode(";", $elem);
		$list[$temp[0]] = 0;
	}
	foreach ($list as $user => $key)
	{
		$count = 0;
		$grade = 0;
		$mouli = 0;
		foreach ($arr as $elem)
		{
			$temp = explode(";", $elem);
			if ($temp[1] != '' && $temp[0] == $user && $temp[2] == "moulinette")
				$mouli = $temp[1];
		}
		foreach ($arr as $elem)
		{
			$temp = explode(";", $elem);
			if ($temp[1] != '' && $temp[0] == $user && $temp[2] != "moulinette")
			{
				$grade += $temp[1] - $mouli;;
				$count++;
			}
		}
		if ($count > 0)
			echo $user.":".($grade / $count)."\n";
	}
}
?>
