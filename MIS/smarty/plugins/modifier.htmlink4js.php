<?php

function smarty_modifier_htmlink4js($id, $enName, $yy, $md){
	if(!$enName) $enName = 'other';
	if(!$yy) $yy = '00';
	if(!$md) $md = '0000';
	$name = strtoupper(substr(md5($id), 0, 16));
	return "/html/$enName/$yy/$md/".$name;
}

?>