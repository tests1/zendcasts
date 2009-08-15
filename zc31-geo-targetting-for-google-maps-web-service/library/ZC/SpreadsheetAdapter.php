<?php
/**
 * Description of ZC_SpreadsheetAdapter
 *
 * @author jon
 */
class ZC_SpreadsheetAdapter {
    protected $spreadsheetService;
    protected $spreadsheetKey;
    

    public function __construct($username, $password, $spreadsheetKey)
    {
	$this->spreadsheetKey = $spreadsheetKey;
	$client =
	    Zend_Gdata_ClientLogin::getHttpClient($username, $password,
		Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);
	$this->spreadsheetService =
		new Zend_Gdata_Spreadsheets($client);
    }
    
    public function getRows()
    {
	$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
	$query->setSpreadsheetKey($this->spreadsheetKey);
	$feed = $this->spreadsheetService->getWorksheetFeed($query);

	return $feed->entries[0]->getContentsAsRows();
    }

    public function getColumns()
    {
	$query = new Zend_Gdata_Spreadsheets_CellQuery();
	$query->setSpreadsheetKey($this->spreadsheetKey);
	$feed = $this->spreadsheetService->getCellFeed($query);

	$columnCount = intval($feed->getColumnCount()->getText());
	$columns = array();
	
	for($i = 0; $i < $columnCount; $i++)
	{
	    if ($feed->entries[$i])
	    {
		$columnName = $feed->entries[$i]->getCell()->getText();
		$columns[$i] = strtolower(str_replace(' ', "", $columnName));
	    }
	}
	return $columns;
	
    }
    /**
     *
     * @param array $payload
     * @return Zend_Gdata_Spreadsheets_ListEntry
     */
    public function insertRow($payload)
    {
	return $this->spreadsheetService->insertRow($payload, $this->spreadsheetKey);
    }


}