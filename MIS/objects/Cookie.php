<?php
	/*
 	 * 页面名称：Cookie.php
	 * 页面功能：Cookie操作
	 * 页面类别：数据层
	 * 编写日期：2013.05.07
	 */

	//禁止外部调用
	if (!defined("RUNNING")) die("Invalid Operation!");

	class Cookie {
		
		//保存在浏览器中的模板cookie名称
		const COOKIE_TEMPLATE = 'COOKIE_TEMPLATE';
		//模板cookie失效时间，单位：秒
		const COOKIE_TEMPLATE_EXPIRE = 0x15180; //24小时
		
		//管理员操作id
		const COOKIE_ADMIN_OPERATION_ID = 'COOKIE_ADMIN_OPERATION_ID';
		const COOKIE_ADMIN_OPERATION_ID_EXPIRE = 3600;
		
		var $template;
		
		function Cookie() {
			//设置模板cookie生效
			$this->_setTemplateCookie();
		}
		
		private function _setTemplateCookie() {
			//取cookie中模板
			@$this->template = $_COOKIE[Cookie::COOKIE_TEMPLATE];
			if(!isset($this->template) || empty($this->template)) {
				//没有模板cookie
				$this->template = 'default';
				setcookie(Cookie::COOKIE_TEMPLATE, $this->template, time()+Cookie::COOKIE_TEMPLATE_EXPIRE);
			} else if(!is_dir(ROOT_PATH.'/templates/'.$this->template)) {
				//检查该template是否存在
				$this->template = 'default';
			}
		}
		
		function getTemplate() {
			return $this->template;
		}
		
		function setTemplate($template) {
			$this->template = $template;
			setcookie(Cookie::COOKIE_TEMPLATE, $template, time()+Cookie::COOKIE_TEMPLATE_EXPIRE);
		}
		
		//设置管理员操作id
		function setAdminOperationId($oid) {
			setcookie(Cookie::COOKIE_ADMIN_OPERATION_ID, $oid, time()+Cookie::COOKIE_ADMIN_OPERATION_ID_EXPIRE);
		}
		
		//管理员操作id
		//带时间顺延
		function getAdminOperationId() {
			$oid = $_COOKIE[Cookie::COOKIE_ADMIN_OPERATION_ID];
			if($oid)
				$this->setAdminOperationId($oid);
			return $oid == null ? '' : $oid;
		}
		
		//管理员操作id
		function clearAdminOperationId() {
			setcookie(Cookie::COOKIE_ADMIN_OPERATION_ID, $oid, 0);
		}		
	}
?>