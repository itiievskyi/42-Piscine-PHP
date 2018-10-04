#!/usr/bin/php
<?php
if ($argc == 2)
{

	$folder = str_replace('https://', '', $argv[1]);
	$folder = str_replace('http://', '', $folder);

	$url = $argv[1];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$str = curl_exec($ch);

	$arr = array();
	preg_match_all("/<IMG[^>]+.jpg+/i", $str, $matches);
	$arr = array_merge($arr, $matches[0]);
	preg_match_all("/<IMG[^>]+.svg+/i", $str, $matches);
	$arr = array_merge($arr, $matches[0]);
	preg_match_all("/<IMG[^>]+.png+/i", $str, $matches);
	$arr = array_merge($arr, $matches[0]);
	preg_match_all("/<IMG[^>]+.jpeg+/i", $str, $matches);
	$arr = array_merge($arr, $matches[0]);
	preg_match_all("/<IMG[^>]+.gif+/i", $str, $matches);
	$arr = array_merge($arr, $matches[0]);

	if (count($arr) == 0) {
		echo "The page is invalid doesn't content proper image files\n";
		return;
	}
	foreach ($arr as $pic) {
		$temp[] = substr($pic, strrpos($pic, '"') + 1);
	}
	if (count($temp) == 0) {
		echo "The page is invalid doesn't content proper image files\n";
		return;
	}
	foreach ($temp as $link)
	{
		if (($link)[0] == '/' && $link != "")
			$final[] = $argv[1].$link;
		else if ($link != "")
			$final[] = $link;
	}
	if (count($final) == 0) {
		echo "The page is invalid doesn't content proper image files\n";
		return;
	} else {
		if (!file_exists($folder)) {
			mkdir($folder, 0755, true);
		}
		foreach ($final as $image) {
			$ch = curl_init ($image);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 2);
			$rawdata=curl_exec($ch);
			curl_close ($ch);
			$name = substr($image, strrpos($image, '/') + 1);
			if (!file_exists("$folder/$name")) {
				$fp = fopen("$folder/$name",'x');
				fwrite($fp, $rawdata);
				fclose($fp);
			}
		}
	}

} else {
	$arg = $argc - 1;
	echo "There can be only one argument (you have $arg)\n";
}
?>
