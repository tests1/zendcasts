<?php

class IndexController extends Zend_Controller_Action {
	protected $logger;
	protected $db;
	
	public function preDispatch() {
		$this->logger = Zend_Registry::get ( "logger" );
		$this->db = Zend_Registry::get ( "db" );
	}
	
	public function indexAction() {
		$this->logger->alert ( 'Alert ' );
		$this->logger->log ( 'Log !', Zend_Log::ERR );
		$this->logger->err ( 'Error !' );
		$this->logger->info ( 'Information ' );
		
		$this->logger->log ( "Emergency !", Zend_Log::EMERG );
		$this->logger->log ( 'Warning !', Zend_Log::WARN );
		$this->logger->log ( 'Debug !', Zend_log::DEBUG );
		$this->logger->log ( 'critical  !', Zend_log::CRIT );
		$this->logger->log ( 'NOTICE  !', Zend_log::NOTICE );
		$this->logger->log ( $this->getRequest (), Zend_log::DEBUG );
		
		$this->logger->log ( $this->db, Zend_log::DEBUG );
		
		$profiler = new Zend_Db_Profiler_Firebug ( 'All  DB Queries' );
		$profiler->setEnabled ( true );
		// Attach the profiler to your db adapter
		$this->db->setProfiler ( $profiler );
		$sql = 'SELECT * FROM countries WHERE countryid = ?';
		for($i = 0; $i < 10; $i ++) {
			$result = $this->db->fetchAll ( $sql, $i );
			$this->logger->log ( $result, Zend_log::INFO );
		}
	}
	public function helperAction() {
		$this->_helper->Logger ( "My Log Via Helper :)", Zend_Log::ALERT );
		$this->_helper->Logger ( $this->getRequest ()->getControllerName (), Zend_Log::DEBUG );
		$this->_helper->Logger ( $this->getRequest ()->getActionName (), Zend_Log::DEBUG );
		
		$this->_helper->Logger->err ( "err Via __call function " );
		$this->_helper->Logger->info ( "info Via __call function " );
		$this->_helper->Logger->warn ( "warning Via __call function " );
		
		/* throw an Exception to firebug console 
		 * you should use try catch clause 
		 * this is just example
		 *  @ Zend_Exception Class 
		 */
		$this->_helper->Logger ( new Zend_Exception ( "Some Error Happen Here " ), Zend_Log::ALERT );
	
	}

}

