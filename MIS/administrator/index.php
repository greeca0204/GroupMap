<?php
	/*
	 * 页面名称：index.php
	 * 页面功能：用户登录
	 * 页面类别：业务层
	 * 编写日期：2013.04.07
	 */

	session_start();
	header('Content-Type: text/html; charset=UTF-8');	
	include("../global.inc.php");
	r_require_once("/classes/MultiActions.php");
		
	//默认情况时
	function _default()
	{
		r_include_once("/smarty/MySmarty.php");
		$tpl = new MySmarty('administrator');
		$tpl->assign("siteTitle","广州运星科技有限公司用户登录");
		$tpl->display("login.html");
	}
	
	//登录操作
	function _login() {
		r_require_once("/objects/Admin.php");
		
		$username = getRequestStringParam('username', '');
		$password = getRequestStringParam('password', '');
		$checked = getRequestIntparam('checked',0);
		
		if($checked==1)
		{
			$admin = new Admin();		
			$cc = $admin->getAdmin($username,$password);
			
			if($cc != null)
			{
				$_SESSION['username']=$username;
				echo "<script>alert('登录成功！');location.href='default.php';</script>";
			}				
			else
				echo "<script>alert('登录失败！');location.href='index.php';</script>";
		}
	}
	
	//注销操作
	function _loginout(){
		session_destroy();
		echo "<script>alert('注销成功！');window.parent.location.href='index.php';</script>"; 
	}
?>