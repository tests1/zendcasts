<?php

/**
 * TasksUsers
 *  
 * @author jon
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class TasksUsers extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'tasks_users';

	

    protected $_referenceMap    = array(
        'Task' => array(
            'columns'           => array('task_id'),
            'refTableClass'     => 'TaskTable',
            'refColumns'        => array('id')
        ),
        'User' => array(
            'columns'           => array('user_id'),
            'refTableClass'     => 'UsersTable',
            'refColumns'        => array('id')
        )
    );
	
}
