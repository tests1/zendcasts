<?php

/**
 * Car
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6698 2009-11-10 17:58:02Z jwage $
 */ 
class Car extends BaseCar
{
    public static function findAll()
    {
        return Doctrine_Query::create()->from('Car c')->execute();
    }
}