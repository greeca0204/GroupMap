<?php
function smarty_modifier_iconv($string, $incharset, $outcharset){
	return iconv($incharset, $outcharset, $string);
}
?>