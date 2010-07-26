<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->addHelperPath(
                'ZendX/JQuery/View/Helper'
                ,'ZendX_JQuery_View_Helper');
    }
    public function indexAction()
    {
        $this->view->autocompleteElement = new ZendX_JQuery_Form_Element_AutoComplete('ac');
        $this->view->autocompleteElement->setLabel('Autocomplete');
        $this->view->autocompleteElement->setJQueryParam(
                'source', '/index/city');
    }
    public function cityAction()
    {
        $results = Model_City::search($this->_getParam('term'));
        $this->_helper->json(array_values($results));
    }

}

