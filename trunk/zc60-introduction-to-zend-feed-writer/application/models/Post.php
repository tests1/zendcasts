<?php

/**
 * Description of Post
 *
 * @author jon
 */
class Model_Post
{
    public $title;
    public $link;
    public $dateModified;
    public $dateCreated;
    public $description;
    public $content;
    public static function getUrl()
    {
        return 'http://zc/';
    }

    public static function getPosts()
    {
        // this would normally hit a database
        $posts = array();
        $posts[] = Model_Post::create('Title 1', 'this is a really long piece of text about a whole bunch of stuff that doesn\'t matter. I could keep writing and writing and writing!');
        $posts[] = Model_Post::create('Title 2', 'A shorter piece of content lives here');
        return $posts;
    }

    public static function create($title, $content)
    {
        $p = new Model_Post();
        $p->content = $content;
        $description = str_split($content, 50) ;
        $p->description = $description[0]. '...';
        $p->link = self::getUrl() . '/'.strtolower(str_replace(' ','-',$title));
        $p->title = $title;
        return $p;
    }
    public function getFieldsAsArray()
    {
        $properties = get_class_vars(get_class($this));
        $fields = array();
        foreach ($properties as $property => $defaultValue)
            $fields[$property] = $this->$property;

        return $fields;
    }
    public function __construct()
    {
        $this->dateCreated = time();
        $this->dateModified = time();
    }
}

