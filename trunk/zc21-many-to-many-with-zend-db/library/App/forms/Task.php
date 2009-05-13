<?php

class App_forms_Task extends Zend_Form 
{
	
	protected $formState;
	
	public function __construct($formState = "create", $currentTask = null)
	{
		$this->formState = $formState;
	

		$id = new Zend_Form_Element_Hidden("id");
		$name = new Zend_Form_Element_Text("name");
		$name->setLabel("Task Name:");
		
		
		$submit = new Zend_Form_Element_Submit($formState);
		if ($this->formState == "update")
		{
			$id->setValue($currentTask[0]->id);
			$name->setValue($currentTask[0]->name);	
		}
		
		$this->addElements(array($id,$name,$submit));
		
			
		$this->setDecorators(array(
		    'FormElements',
		    array('HtmlTag', array('tag' => 'dl')),
		    'Form'
		));
	}
	
	public function persistData()
	{
		$taskTable = new TaskTable();
		$this->removeElement($this->formState);	
		if ($this->formState == "update")
		{
			
			$where = $taskTable->getAdapter()
					 ->quoteInto('id = ?',$this->getValue('id'));	
			$taskTable->update($this->getValues(),$where);
			
		}
		else
			$taskTable->insert($this->getValues());
			
		$this->addElement(new Zend_Form_Element_Submit($this->formState));
		
	}
}

?>