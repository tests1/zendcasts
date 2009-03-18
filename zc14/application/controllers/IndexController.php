<?php

/**
 * Description of IndexController
 *
 * @author jon
 */
class IndexController extends Zend_Controller_Action {


	public function indexAction()
	{
			$items[] = $this->newItem("Jon" , 1);
			$items[] = $this->newItem("Jane" , 2);
			$items[] = $this->newItem("Alex" , 3);
			$items[] = $this->newItem("Mark" , 4);
			$items[] = $this->newItem("Smith" , 5);
			$this->view->items = $items;
	}


	private function newItem($name, $id)
	{
		$item = new stdClass();
		$item->name = $name;
		$item->id = $id;
		return $item;
	}

}
