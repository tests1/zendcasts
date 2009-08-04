<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	
    
	$user = 'zendcasts@gmail.com';
	$pass = 'p@ssword';
	$spreadsheet = 'tQ5S9C_-aZUAiEI7UoF4sbQ';
	
	$sa = new ZC_SpreadsheetAdapter($user, $pass, $spreadsheet);
	$this->view->rows = $sa->getRows();
	foreach ($this->view->rows as $k=>$row)
	{
	    var_dump($row);
	}


    }

}

