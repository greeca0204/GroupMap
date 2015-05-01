<?php
r_require_once("/classes/MySQLConnection.php");

class GenericDao {
	
	private $connection;
	
	function GenericDao($ds=null) {
		$this->checkConnection($ds);
	}
	
	function checkConnection($ds){
		if($this->connection == null) {
			static $page_connection;
			if (is_object($page_connection)){
				$this->connection = $page_connection;
			}else{
				$this->connection = $page_connection = new MySQLConnection($ds);
			}
		}
	}
	
	function getOne($sql) {
		if($this->connection == null) {
			$this->connection = new MySQLConnection();
		}
		return $this->connection->getOne($sql);
	}
	
	function executeQuery($sql) {
		return $this->connection->executeQuery($sql);
	}
	
	function executeInsert($sql) {
		return $this->connection->executeInsert($sql);
	}
	
	function executeUpdate($sql) {
		return $this->connection->executeUpdate($sql);
	}
	
	function executeDelete($sql) {
		return $this->connection->executeDelete($sql);
	}
	
	function pagedQuery($sql,$pageNum,$pageSize){
		return $this->connection->pagedQuery($sql,$pageNum,$pageSize);
	}
	
}

?>
