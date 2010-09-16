<?php

class IndexController extends Zend_Controller_Action
{    
    public function indexAction()
    {

        $feedUrl = 'http://feeds.feedburner.com/ZendScreencastsVideoTutorialsAboutTheZendPhpFrameworkForDesktop';
        $feed = Zend_Feed_Reader::import($feedUrl);


        $this->view->gettingStarted = array();
        foreach($feed as $entry)
        {
            if (array_search('Getting Started', $entry->getCategories()->getValues()))
            {
               $this->view->gettingStarted[$entry->getLink()] = $entry->getTitle();
            }
        }
    }

}

