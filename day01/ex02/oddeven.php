#!/usr/bin/php
<?php
$str = fopen("php://stdin", "r");
while ($str && !feof($str))
{
	echo "Enter a number: ";
	$number = fgets($str);
	if ($number)
	{
		$number = str_replace("\n", "", $number);
		if (is_numeric($number))
		{
			if ($number % 2 == 0)
				echo "The number " . $number . " is even\n";
			else
				echo "The number " . $number . " is odd\n";
		}
		else
			echo "'" . $number . "' is not a number\n";
	}
}
echo "\n";
?>
