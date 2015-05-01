<?php
function smarty_modifier_toutf8($string){
	return iconv("gb2312","utf-8",$string);
}
?>