<?php
/**
 * Description of FeedController
 *
 * @author jon
 */
class FeedController
    extends Zend_Controller_Action
{
    public function init()
    {
        Zend_Layout::getMvcInstance()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }
    private function getFeed()
    {

        $feed = new Zend_Feed_Writer_Feed;
        $feed->setTitle('My Blog');
        $feed->setLink(Model_Post::getUrl());
        $feed->setDateModified(time());
        $feed->setDescription('this is my blog');
        
        foreach(Model_Post::getPosts() as $post)
        {
            $entry = $feed->createEntry();
            foreach($post->getFieldsAsArray() as $field => $value)
            {
                $method = 'set'.ucfirst($field);
                $entry->$method($value);
            }
            $feed->addEntry($entry);
        }
        return $feed;
    }
    public function rssAction()
    {
        $feed = $this->getFeed();
        $feed->setFeedLink(Model_Post::getUrl(). 'feed/rss', 'rss');

        echo $feed->export('rss');
    }
    public function atomAction()
    {
        $feed = $this->getFeed();
        $feed->addAuthor("Jon Lebensold", "jon@lebensold.ca", "http://www.zendcasts.com");
        $feed->setFeedLink(Model_Post::getUrl() . 'feed/atom', 'atom');

        echo $feed->export('atom');
    }

}

