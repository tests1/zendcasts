<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mail = new Zend_Mail();
        $mail->addTo('ryan.horn.zc@gmail.com', 'Ryan Horn')
             ->setFrom('ryan.horn.zc@gmail.com', 'Myself')
             ->setSubject('My Subject')
             ->setBodyText('Email Body')
             ->send();
    }


}

