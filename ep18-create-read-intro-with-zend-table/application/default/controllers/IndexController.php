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
	 * Entry into the User Service Layer
	 *
	 * @var App_UserService
	 */
	protected $userService;
	
	public function preDispatch()
	{
		$this->userService = new App_UserService();
	}
	
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
    	if ($this->getRequest()->isPost())
    	{
    		$this->userService->NewUser($this->_getParam('name'),$this->_getParam('email'));
    	}
    	
  		$rowset = $this->userService->GetAllUsers();
  		$this->view->users = $rowset->toArray();
	}
	public function updateAction()
	{
		if ($this->getRequest()->isPost())
		{
			$this->userService->SaveUser(
				$this->_getParam('id'),
				$this->_getParam('name'),
				$this->_getParam('email')
			);
			$this->_redirect('index');			
		}
		else
			$this->view->user = $this->userService->GetUser($this->_getParam('id'))->current();
		
	}
	public function deleteAction()
	{
		$this->userService->DeleteUser($this->_getParam('id'));
		$this->_redirect('index');
		
	}
	
	
	
	
    
}
