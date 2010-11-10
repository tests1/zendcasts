<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addHelper(
            new ZC_Action_Helper_Signup()
        );
    }
}

