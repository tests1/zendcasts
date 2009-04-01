<?php

/**
 * IndexController - The default controller class
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action 
{
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {

    	$service = new App_HttpClient("searchuser", "mys3cr3tk3y");
    	$response = $service->call("countrysearch",array("query" => "am"));
    	var_dump($response);
    }
}
