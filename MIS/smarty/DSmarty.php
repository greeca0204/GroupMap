<?php

require_once("Smarty.class.php");

class MySmarty extends Smarty {

	private $MyTemplate;
	
	function MySmarty($baseDir = false, $template = "") {
		
		//$this->MyTemplate = $template;
		
		$this->Smarty();
		
		if($baseDir && $baseDir!="..") {
			$this->template_dir = ROOT_PATH."/".$baseDir."/templates/".$template."/";
			
			$this->MyTemplate = $baseDir."/templates/".$template."/";
			$this->assign('TemplatePath', $this->MyTemplate);
			
			$tc = ROOT_PATH."/smarty/templates_c/".$baseDir."/";
			if(!is_dir($tc)) mkdir($tc, 0777);
			
			$tc.=$template."/";
			if(!is_dir($tc)) mkdir($tc, 0777);
			
			$this->compile_dir = $tc;
		} else {
			if ($template)
				$template.= "/";
				
			$this->template_dir = ROOT_PATH."/templates/".$template;
			
			if ($baseDir==".."){
				$this->MyTemplate = "../templates/".$template;
			}else 
				$this->MyTemplate = "templates/".$template;
				
			$this->assign('TemplatePath', $this->MyTemplate);
			
			$tc = ROOT_PATH."/smarty/templates_c/".$template;
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
		//$cookie = new BaseCookie();
		foreach ($css as $key) {
			//$cssArray[] = $cookie->getTemplate().'/css/'.$key;
			$cssArray[] = $this->MyTemplate.'css/'.$key;
		}
		$this->assign('TPLCSSArray', $cssArray);
		$cookie = null;
	}
	
	function setTplJs($js) {
		//$cookie = new BaseCookie();
		foreach ($js as $key) {
			//$jsArray[] = $cookie->getTemplate().'/js/'.$key;
			$jsArray[] = $this->MyTemplate.'js/'.$key;
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