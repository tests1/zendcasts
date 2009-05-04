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
	
	protected $_referenceMap = array(
		'ContactTypes' => array(
			'columns'	=> array('contacttype_id'),
			'refTableClass'	=> 'ContactTypesTable',
			'refColumns'	=> array('id')
		)
	);

}
