<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initLog()
    {
        if ($this->hasPluginResource("log"))
        {
            $r = $this->getPluginResource("log");
            $log = $r->getLog();
            Zend_Registry::set('log',$log);
        }
    }
}

