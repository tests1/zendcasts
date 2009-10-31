<?php
/**
 * Description of AssetGrabber
 *
 * @author jon
 */
class ZC_Controller_Plugin_AssetGrabber
    extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup (Zend_Controller_Request_Abstract $request)
    {
	if ($request->getControllerName() != 'assets')
	    return;
	$session = new Zend_Session_Namespace('auth');
	if(! $session->authenticated)
	    throw new Exception('Not authenticated!');
	
	echo file_get_contents(APPLICATION_PATH . '/../assets/' . $request->getActionName());

	exit;
    }

}