<?php 
	// including config file
	
	require_once('_config.php');
	
	
	// the system of autoload for example : explode will make class "front_controller" to array front[0] controller[1]
	//implode make this front/controller
	function __autoload($class_name){
		$class = explode("_",$class_name);
		$path = implode("/",$class).'.php';
		require_once($path);
	}
	

?>