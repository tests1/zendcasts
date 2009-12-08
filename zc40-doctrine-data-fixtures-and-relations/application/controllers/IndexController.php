<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {

        $cars = Car::findAll();

        foreach($cars as $car)
        {
            echo $car->brand . '<br>';
            foreach($car->Users as $u)
            {
                echo $u->name . '<br>';
            }
        }

     
    }
}

