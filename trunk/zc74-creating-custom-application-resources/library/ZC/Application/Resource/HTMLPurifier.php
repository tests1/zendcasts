<?php
/**
 * @author jon
 */
class ZC_Application_Resource_HTMLPurifier 
    extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
     
        HTMLPurifier_Bootstrap::registerAutoload();
        $config = HTMLPurifier_Config::createDefault();
        foreach($this->getOptions() as $k => $item)
            $config->set(str_replace ('_', '.', $k),$item);
        
        Zend_Registry::set('HTMLPurifier',new HTMLPurifier($config));        
    }
}
