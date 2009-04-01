<?php

require_once 'library/App/Countries.php';

class CountriesTest  extends PHPUnit_Framework_TestCase {

	/**
	 * @var App_Countries
	 */
	protected $countryBusinessObject;
	public function setUp()
	{
		parent::setUp ();
		
		$this->countryBusinessObject = new App_Countries();
	}
	public function testCanDoEmptyQuery()
	{
		
		$this->assertEquals(0,count($this->countryBusinessObject->searchCountries("")));
	}
	public function testCanGetOneCountryCaseSensitive()
	{
		$this->assertEquals(1,count($this->countryBusinessObject->searchCountries("canada")));
	}
	protected function tearDown() {
		parent::tearDown ();
	}
	
}

?>