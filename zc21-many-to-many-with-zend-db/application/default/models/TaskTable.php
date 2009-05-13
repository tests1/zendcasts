<?php

/**
 * TaskTable
 *  
 * @author jon
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class TaskTable extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'task';

}
