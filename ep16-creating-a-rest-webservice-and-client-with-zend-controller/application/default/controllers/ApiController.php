<?php

/**
 * ApiController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class ApiController extends Zend_Controller_Action 
{
	
	protected $appName;
	
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
	}
	public function preDispatch()
	{
		$this->config = new Zend_Config_Ini("../application/webconfig.ini", "development");
		
		if (! $this->authAccepted())
			throw new Exception("private key authentication failed");
		
	}
	/**
	 * The default action - show the home page
	 */
	public function indexAction() 
	{
		
	
	
	}
	public function countrysearchAction()
	{
		$query = $this->getRequest()->getParam("query");
		
		$countryBusinessObject = new App_Countries();
		
		echo Zend_Json_Encoder::encode($countryBusinessObject->searchCountries($query));
	}
	private function authAccepted()
	{
	
		$this->appName = $this->getRequest()->getParam('appName');
		$keys = $this->config->api->toArray();

		$this->clientKey = $keys[$this->appName]['secret'];
		$signature = $this->signArgs($_POST);


		if ($signature == $this->getRequest()->getParam('auth'))
			return true;
		
		return false;;
	}
	private function signArgs($args){
		ksort($args);
		$a = '';
		foreach($args as $k => $v)
		{
			if ($k == 'auth')
				continue;

			$a .= $k . $v;
		}
		return md5($this->clientKey.$a);
	}
}
?>

