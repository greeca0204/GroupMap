<?php
	/*
	 * 页面名称：admin.php
	 * 页面功能：管理员信息管理
	 * 页面类别：业务层
	 * 编写日期：2013.04.07
	 */

	session_start();
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	
	if($_SESSION['username'] == null)
	{
		echo "<script>alert('请先登录！');location.href='index.php';</script>";
	}

	include("../global.inc.php");
	r_require_once("/classes/MultiActions.php");	

	//默认情况时
	function _default()
	{
		r_require_once("/smarty/MySmarty.php");
		r_include_once("/objects/public/paggingbar.php");
		r_require_once("/objects/UserInfo.php");
		
		$tpl = new MySmarty("administrator");		
		$userInfo = new UserInfo();
		
		$tpl->assign("siteTitle","地图");
		
		$pageNum = getRequestIntParam('page_num', 1);
		$pageSize = 15;
		$totalRecords = $userInfo->getTotalbyUserInfo();
		$totalPages = intval($totalRecords / $pageSize);
		$totalPages += ($totalRecords % $pageSize == 0 ? 0 : 1);
		if($pageNum > $totalPages) $pageNum = $totalPages;
		if($totalRecords>0)
			$tpl->assign('userInfo', $userInfo->getPagebyUserInfo($pageNum,$pageSize,0));
		
		$tpl->assign('paggingbar', genPaggingbar('userinfo.php',$pageNum,$totalPages));
		$tpl->display("showUserInfo.html");
	}
	
	//添加、修改管理员页面
	function _new() {
		r_include_once("/smarty/MySmarty.php");
		r_require_once("/objects/UserInfo.php");

		$uid = getRequestIntParam('uid', 0);
		$telAccount = getRequestStringParam('telAccount','');
		$nationNo = getRequestStringParam('nationNo','');
		$password = getRequestStringParam('password', '');
		$username = getRequestStringParam('username', '');	
		$sex = getRequestIntparam('sex',0);
		$email = getRequestStringParam('email', '');
		$status = getRequestStringParam('status', '');
		
		$tpl = new MySmarty('administrator');
		$userInfo = new UserInfo();
		
		$tpl->assign("siteTitle","地图");		
		$tpl->assign("userInfo",$userInfo->getUserInfobyId($uid));
		$tpl->display("editUserInfo.html");
	}
	
	//添加、修改管理员操作
	function _save() {
		r_require_once("/objects/UserInfo.php");
		
		$uid = getRequestIntParam('uid', 0);
		$telAccount = getRequestStringParam('telAccount','');
		$nationNo = getRequestStringParam('nationNo','');
		$password = getRequestStringParam('password', '');
		$username = getRequestStringParam('username', '');	
		$sex = getRequestIntparam('sex',0);
		$email = getRequestStringParam('email', '');
		$status = getRequestStringParam('status', '');
				
		$userInfo = new UserInfo();
		
		if ($uid == 0) {
			$cc = $userInfo->insertUserInfo($uid,$telAccount,$nationNo,$password,$username,$sex,$email);
		} else {
			$cc = $userInfo->updateUserInfo($uid,$telAccount,$nationNo,$password,$username,$sex,$email,$status);
		} 
		
		if ($cc)
        	echo "<script>alert('操作成功！');window.location.href='userInfo.php';</script>";
    	else
        	echo "<script>alert('操作失败！');window.location.href='userInfo.php';</script>";
	}
	
	//删除管理员操作
	function _delete() {
		r_include_once("/objects/UserInfo.php");
		$userInfo = new UserInfo();
		$chk1=$_POST['chk1'];
		if ($chk1!="" or count($chk1)!=0) {
			for ($i=0;$i<count($chk1);$i++){
				$cc = $userInfo->deleteUserInfo($chk1[$i]);
			}
			echo "<script>alert('操作成功！');window.location.href='userInfo.php';</script>";
		}
		else
			echo "<script>alert('操作失败！');window.location.href='userInfo.php';</script>";
	}
?>