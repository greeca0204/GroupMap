<?php

function smarty_modifier_htmlpaths($enName, $yy, $md){
	if(!$enName) $enName = 'other';
	if(!$yy) $yy = '00';
	if(!$md) $md = '0000';
	return ROOT_PATH."/html/$enName/$yy/$md/";
}

?>