<?php

require_once("Smarty.class.php");
require_once(ROOT_PATH.'/objects/Cookie.php');

class MySmarty extends Smarty {

	function MySmarty($baseDir = false) {
		$cookie = new Cookie();
		$this->Smarty();
		$this->assign('TempPath', '/templates/default');
		if($baseDir) {
			$this->template_dir = ROOT_PATH."/".$baseDir."/templates/";
			$tc = ROOT_PATH."/smarty/templates_c/".$baseDir."/";
			if(!is_dir($tc)) mkdir($tc, 0777);
			$this->compile_dir = $tc;
		} else {
			$this->template_dir = ROOT_PATH."/templates/".$cookie->getTemplate()."/";
			$tc = ROOT_PATH."/smarty/templates_c/".$cookie->getTemplate()."/";
			if(!is_dir($tc)) mkdir($tc, 0777);
			$this->compile_dir = $tc;
		}
		
		$this->config_dir = ROOT_PATH."/smarty/configs/";
		$this->cache_dir = ROOT_PATH."/smarty/cache/";
		$this->left_delimiter = "{{";
		$this->right_delimiter = "}}";
		$this->caching = 0;
		$cookie = null;
	}
	
	function setCss($css) {
		$this->assign('CSSArray', $css);
	}
	
	function setJs($js) {
		$this->assign('JSArray', $js);
	}
	
	function setTplCss($css) {
		$cookie = new Cookie();
		foreach ($css as $key) {
			$cssArray[] = $cookie->getTemplate().'/css/'.$key;
		}
		$this->assign('TPLCSSArray', $cssArray);
		$cookie = null;
	}
	
	function setTplJs($js) {
		$cookie = new Cookie();
		foreach ($js as $key) {
			$jsArray[] = $cookie->getTemplate().'/js/'.$key;
		}
		$this->assign('TPLJSArray', $jsArray);
		$cookie = null;
	}
	
	function setTpl($tplName) {
		$cookie = new Cookie();
		$cookie->setTemplate($tplName);
		$cookie = null;
	}

}	
?>