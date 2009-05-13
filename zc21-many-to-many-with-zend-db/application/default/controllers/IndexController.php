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
	 * @var App_UserService
	 */
	protected $userService;

	public function preDispatch()
	{
		$this->userService = new App_UserService();
		
		// CACHE!
		$this->view->contactTypes = $this->userService->GetAllContactTypes();
		
		
	}
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
    	if ($this->getRequest()->isPost())
    	{
    		$this->userService->NewUser($this->_getParam('name') , 
    		$this->_getParam('email'),
    		$this->_getParam('contactType')
    		);
    	}

    	$this->view->users = $this->userService->GetAllUsers()->toArray();
    	
  
	}
	public function contactAction()
	{
		$name = $this->_getParam('name');
		
		$ctRow = $this->userService->GetContactTypeByName($name);
		
		if ($ctRow != null)
			$this->view->contactType = $ctRow;
		else 
			$this->view->contactType = $this->view->contactTypes->current();
		
		$this->view->users = $this->view->contactType->findDependentRowset('UsersTable');
		
	}
	
	public function updateAction()
	{
		if ($this->getRequest()->isPost())
		{
			$this->userService->SaveUser(
				$this->_getParam('id'), 
				$this->_getParam('name'), 
				$this->_getParam('email'),
    			$this->_getParam('contactType')
				);
			$this->_redirect('index');				
		}
		else
		{
			
			$this->view->user = $this->userService->GetUser($this->_getParam('id'))->current();
			
		}
		$this->view->users = $this->userService->GetAllUsers()->toArray();
	}
	public function deleteAction()
	{
		$this->userService->DeleteUser($this->_getParam('id'));
		$this->_redirect('index');
	}
	public function taskAction()
	{
		
		$id = $this->_getParam('id');
		$state = $this->_getParam('state');

		if ($state == "update")
			$this->view->form = new App_forms_Task($state, $this->userService->GetTask($id));			
		else
			$this->view->form = new App_forms_Task();
		
			
		if ($this->getRequest()->isPost() &&
			 $this->view->form->isValid($this->getRequest()->getParams()))
				$this->view->form->persistData();
		
		
	}
	public function associateAction()
	{
		$tasks = $this->userService->GetAllTasks();
		$this->view->user = $this->userService->GetUser($this->_getParam('id'));
		
		
		$this->view->form = new App_forms_Associate($this->view->user, $tasks);		

		if ($this->getRequest()->isPost() &&
			 $this->view->form->isValid($this->getRequest()->getParams()))
				$this->view->form->persistData();
		
	}
	
	public function responsibilityAction()
	{
		$tasks = $this->userService->GetAllTasks();
		
		$this->view->tasks = array();
		
		foreach ($tasks as $task)
		{
			$tempTaskArray = array();
			$tempTaskArray['name'] = $task->name; 
			$tempTaskArray['users'] = array();

			$users = $task->findManyToManyRowset('UsersTable', 'TasksUsers');

				 
			foreach ($users as $userRow)
			{
				$tempTaskArray['users'][] = $userRow->name;				
			}
			
			
			$this->view->tasks[] = $tempTaskArray;
		}
		
	}
		
    
}
