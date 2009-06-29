<?php

class App_Acl extends Zend_Acl 
{
	public function __construct()
	{
		// resources
		$this->add(new Zend_Acl_Resource(App_Resources::ACCOUNT_FREE));
		$this->add(new Zend_Acl_Resource(App_Resources::ACCOUNT_PAID));
		$this->add(new Zend_Acl_Resource(App_Resources::ADMIN_SECTION));
		$this->add(new Zend_Acl_Resource(App_Resources::PUBLICPAGE));

		$this->addRole(new Zend_Acl_Role(App_Roles::GUEST));
		$this->addRole(new Zend_Acl_Role(App_Roles::FREE),App_Roles::GUEST);
		$this->addRole(new Zend_Acl_Role(App_Roles::PAID), App_Roles::FREE);
		$this->addRole(new Zend_Acl_Role(App_Roles::ADMIN), App_Roles::PAID);
		
		$this->allow(App_Roles::GUEST , App_Resources::PUBLICPAGE);
		$this->allow(App_Roles::ADMIN , App_Resources::ADMIN_SECTION);
		$this->allow(App_Roles::FREE , App_Resources::ACCOUNT_FREE);
		$this->allow(App_Roles::PAID , App_Resources::ACCOUNT_PAID);
		
		$this->deny(App_Roles::PAID , App_Resources::ACCOUNT_FREE);
		$this->allow(App_Roles::ADMIN , App_Resources::ACCOUNT_FREE);
		
		
	}
}
