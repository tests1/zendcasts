<?php
/**
 * Description of VisitorProvider
 *
 * @author jon
 */
class ZC_Tool_VisitorProvider
    extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    public function hello($name = 'World')
    {
        $this->_registry->getResponse()->appendContent("Hello, {$name}!");
    }
    
}

