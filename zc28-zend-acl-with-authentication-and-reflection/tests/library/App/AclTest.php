<?php

class AclTest extends ControllerTestCase 
{
	/**
	 * Our ACL being tested
	 *
	 * @var App_Acl
	 */
	protected $acl;
	
	/**
	 * Authenticator
	 *
	 * @var App_Auth_Authenticator
	 */
	protected $auth;
	
	public function setUp()
	{
		parent::setUp();
		$this->acl = new App_Acl();
		$this->auth = new App_Auth_Authenticator();
	}
	public function testAdminUserAccountAccess()
	{
		$admin = $this->auth->getCredentials('admin','qwerty');		
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Resources::ACCOUNT_FREE));
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Resources::ACCOUNT_PAID));
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Resources::PUBLICPAGE));
	}
	public function testGuestUserAccountAccess()
	{
		$user = $this->auth->getCredentials('john', 'pa$$');
		$this->assertFalse($this->acl->isAllowed($user->role, App_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($user->role, App_Resources::ACCOUNT_FREE));
		$this->assertFalse($this->acl->isAllowed($user->role, App_Resources::ACCOUNT_PAID));
		$this->assertTrue($this->acl->isAllowed($user->role, App_Resources::PUBLICPAGE));
		
	}
	
	public function testAdminAccess()
	{
		$this->assertTrue($this->acl->isAllowed(App_Roles::ADMIN, App_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed(App_Roles::ADMIN, App_Resources::ACCOUNT_FREE));
		$this->assertTrue($this->acl->isAllowed(App_Roles::ADMIN, App_Resources::ACCOUNT_PAID));
		$this->assertTrue($this->acl->isAllowed(App_Roles::ADMIN, App_Resources::PUBLICPAGE));
	}
	public function testGuestAccess()
	{
		$guest = App_Roles::GUEST;
		$this->assertFalse($this->acl->isAllowed($guest , App_Resources::ADMIN_SECTION));
		$this->assertFalse($this->acl->isAllowed($guest , App_Resources::ACCOUNT_PAID));
		$this->assertFalse($this->acl->isAllowed($guest , App_Resources::ACCOUNT_FREE));
		$this->assertTrue($this->acl->isAllowed($guest , App_Resources::PUBLICPAGE));
		
	}
	public function testPaidAccess()
	{
		$paid = App_Roles::PAID;
		$this->assertFalse($this->acl->isAllowed($paid , App_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($paid , App_Resources::ACCOUNT_PAID));
		$this->assertFalse($this->acl->isAllowed($paid , App_Resources::ACCOUNT_FREE));
		$this->assertTrue($this->acl->isAllowed($paid , App_Resources::PUBLICPAGE));
		
	}
	
	
}

?>