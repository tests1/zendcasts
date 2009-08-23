<?php
/**
 * Logger helper class
 * 
 * @author 
 * @version
 *
 */
class My_Controller_Action_Helper_Logger extends Zend_Controller_Action_Helper_Abstract {
	/**
	 * Logger instance
	 *
	 * @var Zend_Log The logger
	 */
	private $logger;
	
	/**
	 * Constructor: initialize plugin loader with logger instance 
	 * depending on if configuration allows it
	 * @return void
	 */
	public function __construct() {
		if (Zend_Registry::isRegistered ( 'logger' )) {
			$this->logger = Zend_Registry::get ( 'logger' );
		} else {
			echo ("Logger helper is not in the Registry");
		}
	}
	function direct($message, $priority) {
		if ($this->logger)
			$this->logger->log ( $message, $priority );
	}
	
	function __call($name, $arguments) {
		if ($this->logger) {
			$this->logger->$name($arguments[0]);
		}
	}
}
