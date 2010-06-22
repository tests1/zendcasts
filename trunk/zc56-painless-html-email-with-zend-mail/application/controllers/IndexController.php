<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {

        $m = new ZC_HtmlMailer();
        $m->setSubject("Hello!")
          ->addTo("jon@lebensold.ca")
          ->setViewParam('name','Jon Lebensold')
          ->sendHtmlTemplate("hello.phtml");
   }
}

