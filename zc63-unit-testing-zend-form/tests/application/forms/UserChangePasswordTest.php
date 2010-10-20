<?php
/**
 * Description of UserChangePasswordTest
 *
 * @author jon
 */
class Form_UserChangePasswordTest
    extends PHPUnit_Framework_TestCase
{
    public function testCanCreateForm()
    {
        $u = new Model_User();
        $form = new Form_UserChangePassword($u);
        $this->assertType('Form_UserChangePassword',$form);
    }

    public function testCheckElementsExist()
    {
        $u = new Model_User();
        $form = new Form_UserChangePassword($u);

        $this->assertType('Zend_Form_Element_Password', $form->getElement('currentPassword'));
        $this->assertType('Zend_Form_Element_Password', $form->getElement('newPassword'));
        $this->assertType('Zend_Form_Element_Password', $form->getElement('newPasswordConfirm'));
    }

    public function testCanProcessValidCrendtials()
    {
        $u = new Model_User();
        $u->username = 'myuser';
        $u->password = 'abc123';
        
        $form = new Form_UserChangePassword($u);

        $formData = array(
           'currentPassword'        => $u->password,
            'newPassword'           =>  'pass2',
            'newPasswordConfirm'    =>  'pass2'
        );

        $form->process($formData);
        
        $this->assertEquals('pass2',$u->password);
    }

    public function testCanCatchInvalidFormValues()
    {
        $u = new Model_User();
        $u->username = 'myuser';
        $u->password = 'abc123';

        $form = new Form_UserChangePassword($u);

        $formData = array(
           'currentPassword'        => $u->password . 'ddd',
            'newPassword'           =>  'pass2',
            'newPasswordConfirm'    =>  'pass2'
        );
        try
        {
            $form->process($formData);
            $this->fail('error not trapped!');
        }
        catch(Exception $e)
        {
            $this->assertEquals('Current password is incorrect', $e->getMessage());
        }
        $formData = array(
            'newPassword'           =>  'pass2',
            'newPasswordConfirm'    =>  'pass2'
        );
        try
        {
            $form->process($formData);
            $this->fail('error not trapped');
        }
        catch(Exception $e)
        {
            $this->assertEquals('Form Validation Failed',$e->getMessage());
        }
            

        $formData = array(
           'currentPassword'        => $u->password,
            'newPassword'           =>  'pass234',
            'newPasswordConfirm'    =>  'pass210'
        );
        try
        {
            $form->process($formData);
            $this->fail('error not trapped');
        }
        catch(Exception $e)
        {
            $this->assertEquals('Passwords don\'t match',$e->getMessage());
        }
    }
    
}
