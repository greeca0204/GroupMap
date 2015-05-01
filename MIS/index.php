<?php
	/*
	 * 页面名称：index.php
	 * 页面功能：网站前台
	 * 页面类别：业务层
	 * 编写日期：2013.05.07
	 */
	
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	include("global.inc.php");
	r_require_once("/classes/MultiActions.php");
	

	//主页
	function _default()
	{
		r_include_once("/smarty/MySmarty.php");
		$tpl = new MySmarty();
		$tpl->assign("siteTitle","百度地图展示");
		$tpl->display("index2.html");
	}
?>