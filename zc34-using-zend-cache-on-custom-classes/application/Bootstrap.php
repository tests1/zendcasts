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
		$options = $this->getOptions();
		$gdata = $options['gdata'];
		Zend_Registry::set('gdata',$gdata);
		return $moduleLoader;		
	}

	protected function _initSpreadsheetCaching()
	{
	    $gdata = Zend_Registry::get('gdata');
	    $spreadsheet = new ZC_SpreadsheetAdapter($gdata['user'], $gdata['password'], $gdata['spreadsheet']);
		$cache = Zend_Cache::factory('Class',
                             		 "File",
					 array('cached_entity' => $spreadsheet), // we set these parameters directly in our XmlCache
					  array('cache_dir' =>TMP_PATH));

		Zend_Registry::set('spreadsheet',$cache);

	}
}

