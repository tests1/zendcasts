<?php
/**
 * Description of User
 *
 * @author jon
 */
class Model_User
{

    public $username;

    public $password;

    /**
     * imaginary data store
     * @var array
     */
    protected static $users = array();

    
    public static function findByUsername($username)
    {
        if (array_key_exists($username, self::$users))
        {
            $password = self::$users[$username];
            $user = new self();
            $user->password = $password;
            $user->username = $username;
            return $user;
        }
        else
        {
            return false;
        }
    }
    public static function getUsers()
    {
        return self::$users;
    }
    public static function create($username, $password)
    {
        self::$users[$username] = $password;
    }

    public function save()
    {
        self::create($this->username, $this->password);
    }
    public function delete()
    {
        unset(self::$users[$this->username]);
    }
}

