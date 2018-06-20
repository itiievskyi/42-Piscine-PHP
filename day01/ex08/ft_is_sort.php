<?php
function ft_is_sort($tab)
{
	$temp = $tab;
	sort($temp);
	if ($temp == $tab)
		return (TRUE);
	else
		return(FALSE);
}
?>
