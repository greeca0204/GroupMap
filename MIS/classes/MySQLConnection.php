<?php

require_once('DataSource.php');
require_once('DataConnection.php');

class MySQLConnection implements DataConnection {

	/**
	 * 持久性的数据库连接
	 *
	 * @var php resource
	 */
	var $db;

	// 构造器
	function MySQLConnection($datasource = NULL){
		
		if ($datasource == NULL) $datasource = new DefaultDataSource();

		$this->db = mysql_pconnect($datasource->host,$datasource->user,$datasource->password);
		if ($this->db == false){
			echo(mysql_error());
		}else{
			mysql_select_db($datasource->dbName,$this->db);
			if ($datasource){
				if ($datasource->charset){
					mysql_query("SET NAMES ".$datasource->charset,$this->db);
				}
			}
		}

	}

	// 执行查询
	function executeQuery($sql){

		$resultSet = "";
		$resultCount = 0;

		$result = mysql_query($sql,$this->db);
		if($result == false){
			echo(mysql_error());
		}else{
			while($row = mysql_fetch_array($result)){
				$resultSet[$resultCount] = $row;
				$resultCount++;
			}
			mysql_free_result($result);
		}

		return $resultCount == 0 ? null : $resultSet;

	}

	// 分页查询
	function pagedQuery($sql,$pageNum,$pageSize){

		if ($pageNum<1) $pageNum = 1;
		$from = ($pageNum-1) * $pageSize;
		$limitation = " LIMIT $from,$pageSize";
		$sql.=$limitation;

		return $this->executeQuery($sql);

	}

	// 获取结果集中的第一行
	function getOne($sql){
		$result = $this->executeQuery($sql);
		return ($result!=null && count($result)>=1) ? $result[0] : null;
	}

	// 执行修改的SQL语句
	function executeUpdate($sql){
		if (mysql_query($sql,$this->db)===false)
			return false;
		else
			return mysql_affected_rows($this->db);
	}

	// 执行插入的SQL语句
	function executeInsert($sql){
		$gid = 0;
		$result = $this->executeUpdate($sql);
		if ($result>0){
			$gid = @mysql_insert_id();
		}
		return $gid;
	}

	// 执行删除的SQL语句
	function executeDelete($sql){
		if($result = mysql_query($sql,$this->db)==false)
			return false;
		else
			return mysql_affected_rows($this->db);
	}
}
?>