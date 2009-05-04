<?php
require_once 'UsersTable.php';
require_once 'ContactTypesTable.php';

class App_UserService 
{
	protected $db;
	
	/**
	 * users Zend Table
	 *
	 * @var UsersTable
	 */
	protected $users;
	
	/**
	 * ContactType Zend Table
	 *
	 * @var ContactTypesTable
	 */
	protected $contactTypes;
	
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
		$this->contactTypes = new ContactTypesTable();				
	}
	public function NewTestUser()
	{
		$params = array(
			'name' => 'jane doe',
			'email' => 'jane@doe.com');
		$this->users->insert($params);
	}
	public function SaveUser($id, $name, $email,$contacttype_id)
	{
		if (!intval($contacttype_id))
			$contacttype_id = NULL;
					
		$params = array(
			'name' => $name,
			'email' => $email,
			'contacttype_id' => $contacttype_id
	
		);
		$this->users->update($params, $this->getWhereClauseForUserId($id));
		
	}
	private function getWhereClauseForUserId($id)
	{
		return $this->users->getAdapter()->quoteInto('id = ?', $id);	
	}
	public function NewUser($name , $email, $contacttype_id)
	{
		if (!intval($contacttype_id))
			$contacttype_id = NULL;
		
		$params = array(
			'name' => $name,
			'email' => $email,
			'contacttype_id' => $contacttype_id
		);
		$this->users->insert($params);
				
	}
	public function DeleteUser($id)
	{
		$this->users->delete($this->getWhereClauseForUserId($id));
	}
	public function GetUser($id)
	{
		return $this->users->find($id);
	}
	public function GetAllUsers()
	{
		$select = $this->users->select();
		$select->order('name');
		
		return $this->users->fetchAll($select);
		
	}
	public function GetContactTypeByName($searchWith)
	{
		$where = $this->contactTypes->getAdapter()->quoteInto('LOWER(name) = ?' , $searchWith);
		return $this->contactTypes->fetchRow($where);
	}
	public function GetUsersByContactType(Zend_Db_Table_Row  $row)
	{
		return $this->users->fetchAll(
		$this->users->select()->where('contacttype_id = ?', $row->id));	
	}
	public function GetAllContactTypes()
	{
		return $this->contactTypes->fetchAll();	
	}
	
	
	
}

?>