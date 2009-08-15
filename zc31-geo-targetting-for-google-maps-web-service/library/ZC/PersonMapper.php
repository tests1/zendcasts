<?php
/**
 * Description of ZC_PersonMapper
 *
 * @author jon
 */
class ZC_PersonMapper {
    /**
     *
     * @var ZC_SpreadsheetAdapter
     */
    public $spreadsheet;
    /**
     *
     * @var ZC_GeocodingAdapter
     */
    public $geocoder;

    public function __construct(ZC_GeocodingAdapter $geocoder, ZC_SpreadsheetAdapter $spreadsheet)
    {
	$this->spreadsheet = $spreadsheet;
	$this->geocoder = $geocoder;
    }
    /**
     *
     * @param string $fname
     * @param string $lname
     * @param string $email
     * @param string $address
     * @return Zend_Gdata_Spreadsheets_ListEntry
     */
    function newPerson($fname,  $lname,  $email,  $address) {

	$latAndLong = $this->geocoder->getGeocodedLatitudeAndLongitude($address);
	$payload = array("firstname"   => $fname,
	      "lastname"    => $lname,
	      "email"	    => $email,
	      "address"	    => $address,
	      "latitude"    => $latAndLong[1],
	      "longitude"   => $latAndLong[0]
	);
	

	return $this->spreadsheet->insertRow($payload);
    }
}