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
		r_require_once("/objects/Admin.php");
		
		$tpl = new MySmarty("administrator");		
		$admin = new Admin();
		
		$tpl->assign("siteTitle","广州运星科技有限公司后台管理系统");
		
		$pageNum = getRequestIntParam('page_num', 1);
		$pageSize = 15;
		$totalRecords = $admin->getTotalbyAdmin();
		$totalPages = intval($totalRecords / $pageSize);
		$totalPages += ($totalRecords % $pageSize == 0 ? 0 : 1);
		if($pageNum > $totalPages) $pageNum = $totalPages;
		if($totalRecords>0)
			$tpl->assign('admin', $admin->getbyAdmin($pageNum,$pageSize,0));
		
		$tpl->assign('paggingbar', genPaggingbar('admin.php',$pageNum,$totalPages));
		$tpl->display("showAdmin.html");
	}
	
	//添加、修改管理员页面
	function _new() {
		r_include_once("/smarty/MySmarty.php");
		r_require_once("/objects/Admin.php");

		$id = getRequestIntParam('id', 0);
		$username = getRequestStringParam('username', '');
		$password = getRequestStringParam('password', '');
		$checked = getRequestIntparam('checked',0);
		$pwd = getRequestStringParam('pwd', '');
		
		$tpl = new MySmarty('administrator');
		$admin = new Admin();
		
		$tpl->assign("siteTitle","广州运星科技有限公司后台管理系统");		
		$tpl->assign("admin",$admin->getAdminbyId($id));
		$tpl->display("editAdmin.html");
	}
	
	//添加、修改管理员操作
	function _save() {
		r_require_once("/objects/Admin.php");
		
		$id = getRequestIntParam('id', 0);
		$username = getRequestStringParam('username', '');
		$password = getRequestStringParam('password', '');
		$checked = getRequestIntparam('checked',0);
		$pwd = getRequestStringParam('pwd', '');
				
		$admin = new Admin();
		
		if ($id == 0) {
			$cc = $admin->insertAdmin($username,$password,$checked);
		} else {
			$cc = $admin->updateAdmin($id,$username,$password,$checked);
		} 
		
		if ($cc)
        	echo "<script>alert('操作成功！');window.location.href='admin.php';</script>";
    	else
        	echo "<script>alert('操作失败！');window.location.href='admin.php';</script>";
	}
	
	//删除管理员操作
	function _delete() {
		r_include_once("/objects/Admin.php");
		$admin = new Admin();
		$chk1=$_POST['chk1'];
		if ($chk1!="" or count($chk1)!=0) {
			for ($i=0;$i<count($chk1);$i++){
				$cc = $admin->deleteAdmin($chk1[$i]);
			}
			echo "<script>alert('操作成功！');window.location.href='admin.php';</script>";
		}
		else
			echo "<script>alert('操作失败！');window.location.href='admin.php';</script>";
	}
?>