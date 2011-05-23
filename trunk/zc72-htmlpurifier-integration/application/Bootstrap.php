<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initFilter()
    {
        HTMLPurifier_Bootstrap::registerAutoload();
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Attr.EnableID',true);
        $config->set('HTML.Strict',true);
        Zend_Registry::set('purifier',new HTMLPurifier($config));
    }
    
}

