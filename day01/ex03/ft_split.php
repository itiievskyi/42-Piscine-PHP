<?php
	function ft_split($str)
	{
		$arr = preg_split("/ +/", trim($str));
		sort($arr);
		if (!count($arr) || !$arr[0])
			return(NULL);
		return ($arr);
	}
?>
