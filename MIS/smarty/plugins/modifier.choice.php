<?php
function smarty_modifier_choice($index,$string){
	$choices = explode(",",$string);
	return $choices[$index];
}
?>