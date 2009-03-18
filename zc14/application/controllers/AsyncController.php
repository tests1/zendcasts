<?php
/**
 * Description of AsyncController
 *
 * @author jon
 */
class AsyncController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
	}

	public function preDispatch()
	{
		$this->session = new Zend_Session_Namespace('default');

		if (! $this->session->view)
			$this->session->view = $this->view;
		
	}

	public function getnoticeAction()
	{
		if($this->getRequest()->getParam('clear'))
			$this->session->view = $this->view;

		echo $this->session->view->notice($this->getRequest()->getParam('msg'));
	}

}