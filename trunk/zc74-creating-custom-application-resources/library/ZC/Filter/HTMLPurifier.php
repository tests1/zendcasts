<?php
/**
 * @author jon
 */
class ZC_Filter_HTMLPurifier 
    implements Zend_Filter_Interface
{
    /**
     *
     * @var HTMLPurifier 
     */
    protected $purifier;
    
    public function __construct($options = null)
    {
        
    }
    
    public function filter($value) 
    {
       return Zend_Registry::get("HTMLPurifier")->purify($value); 
       
    }
}
