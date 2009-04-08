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
	 * Bits on the run web service object
	 *
	 * @var botr_API
	 */
	protected $videoService;
	
	public function preDispatch()
	{
		$this->videoService = new botr_API(
		array(
		'api_key' => "c114a6023c4f9ef72fa48d632e4797f2",
		'api_secret' => "88b7d0a195e6ceaf"		));
		
		
		
	}
	
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
	
    
    	
	}
	
	public function searchAction()
	{
		if($this->getRequest()->isPost())
		{
			$this->view->searchTerm = $this->getRequest()->getParam('tbSearch');

			$response = $this->videoService->callMethod("mediafiles/search",
	    	array(
	    		"auth_token" => "5d84c2288b8e3916",
	    		"text" => $this->view->searchTerm
	    	));
	    	
	    	$this->view->mediafiles = $response->mediafiles;
		}
		
	}
	
	public function playAction()
	{
		$mediafileId = $this->getRequest()->getParam('mid');	
		
		$response = $this->videoService->callMethod("mediafiles/getInfo",
	    	array(
	    		"auth_token" => "5d84c2288b8e3916",
	    		"mediafile_id" => $mediafileId 
	    	));
	    
		$this->view->title = $response->mediafile->title;
		$this->view->publishId = $this->getRequest()->getParam('pid');
		
	}
	
	
	
	
	
    
}
