#!/usr/bin/php
<?php
	if ($argc == 2)
	{
	$valid = 0;
	$str = ucwords($argv[1]);
	if (substr_count($str,' ') == 4)
		$arr = explode(" ", "$str");
	else
	{
		echo "Wrong Format\n";
		exit(-1);
	}
	$d = array(
		"Monday" => "Lundi",
		"Tuesday" => "Mardi",
		"Wednesday" => "Mercredi",
		"Thursday" => "Jeudi",
		"Friday" => "Vendredi",
		"Saturday" => "Samedi",
		"Sunday" => "Dimanche");
	$m = array(
		"1" => "Janvier",
		"2" => "Fevrier",
		"3" => "Mars",
		"4" => "Avril",
		"5" => "Mai",
		"6" => "Juin",
		"7" => "Juillet",
		"8" => "Aout",
		"9" => "Septembre",
		"10" => "Octobre",
		"11" => "Novembre",
		"12" => "Decembre");
	if (in_array($arr[0], $d))
		$valid += 1;
	if (preg_match("/^(([0-3]){1}([0-9]){1}|([1-9]){1})$/", $arr[1]) &&
		$arr[1] > 0 && $arr[1] < 32)
		$valid += 1;
	if (in_array($arr[2], $m))
		$valid += 1;
	if (preg_match("/^([0-9]){4}$/", $arr[3]) && $arr[3] > 1969)
		$valid += 1;
	$t = explode(":", "$arr[4]");
	if (count($t) != 3)
	{
		echo "Wrong Format\n";
		exit(-1);
	}
	if ((preg_match("/^([0-9]){2}$/", $t[0]) && $t[0] >= 0 && $t[0] < 24) &&
		(preg_match("/^([0-9]){2}$/", $t[1]) && $t[1] >= 0 && $t[1] < 60) &&
		(preg_match("/^([0-9]){2}$/", $t[2]) && $t[2] >= 0 && $t[2] < 60))
		$valid += 1;
	if ($valid != 5)
	{
		echo "Wrong Format\n";
		exit(-1);
	}
	$jd = cal_to_jd(CAL_GREGORIAN, array_search($arr[2], $m),$arr[1],$arr[3]);
	if (jddayofweek($jd,1) == array_search($arr[0], $d))
	{
		$stamp .= $arr[3].'-'.array_search($arr[2], $m).'-'.$arr[1].' '.$arr[4];
		$time2 = strtotime($stamp);
		echo "$stamp\n";
		$time1 = strtotime("1970-01-01 01:00:00");
		$diff = $time2-$time1;
		echo "$diff\n";
	}
	else
	{
		echo "Wrong Format\n";
		exit(-1);
	}
}
?>
