<?php
/**
 * My new Zend Framework project
 * 
 * @author  
 * @version 
 */
set_include_path('.' . PATH_SEPARATOR . '../library' . PATH_SEPARATOR .
'/Applications/Zend/Zend Studio for Eclipse - 6.1.1/plugins/org.zend.php.framework.resource_6.1.1.v20081231-1100/resources/ZendFramework_1.7/FrameworkLib/'
. PATH_SEPARATOR.  '../application/default/models/' . PATH_SEPARATOR . get_include_path());

require_once 'Initializer.php';
 
// Prepare the front controller. 
$frontController = Zend_Controller_Front::getInstance(); 

// Change to 'production' parameter under production environemtn
$frontController->registerPlugin(new Initializer('development'));    

// Dispatch the request using the front controller. 
$frontController->dispatch(); 
?>

