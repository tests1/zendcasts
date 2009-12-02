<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTest
 *
 * @author jon
 */
class UserTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function setUp()
    {

    }
    public function testCanCreateUser()
    {
        $u = new User();
        $u->email = 'jon@lebensold.ca';
        $u->name = "Jon Lebensold";
        $u->save();
        $this->assertTrue(intval($u->id) === 1);

        $u2 = new User();
        $u2->email = 'jane@example.com';
        $u2->name = 'jane doe';
        $u2->save();
        $this->assertTrue(intval($u2->id) === 2);
    }
    public function tearDown()
    {
        
    }
}
