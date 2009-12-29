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
class UserTest 
    extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function testCanCreateUsers()
    {

        $u = new User();
        $u->email = "jon@lebensold.ca";
        $u->name = "Jon Lebensold";
        $u->phone = "XXX-123-323";
        $u->save();

        $this->assertTrue(intval($u->id) === 3);


        $u2 = new User();
        $u2->email = "jane@example.com";
        $u2->name = 'Jane Doe';
        $u2->save();
        $this->assertTrue(intval($u2->id) === 4);

    }
}

