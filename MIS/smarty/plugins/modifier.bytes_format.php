<?php

	function smarty_modifier_bytes_format($string, $len=2) {
		$bytes = intval($string);
		$labels = array(' bytes',' KB',' MB',' GB',' TB');
		for($x = 0; $bytes >= 1024 && $x < (count($labels) - 1); $bytes /= 1024, $x++);
		return(round($bytes, $len).$labels[$x]);
	}

?>