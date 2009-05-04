<?php

/**
 * UserService test case.
 */
require_once '../library/App/UserService.php';

class UserServiceTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var App_UserService
	 */
	private $UserService;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		Zend_Loader::registerAutoload();
		// TODO Auto-generated UserServiceTest::setUp()
		

		$this->UserService = new App_UserService(/* parameters */);
	
	}
	
	public function testCanGetAllContactTypes()
	{
		
		var_dump($this->UserService->GetAllContactTypes());
		
		
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated UserServiceTest::tearDown()
		

		$this->UserService = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}

}

