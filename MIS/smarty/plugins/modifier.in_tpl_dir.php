<?php
	function smarty_modifier_in_tpl_dir($string, $http=true) {
		global $tpl;
		$path = $tpl->template_dir.$string;
		return $http ? substr($path, strlen(ROOT_PATH)) : $path;
	}
	/**
	 * 使用方法�?
	 * {{'images/logo.gif'|in_tpl_dir}}
	 * 或�??
	 * {{'images/logo.gif'|in_tpl_dir:false}}
	 */
?>