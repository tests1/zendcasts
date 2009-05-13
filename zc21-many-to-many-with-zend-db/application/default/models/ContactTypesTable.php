<?php

/**
 * ContactTypesTable
 *  
 * @author jon
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class ContactTypesTable extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'contacttypes';

	protected $_dependentTables = array('UsersTable');

}
