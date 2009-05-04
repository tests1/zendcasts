<?php
/**
 * AllTests - A Test Suite for your Application 
 * 
 * @author
 * @version 
 */
require_once 'PHPUnit/Framework/TestSuite.php';

set_include_path('.' . PATH_SEPARATOR . '../library' .
  PATH_SEPARATOR . '../application/default/models/' 
. PATH_SEPARATOR . 
'/Applications/Zend/Zend Studio for Eclipse - 6.1.1/plugins/org.zend.php.framework.resource_6.1.1.v20081231-1100/resources/ZendFramework_1.7/FrameworkLib/'
. PATH_SEPARATOR .
get_include_path());
require_once '../application/Initializer.php';
require_once 'library/UserServiceTest.php';

/**
 * AllTests class - aggregates all tests of this project
 */
class AllTests extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'AllTests' );
		
		//$this->addTestSuite ( 'IndexControllerTest' );
		$this->addTestSuite('UserServiceTest');
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ( );
	}
}

