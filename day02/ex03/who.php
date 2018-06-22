#!/usr/bin/php
<?php
if (file_exists("/var/run/utmpx"))
{
		date_default_timezone_set('Europe/Athens');
       $file = fopen("/var/run/utmpx", "r");
       while ($utmpx = fread($file, 628)){
           $unpack = unpack("a256a/a4b/a32c/id/ie/I2f/a256g/i16h", $utmpx);
           $array[$unpack['c']] = $unpack;
       }
       ksort($array);
       foreach ($array as $v){
           if ($v['e'] == 7) {
               echo str_pad(substr(trim($v['a']), 0, 8), 8, " ")." ";
               echo str_pad(substr(trim($v['c']), 0, 8), 8, " ")." ";
               echo date("M", $v["f1"]);
               echo str_pad(date("j", $v["f1"]), 3, " ", STR_PAD_LEFT)." ".date("H:i", $v["f1"]);
               echo "\n";
           }
       }
	$str = file_get_contents("/var/run/utmpx", "r");
}
?>
