<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	
    
	$gdata = Zend_Registry::get('gdata');
	$this->view->googleMapsKey = $gdata['mapskey'];
	$sa = Zend_Registry::get('spreadsheet');

	$this->view->rows = $sa->getRows();


    }

}

