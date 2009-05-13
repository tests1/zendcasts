<?php

class App_forms_Associate extends Zend_Form 
{
	protected $formState;
	protected $taskCheckboxPrefix = "task_";
	public function __construct($user, $tasks)
	{
		$userId = new Zend_Form_Element_Hidden("userid");

		$userId->setValue($user[0]->id);
		
		$this->addElement($userId);
		
		
		
		foreach($tasks as $task)
		{
			$t = new Zend_Form_Element_Checkbox(
					$this->taskCheckboxPrefix . $task->id);
			
			$t->setLabel($task->name);
			$this->addElement($t);
		}
		
		$currentTasks = $user[0]->findManyToManyRowset('TaskTable', 'TasksUsers')->toArray();
		foreach ($currentTasks as $task)
		{
			$this->getElement($this->taskCheckboxPrefix . $task['id'])
				 ->setValue("1");
		}	
		
		$this->addElement(new Zend_Form_Element_Submit("Submit"));
		
		$this->setDecorators(array(
		    'FormElements',
		    array('HtmlTag', array('tag' => 'dl')),
		    'Form'
		));
		
	}
	
	public function persistData()
	{
		$taskIds = array();
		$userId = $this->getValue("userid");
		foreach ($this->getElements() as $id=>$emt)
		{
			if (strstr($id, $this->taskCheckboxPrefix))
			{
				
				if ($emt->getValue() == "1")
				{					
					$taskIds[] = substr($id, 
										strlen($this->taskCheckboxPrefix));
				}
			}
			
		}
		$taskContactTypes = new TasksUsers();
		$where = $taskContactTypes->getAdapter()->quoteInto('user_id = ?', $userId);
		$taskContactTypes->delete($where);
		
		foreach ($taskIds as $taskId)
		{
			$taskContactTypes->insert(array("user_id" => $userId , 
											"task_id" => $taskId ));
		}
		
				
		
	}
}