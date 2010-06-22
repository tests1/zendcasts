<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initMail()
    {
        $tr = new Zend_Mail_Transport_Smtp("localhost", array('port' => 2525));
        Zend_Mail::setDefaultTransport($tr);
    }
}

