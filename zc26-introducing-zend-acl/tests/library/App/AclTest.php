<?php

class AclTest extends ControllerTestCase 
{
	/**
	 * Our ACL being tested
	 *
	 * @var App_Acl
	 */
	protected $acl;
	
	public function setUp()
	{
		parent::setUp();
		$this->acl = new App_Acl();
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