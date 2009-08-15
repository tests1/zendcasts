<?php
/**
 * Test class for ZC_PersonMapperTest
 * @author: jlebensold
 */

class ZC_PersonMapperTest extends ControllerTestCase {
    /**
     *
     * @var ZC_PersonMapper
     */
    protected $personMapper;



    protected $testuser = "zendcasts@gmail.com";
    protected $testpass = "p@ssword";
    protected $spreadsheetKey = "tU8XBAwm_Uk15SSaGKXb8jg";



    public function setUp() {
	parent::setUp();
	$spreadsheetPersistence = new ZC_SpreadsheetAdapter($this->testuser,
				    $this->testpass,$this->spreadsheetKey);

	$geocodingService = new ZC_GeocodingAdapter('');

	$this->personMapper = new ZC_PersonMapper($geocodingService,$spreadsheetPersistence);
    }
    public function testCanInsertRow()
    {
	$result = $this->personMapper->newPerson($this->getRandomName(),
						 $this->getRandomName(),
						 $this->getRandomName().'@example.com',
						 $this->getRandomAddress());
	$this->assertTrue($result instanceof Zend_Gdata_Spreadsheets_ListEntry);
    }
    private function getRandomName()
    {
	$names = array("John","Kim","Liu","Smith","Erica","Roger","Adam");
	return substr(time(), 5 ). $names[array_rand($names)];
    }
    private function getRandomAddress() {
	$addresses = array(
	    "Eiffel Tour, Paris, France",
	    "White House, Washington DC",
	    "Leaning Tower of Piza",
	    "Dubai Media City, UAE",
	    "Emmerson College, Boston, USA",
	    "Big Ben, London, United Kingdom",
	    "Concordia University, Montreal, Quebec"
	);
	return $addresses[array_rand($addresses)];
    }

    public function tearDown() {
	$this->personMapper = null;
    }

}