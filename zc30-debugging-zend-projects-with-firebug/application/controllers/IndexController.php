<?php

class IndexController extends Zend_Controller_Action
{

	protected $logger ; 
	protected $db ;
		
    public function init()
    {
        /* Initialize action controller here */
	    $this->db = Zend_Registry::get("db");
	    $this->logger = Zend_Registry::get("logger");	
    }

    public function indexAction()
    {
        // action body
        
    	$this->logger->log("ALERT" , Zend_Log::ALERT);
    	$this->logger->log("Debug MSG " , Zend_Log::DEBUG);
		$this->logger->log("info MSG " , Zend_Log::INFO);
		$this->logger->log("Crit MSG " , Zend_Log::CRIT);
		$this->logger->log("notice MSG " , Zend_Log::NOTICE); 
		$this->logger->log($this->getRequest(), Zend_Log::INFO );
		$this->logger->log($this->db  , Zend_Log::INFO );
		$profiler = new Zend_Db_Profiler_Firebug("GET NOTCIE ITS PROFILER TITLE ");
		$profiler->setEnabled(true) ; 
		$this->db->setprofiler($profiler);
		
		$sql = "SELECT * FROM countries where countryid =  ? " ; 
		$result = array();
		for($i = 0 ; $i < 10 ; $i++ ){
			$result = $this->db->fetchAll($sql , $i); 
			$this->logger->log($result , Zend_Log::INFO); 
		}
		
		
		
		
		
		
		
		
		
		
		
		
    }


}

