<?php

class App_UserService 
{
	protected $db;
	
	
	protected $users;
	
	/**
	 * Contact Types Table
	 *
	 * @var ContactTypesTable
	 */
	protected $contactTypes;
	
	/**
	 * Contact Types Table
	 *
	 * @var TaskTable
	 */
	protected $task;
	
	function __construct()
	{
		$options = array(
			'host' => 'localhost',
			'username' => 'root',
			'password' => 'root',
			'dbname' => 'zendcastdev'
			);
		
		$this->db = Zend_Db::factory('PDO_MYSQL', $options);
		Zend_Db_Table_Abstract::setDefaultAdapter($this->db);

		$this->contactTypes = new ContactTypesTable();
		$this->users = new UsersTable();
		$this->task = new TaskTable();
	}
	public function NewUser($name , $email, $contacttype_id)
	{
		$params = array(
			'name' 	=> $name,
			'email' => $email,
			'contacttype_id' => $contacttype_id
		);
		
		$this->users->insert($params);
		
	}
	/**
	 * @return Zend_Db_Table_Rowset
	 */	
	public function GetUser($id)
	{
		return $this->users->find($id);	
	}
	public function GetTask($id)
	{
		return $this->task->find($id);	
	}
	public function GetAllTasks()
	{
		return $this->task->fetchAll();
	}
	private function getWhere($id)
	{
		return $this->users->getAdapter()->quoteInto('id = ?',$id);
	}
	public function SaveUser($id, $name, $email, $contacttype_id)
	{ 		
		$params = array(
			'name' 	=> $name,
			'email' => $email,
			'contacttype_id' => $contacttype_id
		);
		
		$this->users->update($params, $this->getWhere($id));
		return true;
	}
	public function DeleteUser($id)
	{
		$this->users->delete($this->getWhere($id));
	}
	public function GetAllUsers()
	{
			
		$select = $this->users->select();
		$select->order('name');
		return $this->users->fetchAll($select);
	}
	public function GetContactTypeByName($name)
	{
		$where = $this->contactTypes->getAdapter()->quoteInto('LOWER(name) = ?', strtolower($name));
		
		return $this->contactTypes->fetchRow($where);
	}
		
	public function GetAllContactTypes()
	{
		return $this->contactTypes->fetchAll();
	}
		
	
}

?>