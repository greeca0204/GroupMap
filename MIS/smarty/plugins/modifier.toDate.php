<?php
function smarty_modifier_toDate($string){
	return substr($string,0,4)."-".substr($string,4,2)."-".substr($string,6,2);
}
?>