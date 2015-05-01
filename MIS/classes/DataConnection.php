<?php
/**
 * 通用查询类接口
 * @author 曾新干
 * @version 1.0
 */

interface DataConnection {
	
	/**
	 * 执行查询
	 *
	 * @param string $sql
	 * @return array or null
	 */
	function executeQuery($sql);
	
	/**
	 * 分页查询
	 *
	 * @param string $sql
	 * @param int $pageNum
	 * @param int $pageSize
	 * @return array or null
	 */
	function pagedQuery($sql,$pageNum,$pageSize);
	
	/**
	 * 获取结果集中的第一行
	 *
	 * @param string $sql
	 * @return array or null
	 */
	function getOne($sql);
	
	/**
	 * 执行SQL语句
	 *
	 * @param string $sql
	 * @return true or false
	 */
	function executeUpdate($sql);
	
	/**
	 * 执行插入的SQL语句
	 *
	 * @param string $sql
	 * @return int 自增的ID
	 */
	function executeInsert($sql);
	
	/**
	 * 执行删除的SQL语句
	 *
	 * @param string $sql
	 * @return true or false
	 */
	function executeDelete($ql);
	
}

?>