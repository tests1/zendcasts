<?php

class App_UserService 
{
	protected $db;
	
	/**
	 * users Zend Table
	 *
	 * @var UsersTable
	 */
	protected $users;
	function __construct()
	{
		$options = array(
			'host'		=> 'localhost',
			'username'  =>	'root',
			'password'	=>	'root',
			'dbname'	=> 'zendcastdev'		
		);
		
		$this->db = Zend_Db::factory('PDO_MYSQL', $options);
		Zend_Db_Table_Abstract::setDefaultAdapter($this->db);
		
		$this->users = new UsersTable();				
	}
	public function NewTestUser()
	{
		$params = array(
			'name' => 'jane doe',
			'email' => 'jane@doe.com');
		$this->users->insert($params);
	}
	public function SaveUser($id, $name, $email)
	{
		$params = array(
			'name' => $name,
			'email' => $email
		);
		$this->users->update($params, $this->getWhereClauseForUserId($id));
		
	}
	private function getWhereClauseForUserId($id)
	{
		return $this->users->getAdapter()->quoteInto('id = ?', $id);	
	}
	public function NewUser($name , $email)
	{
		$params = array(
			'name' => $name,
			'email' => $email
		);
		$this->users->insert($params);
				
	}
	public function DeleteUser($id)
	{
		$this->users->delete($this->getWhereClauseForUserId($id));
	}
	public function GetUser($id)
	{
		$row = $this->users->find($id);
		return $row;
	}
	public function GetAllUsers()
	{
		$select = $this->users->select();
		$select->order('name');
		
		return $this->users->fetchAll($select);
		
	}
	
	
	
	
	
	
	
}

?>