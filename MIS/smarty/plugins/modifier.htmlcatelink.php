<?php

function smarty_modifier_htmlcatelink($enName){
	if(!$enName) $enName = 'other';
	return "/html/$enName/";
}

?>