<?php
	/*
	* 页面名称：UserInfo.php
	* 页面功能：用户信息管理数据操作
	* 页面类别：数据层
	* 编写日期：2014.05.23
	*/
	
	r_require_once("/classes/GenericDao.php");
	class UserInfo extends GenericDao {
	    
		//获取所有用户信息
	    function getAllUserInfo() {
	    	$sql="SELECT * FROM userinfo";
	        return $this->executeQuery($sql);
	    }
	    
	    //分页显示用户记录
	    function getPagebyUserInfo($pageNum,$pageSize,$offLimit=0) {
	    	$sql = "SELECT * FROM userinfo ORDER BY uid";
	    	return $this->pagedQuery($sql,$pageNum,$pageSize);
	    }
	    
	    //查询记录总行数
	    function getTotalbyUserInfo() {
	    	$sql = "SELECT COUNT(*) AS CNT FROM userinfo";
	    	$row = $this->getOne($sql);
	    	return $row?$row['CNT']:0;
	    }
	    
	    //获取登录用户
	    function getUserInfobyId($uid) {
	    	$sql="SELECT * FROM userinfo where uid=$uid";
	    	return $this->getOne($sql);
	    }
	    
		//用户登录
	    function getUserInfo($username,$password) {
			$passwords = md5($password);
	    	$sql="SELECT * FROM userinfo where username='$username' and password='$passwords'";
	    	return $this->getOne($sql);
	    }
	       
	    //添加用户信息
	    function insertUserInfo($uid,$telAccount,$nationNo,$password,$username,$sex,$email) {
			$passwords = md5($password);
	    	$sql="insert into userinfo(uid,telAccount,nationNo,password,username,sex,email,status) 
			values($uid,'$telAccount','$nationNo','$passwords','$username',$sex,'$email',1)";
	    	return $this->executeInsert($sql);
	    }
	    
	    //修改用户信息
	    function updateUserInfo($uid,$telAccount,$nationNo,$password,$username,$sex,$email,$status) {
	    	$passwords = md5($password);
			$sql="update userinfo set telAccount='$telAccount',nationNo='$nationNo',
			password='$passwords',username='$username',sex=$sex,email='$email',status=$status where uid=$uid";
	    	return $this->executeUpdate($sql);
	    }
	    
	    //删除用户信息
	    function deleteUserInfo($uid)
	    {
	    	$sql="delete from userinfo where uid=$uid";
	    	return $this->executeDelete($sql);
	    }
	}
?>