<?php

	
	//site domain with http Note : $_SERVER['SERVER_NAME'] is for instance www.google.com 
	defined("SITE_URL")  ||  define("SITE_URL","http://".$_SERVER['SERVER_NAME']);	

	
	//Directory Separator '\' for windows and '/' for mac and linux
	defined("DS")  ||  define("DS",DIRECTORY_SEPARATOR);	
	
	// root path
	defined("ROOT_PATH")  ||  define("ROOT_PATH",realpath(dirname(__FILE__).DS."..".DS));
	//echo constant("ROOT_PATH");
	
	// General Path
	defined("G_PATH")  ||  define("G_PATH","..".DS);
	
	
	// classes folder
	defined("CLASSES_DIR")  ||  define("CLASSES_DIR","classes");
	
	// pages folder
	defined("PAGES_DIR")  ||  define("PAGES_DIR","pages");
	
	// modules folder
	defined("MOD_DIR")  ||  define("MOD_DIR","mod");
	
	// includes folder
	defined("INC_DIR")  ||  define("INC_DIR","inc");
	
	// templates folder
	defined("TEMPLATE_DIR")  ||  define("TEMPLATE_DIR","template");
	
	// emails path
	defined("EMAILS_PATH")  ||  define("EMAILS_PATH",ROOT_PATH.DS."emails");
	
	// catalogue images path
	defined("CATALOGUE_PATH")  ||  define("CATALOGUE_PATH",ROOT_PATH.DS."media".DS."catalogue");
	
	// add all above directories to the include path
	set_include_path(implode(PATH_SEPARATOR, array(
		realpath(ROOT_PATH.DS.CLASSES_DIR),
		realpath(ROOT_PATH.DS.PAGES_DIR),
		realpath(ROOT_PATH.DS.MOD_DIR),
		realpath(ROOT_PATH.DS.INC_DIR),
		realpath(ROOT_PATH.DS.TEMPLATE_DIR),
		get_include_path()
	)));	
  // echo realpath(ROOT_PATH.DS.'admin');
 //  echo SITE_URL.'/'.G_PATH_PP."/?page=return";
	//echo implode(PATH_SEPARATOR,array(get_include_path()));
?>