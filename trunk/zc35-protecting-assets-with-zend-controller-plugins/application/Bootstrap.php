<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath' => APPLICATION_PATH));

		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace(array('ZC_'));
		return $moduleLoader;		
	}
	protected function _initControllerPlugins()
	{
	    $frontController = Zend_Controller_Front::getInstance();
	    $frontController->registerPlugin(new ZC_Controller_Plugin_AssetGrabber());
	}
}

