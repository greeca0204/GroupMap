<?php

/**
 * 数据源类
 * @version 1.0
 */
class DataSource {	
	
	/**
	 * 主机
	 *
	 * @var string
	 */
	var $host;
	
	/**
	 * 用户名
	 *
	 * @var string
	 */
	var $user;
	
	/**
	 * 密码
	 *
	 * @var string
	 */
	var $password;
	
	/**
	 * 数据库名
	 * 注：当在MSSQL的时候，如果数据库是以数字开头的，请用[]号把数据库名括起来
	 * @var string
	 */
	var	$dbName;
	
	/**
	 * 数据库字符集
	 *
	 * @var unknown_type
	 */
	var $charset;

	function DataSource($host,$user,$password,$dbName,$charset){

		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->dbName = $dbName;
		$this->charset = $charset;

	}

}

/**
 * 缺省的数据源
 */
class DefaultDataSource extends DataSource {

	function DefaultDataSource(){
		$this->host = "localhost";
		$this->user = "root";
		$this->password = "";
		$this->dbName = "groupmap";
		$this->charset = "utf8";
	}

}
?>