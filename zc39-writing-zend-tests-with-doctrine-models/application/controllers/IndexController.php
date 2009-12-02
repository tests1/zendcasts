<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $ar = array();
        for ($i = 0; $i < 20; $i++)
        {
            $ar[] = $i;
        }
    }

    public function indexAction()
    {
        // action body

        $foo = 'a';

        $bar = $foo . $foo . 'ads';

        echo $bar;
    }


}

