<?php
	/*
	* 页面名称：Admin.php
	* 页面功能：管理员信息管理数据操作
	* 页面类别：数据层
	* 编写日期：2013.05.07
	*/
	
	r_require_once("/classes/GenericDao.php");
	class Admin extends GenericDao {
	    
		//获取所有管理员
	    function getAllAdmin() {
	    	$sql="SELECT * FROM tb_admin";
	        return $this->executeQuery($sql);
	    }
	    
	    //分页显示管理员记录
	    function getbyAdmin($pageNum,$pageSize,$offLimit=0) {
	    	$sql = "SELECT * FROM tb_admin ORDER BY id";
	    	return $this->pagedQuery($sql,$pageNum,$pageSize);
	    }
	    
	    //查询记录总行数
	    function getTotalbyAdmin() {
	    	$sql = "SELECT COUNT(*) AS CNT FROM tb_admin";
	    	$row = $this->getOne($sql);
	    	return $row?$row['CNT']:0;
	    }
	    
	    //获取登录管理员
	    function getAdminbyId($id) {
	    	$sql="SELECT * FROM tb_admin where id=$id";
	    	return $this->getOne($sql);
	    }
	    
		//后台登录
	    function getAdmin($username,$password) {
			$passwords = md5($password);
	    	$sql="SELECT * FROM tb_admin where username='$username' and password='$passwords' and checked=1";
	    	return $this->getOne($sql);
	    }
	       
	    //添加管理员信息
	    function insertAdmin($username,$password,$checked) {
			$passwords = md5($password);
			//$username = iconv("utf-8","gb2312",$username);
	    	$sql="insert into tb_admin(username,password,checked,pwd) values('$username','$passwords',$checked,'$password')";
	    	return $this->executeInsert($sql);
	    }
	    
	    //修改管理员信息
	    function updateAdmin($id,$username,$password,$checked) {
	    	$passwords = md5($password);
			//$username = iconv("utf-8","gb2312",$username);
			$sql="update tb_admin set username='$username',password='$passwords',checked=$checked,pwd='$password' where id=$id";
	    	return $this->executeUpdate($sql);
	    }
	    
	    //删除管理员信息
	    function deleteAdmin($id)
	    {
	    	$sql="delete from tb_admin where id=$id";
	    	return $this->executeDelete($sql);
	    }
	}
?>