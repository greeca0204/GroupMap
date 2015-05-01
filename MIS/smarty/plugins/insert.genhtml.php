<?php
function smarty_insert_genhtml($params) {
	$content = ob_get_contents();
	$paths = $params['paths'];
	if(!is_dir($paths)) mkdirs($paths, 0777);
	$file = $params['file'];
	if($fp = @fopen("$paths/$file", 'wb')) {
		fwrite($fp, $content);
		fclose($fp);
	}

}
?>