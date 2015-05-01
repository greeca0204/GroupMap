<?php

/**
 * 定义
 */
//定义运行
if (!defined("RUNNING")) define("RUNNING","RUNNING");
//站点根目录
if (!defined("ROOT_PATH")) define("ROOT_PATH",getRootPath());

define("VALIDATE",false);
define('DISCUZ_ROOT', './bbs/');

//session_start();

/**
 * 通用函数
 */

/**
 * 获取站点根目录
 *
 * @return string
 */
function getRootPath(){
	$filePath = dirname(__FILE__);
	return $filePath;
}

/**
 * 根据站点根目录的include
 *
 * @param string $file
 */
function r_include($file){
	include(ROOT_PATH.$file);
}

/**
 * 根据站点根目录的include_once
 *
 * @param string $file
 */
function r_include_once($file){
	include_once(ROOT_PATH.$file);
}

/**
 * 根据站点根目录的require
 *
 * @param string $file
 */
function r_require($file){
	require(ROOT_PATH.$file);
}

/**
 * 根据站点根目录的require_once
 *
 * @param string $file
 */
function r_require_once($file){
	require_once(ROOT_PATH.$file);
}

/* 对用户传入的变量进行转义操作*/
if (!get_magic_quotes_gpc()) {
	if (!empty($_GET)) {
		$_GET  = addslashes_deep($_GET);
	}
	if (!empty($_POST)) {
		$_POST = addslashes_deep($_POST);
	}
	$_COOKIE   = addslashes_deep($_COOKIE);
	$_REQUEST  = addslashes_deep($_REQUEST);
}

function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}
function getParam($param, $defualtValue) {
	if(!isset($param) || strlen($param)==0)
		$param = $defualtValue;
	return $param;
}
//上传图片
function uploadImgage($inputName) {
		$file = $_FILES[$inputName]['tmp_name'];
		$fileName = $_FILES[$inputName]['name'];
		$dest = "";
		if($file) {
			$exName = strtolower(substr($fileName,(strrpos($fileName,'.')+1)));
			if ($exName=='jpg' || $exName=='jpeg' || $exName=='gif' || $exName=='png') {
			$destDir = '/upload/'.date('Ymd').'/';
			if(!is_dir(getRootPath().$destDir)) mkdir(getRootPath().$destDir, 0777);
			$dest = $destDir.date("YmdHis").'_'.genRandomNumberString(5).'.'.$exName;
			if(move_uploaded_file($file, getRootPath().$dest) && $_FILES[$inputName]['error'] == 0)
				chmod(getRootPath().$dest, 0755);
			else $dest = "";
			} else {
				echo "格式不适合";
			}
		}
		return $dest;
}
//文件上传
function uploadFile($inputName) {
		$file = $_FILES[$inputName]['tmp_name'];
		$fileName = $_FILES[$inputName]['name'];
		$dest = "";
		if($file) {
			$exName = strtolower(substr($fileName,(strrpos($fileName,'.')+1)));
			$destDir = '/upload/'.date('Ymd').'/';
			if(!is_dir(getRootPath().$destDir)) mkdir(getRootPath().$destDir, 0777);
			$dest = $destDir.date("YmdHis").'_'.genRandomNumberString(5).'.'.$exName;
			if(move_uploaded_file($file, getRootPath().$dest) && $_FILES[$inputName]['error'] == 0)
				chmod(getRootPath().$dest, 0755);
			else $dest = "";
		}
		return $dest;
}

//产生随机数字符串
function genRandomNumberString($len) {
		$rs = '';
		for($i=0; $i<$len; $i++)
			$rs.=rand(0,9);
		return $rs;
	}

function authcode($string, $operation, $key = '') {
	global $_DCACHE;
	
	$key = md5($key ? $key : md5($_DCACHE['settings']['authkey'].$_SERVER['HTTP_USER_AGENT']));
	$key_length = strlen($key);
	
	$string = $operation == 'DECODE' ? base64_decode($string) : substr(md5($string.$key), 0, 8).$string;
	$string_length = strlen($string);
	
	$rndkey = $box = array();
	$result = '';

	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($key[$i % $key_length]);
		$box[$i] = $i;
	}
	
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	
	if($operation == 'DECODE') {
		if(substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
			return substr($result, 8);
		} else {
			return '';
		}
	} else {
		return str_replace('=', '', base64_encode($result));
	}
}


function daddslashes($string, $force = 0) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}

function hasLogin() {
	//global $cookiepre;
	//if (empty($_COOKIE[$cookiepre."Example_auth"]))
	if (empty($_COOKIE["Example_auth"]))
		return false;
	else
		return true;
}

function messagelog($str){
	$fp = fopen("D:\htdocs_yd\log.txt", "a+");
	fwrite($fp,$str."\r\n");
	fclose($fp);
}

//////////////////////////////////////////////////

function debug($str) {
	$date = date('Y-m-d');
	$file = dirname(__FILE__)."/debug/$date.txt";
	$str=date('[H:i:s] ')."$str\r\n";
	$fp = fopen($file, 'a+');
	if(flock($fp, LOCK_EX)) {
		fputs($fp, $str);
		flock($fp, LOCK_UN);
	}
	fclose($fp);
}

//获取$_REQUEST的Integer参数值
function getRequestIntParam($paramName,$defaultValue) {
	if (isset($_REQUEST[$paramName]))
		return intval($_REQUEST[$paramName]);
	else
		return intval($defaultValue);
}

function getRequestStringParam($paramName,$defaultValue) {
	if(!isset($_REQUEST[$paramName])) return strval($defaultValue);
	$paramValue = strval($_REQUEST[$paramName]);
	return $paramValue?htmlspecialchars($paramValue,ENT_QUOTES):$defaultValue;
}

function getRequestParam($paramName,$defaultValue) {
	$paramValue = $_REQUEST[$paramName];
	return $paramValue?$paramValue:$defaultValue;
}

function setLoginUser($user) {
	$_SESSION['user'] = $user;
}
function getLoginUser() {
	return $_SESSION['user'];
}
function logout() {
	$_SESSION['user'] = null;
	//session_unregister('user');
}

function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}
?>