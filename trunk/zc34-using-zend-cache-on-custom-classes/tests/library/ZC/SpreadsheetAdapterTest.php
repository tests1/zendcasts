<?php
/**
 * Test class for ZC_SpreadsheetAdapterTest
 * @author: jlebensold
 */

class ZC_SpreadsheetAdapterTest
extends ControllerTestCase {
    protected $adapter;

    protected $testuser = "zendcasts@gmail.com";
    protected $testpass = "p@ssword";
    protected $spreadsheetKey = "tU8XBAwm_Uk15SSaGKXb8jg";

    public function setUp()
    {
	parent::setUp();
	$this->adapter = new ZC_SpreadsheetAdapter($this->testuser,
				    $this->testpass,$this->spreadsheetKey);
    }

    public function testCanGetRows()
    {
	$rows = $this->adapter->getRows();
	$this->assertTrue(is_array($rows));
    }
    public function testCanGetColumns() {
	$columns = $this->adapter->getColumns();
	$this->assertTrue(is_array($columns));
    }
    public function testCanInsertRow()
    {
	$testPayload = array();
	foreach($this->adapter->getColumns() as $col)
	{
	    if ($col == "address")
		$testPayload[$col] = "some address";

	    elseif ($col == "latitude" || $col == "longitude")
		$testPayload[$col] = rand(0,1000000)/100000;

	    else
		$testPayload[$col] = "test" . substr(time(),6);
	}
	$this->adapter->insertRow($testPayload);
    }
    public function tearDown() {
	$this->adapter = null;
    }

}