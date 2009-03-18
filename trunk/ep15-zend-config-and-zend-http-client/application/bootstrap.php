<?php

defined('APPLICATION_PATH')
	or define('APPLICATION_PATH' , dirname(__FILE__));

defined('APPLICATION_ENVIRONMENT')
	or define('APPLICATION_ENVIRONMENT', 'production');



$frontController = Zend_Controller_Front::getInstance();

$frontController->setControllerDirectory(APPLICATION_PATH . '/controllers');


$frontController->setParam('env' , APPLICATION_ENVIRONMENT);

Zend_Registry::set('config',
	new Zend_Config_Ini(APPLICATION_PATH .'/config.ini',APPLICATION_ENVIRONMENT));


Zend_Layout::startMvc(APPLICATION_PATH . '/layouts/scripts');

$view = Zend_Layout::getMvcInstance()->getView();
$view->doctype('XHTML1_STRICT');
$view->addHelperPath('App/View/Helper' , 'App_View_Helper');

$router = $frontController->getRouter();

unset($frontController);