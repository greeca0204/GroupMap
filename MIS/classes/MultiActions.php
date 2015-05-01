<?php

if (!defined("RUNNING")) die("Invalid Operation!");

$skip = false;

if(function_exists('_handleRequest'))
	$skip = call_user_func('_handleRequest');

if(!$skip) {
	
	@$action = $_REQUEST["action"];
	if (!$action){
		$action="default";
	}
	
	$action = "_".$action;
	if (function_exists($action)){
		call_user_func($action);
	}

}

if(function_exists('_handleRequestFinish'))
	call_user_func('_handleRequestFinish');

?>