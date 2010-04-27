<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {

        $logger = $this->getLogger();
        foreach($_SERVER as $k=>$value)
        {
            if(is_array($value))
                continue;
            $logger->setEventItem($k, $this->view->escape($value));
        }
        $logger->log('',Zend_Log::INFO);
    }
    /**
     *
     * @return Zend_Log
     */
    private function getLogger()
    {
        $writer = new Zend_Log_Writer_Stream(
                APPLICATION_PATH .'/../logs/visitors.xml');
        $writer->setFormatter(new Zend_Log_Formatter_Xml('visitor',$this->getFormat()));
        return new Zend_Log($writer);
    }
    private function getFormat()
    {
        $format = array();
        foreach($_SERVER as $k=>$v)
        {
            if (is_array($v))
                continue;
            $format[$k] = $k;
        }
        return $format;
    }


}

