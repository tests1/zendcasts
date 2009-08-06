<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	
	protected function _initDB(){
		$params = array(
		"dbname" => "firebug" ,
		"username" => "root" ,
		"password" => "" , 
		"host" => "localhost",
		"Charset" => "utf8"
		);
		
		$db = Zend_Db::factory("PDO_MYSQL" , $params);
		Zend_Registry::set("db" , $db);
		
		
		
	}
	protected  function _initActionHelper(){
		$writer = new Zend_Log_Writer_Firebug();
		$logger = new Zend_log($writer);
		Zend_Registry::set("logger" , $logger);

	}
	

}

