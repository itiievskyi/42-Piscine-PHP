#!/usr/bin/php
<?php

function is_op($check)
{
	if ($check && strchr("+-*/%", $check))
		return (1);
	return (0);
}

function ft_atoi($line)
{
	$sign = 1;
	$x = 0;
	$result = 0;
	if ($line[$x] == '-')
	{
		$sign = -1;
		$x++;
	}
	if ($line[$x] == '+')
		$x++;
	while (is_numeric($line[$x]))
		$result = $result * 10 + $line[$x++];
	return ($result * $sign);
}

if ($argc != 2)
	echo "Incorrect Parameters\n";
else
{
	$i = 0;
	$error = 0;
	$str = trim($argv[1]);
	$str = preg_replace('/ +/', ' ', $str);
	if ($str && is_numeric($str[$i]) ||
	(($str[$i] == '-' || $str[$i] == '+') && is_numeric($str[$i + 1])))
	{
		$a = ft_atoi($str, $error);
		$i++;
	}
	else
		$error = 1;
	while (is_numeric($str[$i]))
		$i++;
	if ($str[$i] != ' ' && !is_op($str[$i]))
		$error = 1;
	if ($error)
	{
		echo "Syntax Error\n";
		return (0);
	}
	while ($str[$i] == ' ')
		$i++;
	if (is_op($str[$i]))
		$op = $str[$i++];
	else
		$error = 1;
	while ($str[$i] == ' ')
		$i++;
	if (is_numeric($str[$i]) ||
	(($str[$i] == '-' || $str[$i] == '+') && is_numeric($str[$i + 1])))
	{
		$b = ft_atoi(substr($str, $i), $error);
		$i++;
	}
	else
		$error = 1;
	while (is_numeric($str[$i]))
		$i++;
	while ($str[$i] == ' ')
		$i++;
	if ($str[$i])
		$error = 1;
	if ($error)
	{
		echo "Syntax Error\n";
		return (0);
	}
}
if (!$error)
{
	if ($b == 0 && ($op == "/" || $op == "%"))
		echo "0 mustn't be a denominator!\n";
	else if ($op == "+")
		echo $a + $b."\n";
	else if ($op == "-")
		echo $a - $b."\n";
	else if ($op == "/")
		echo $a / $b."\n";
	else if ($op == "*")
		echo $a * $b."\n";
	else if ($op == "%")
		echo $a % $b."\n";
}
?>
