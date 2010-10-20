<?php
/**
 * Description of UserChangePassword
 *
 * @author jon
 */
class Form_UserChangePassword
    extends Zend_Form
{
    /**
     *
     * @var \Model_User
     */
    protected $_user;


    public function __construct(\Model_User $user,$options = null)
    {
        parent::__construct($options);
        $this->_user = $user;
    }

    public function init()
    {
        $this->addElements(array(
            $this->createElement('password', 'currentPassword')->setRequired(true),
            $this->createElement('password', 'newPassword')->setRequired(true),
            $this->createElement('password', 'newPasswordConfirm')->setRequired(true)
        ));
    }
    public function process($data)
    {
        if ($this->isValid($data) !== true)
        {
            throw new Exception('Form Validation Failed');
        }

        if ($this->newPassword->getValue() != $this->newPasswordConfirm->getValue())
        {
            throw new Exception('Passwords don\'t match');
        }

        if ($this->_user->password != $this->currentPassword->getValue())
        {
            throw new Exception('Current password is incorrect');
        }
        
        $this->_user->password = $this->newPassword->getValue();
        $this->_user->save();
        
    }
    

}
