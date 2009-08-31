<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	
    
	$user = 'zendcasts@gmail.com';
	$pass = 'p@ssword';
	$spreadsheet = 'tU8XBAwm_Uk15SSaGKXb8jg';
	$this->view->googleMapsKey = "ABQIAAAA8p6inq0GMFc7sijhnM4tmBSxI9HQ2NKeTbN1qrj_FWqbBkaVdRSY4pAJpPspKG5R_6g2eDPEm-KfFw";

	$sa = new ZC_SpreadsheetAdapter($user, $pass, $spreadsheet);

	$this->view->rows = $sa->getRows();


    }

}

