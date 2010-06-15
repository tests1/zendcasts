<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        //throw new Exception("something bad happened");
        ZC_FileLogger::info("hello again!");
    }
}

