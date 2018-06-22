#!/usr/bin/php
<?php
if ($argc == 2)
{
	$url = $argv[1];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$str = curl_exec($ch);

	$arr = array();
	preg_match("/<img[^>]+.jpg+/i", $str, $matches);
	$arr = array_merge($arr, $matches);
	preg_match("/<img[^>]+.svg+/i", $str, $matches);
	$arr = array_merge($arr, $matches);
	preg_match("/<img[^>]+.png+/i", $str, $matches);
	$arr = array_merge($arr, $matches);
	preg_match("/<img[^>]+.jpeg+/i", $str, $matches);
	$arr = array_merge($arr, $matches);
	preg_match("/<img[^>]+.gif+/i", $str, $matches);
	$arr = array_merge($arr, $matches);

	foreach ($arr as $pic)
	{
		$pics[] = strstr($pic, "src");
		str_replace(" ", "", $pic);
	}
	foreach ($arr as $pic)
		$temp[] = explode("src=\"", $pic)[1];
	foreach ($temp as $link)
	{
		if (($link)[0] == '/')
			$final[] = $argv[1].$link;
		else
			$final[] = $link;
	}
	PRINT_R($final);

}
?>
