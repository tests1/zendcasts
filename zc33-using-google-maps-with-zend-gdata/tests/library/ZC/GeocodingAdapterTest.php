<?php
/**
 * Test class for ZC_GeocodingAdapterTest
 * @author: jlebensold
 */

class ZC_GeocodingAdapterTest
extends ControllerTestCase {
    protected $geocoder;

    /**
     * Google Maps API key for http://zc/
     * @var string
     */
    protected $apiKey = "";

    public function setUp() {
	parent::setUp();
	$this->geocoder = new ZC_GeocodingAdapter($this->apiKey);
    }
    public function testCanSearchAddress() {
	$latAndLong = $this->geocoder->getGeocodedLatitudeAndLongitude('12 Girouard, Montreal, Quebec');
	$this->assertTrue(is_array($latAndLong));
	$this->assertTrue(is_double($latAndLong[0]));
	$this->assertTrue(is_double($latAndLong[1]));
    }

    public function tearDown() {
	$this->geocoder = null;
    }

}