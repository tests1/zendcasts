<?php

/**
 * Description of IndexController
 *
 * @author jon
 */
class IndexController extends Zend_Controller_Action {
	public function init()
	{
		$this->config = Zend_Registry::get('config');
	}

	public function indexAction()
	{
		$this->view->host = $this->config->host;
		$this->view->name = $this->config->name->first . " " .
							$this->config->name->last;	
	}

	public function restAction()
	{
		$client = new Zend_Http_Client();
		$query = "@zend";
		$client->setUri("http://search.twitter.com/search.json?q=$query");
		$json = Zend_Json::decode($client->request("GET")->getBody());

		$this->view->twitterResults = $json['results'];

	}
}
