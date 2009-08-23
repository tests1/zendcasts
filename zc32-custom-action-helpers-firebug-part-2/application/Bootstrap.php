<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initAutoload()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace(array('My_'));		
	}
	
	protected function _initActionHelpers() {
		if ('development' == APPLICATION_ENV) {
			// Place this in your bootstrap file before dispatching your front controller
			$writer = new Zend_Log_Writer_Firebug ( );
			$logger = new Zend_Log ( $writer );
			Zend_Registry::set ( "logger", $logger );
			Zend_Controller_Action_HelperBroker::addPrefix ( "My_Controller_Action_Helper" );
		}
	
	}
	protected function _initDb() {
		
		$params = array ('host' => '127.0.0.1',
						 'username' => 'root',
						 'password' => '',
						 'dbname' => 'firebug', 
						 'profiler' => true, 
						 "charset" => "utf8"
						  );
		$db = Zend_Db::factory ( 'PDO_MYSQL', $params );
		Zend_Registry::set ( "db", $db );
		// turn off profiler:
		//$db->getProfiler()->setEnabled(false);
		// turn on profiler:
		//$db->getProfiler()->setEnabled(true);
	}

}