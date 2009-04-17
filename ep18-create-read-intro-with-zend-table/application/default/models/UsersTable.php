<?php

/**
 * UsersTable
 *  
 * @author jon
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class UsersTable extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'users';

}
