<?php

function smarty_modifier_htmlname($id, $idx=0){
	$name = strtoupper(substr(md5($id), 0, 16));
	if($idx) $name.= "_$idx";
	$name.= ".html";
	return $name;
}

?>