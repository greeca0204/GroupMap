<?php

function smarty_modifier_htmlfile($id, $enName, $yy, $md, $idx=0){
	if(!$enName) $enName = 'other';
	if(!$yy) $yy = '00';
	if(!$md) $md = '0000';
	return ROOT_PATH."/html/$enName/$yy/$md/".htmlname($id, $idx);
}

?>