<?php
class MenusController extends AppController {

	var $name = 'Menus';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');

	function index()
	{
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate($this->Menu, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_menu($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Menu->create();
			if ($this->Menu->save($this->data))
			{
				$this->Session->setFlash(___('the menu has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the menu could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid menu', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Menu->save($this->data))
			{
				$this->Session->setFlash(___('the menu has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the menu could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_menu($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for menu', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Menu->delete($id))
		{
			$this->Session->setFlash(___('menu deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('menu was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Menus/' . $this->data['_Tech']['action']))
	        {
	            $this->setAction($this->data['_Tech']['action']);
	        }
	        elseif(!isset($this->Acl))
	        {
                $this->setAction($this->data['_Tech']['action']);
	        }
	        else
	        {
	        	if(isset($this->Auth))
	        	{
	            	$this->Session->setFlash($this->Auth->authError, $this->Auth->flashElement, array(), 'auth');
	            }
	            else
	            {
	            	$this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error');
	            }
	            
	            $this->redirect($this->referer());
	        }
	    }
	    else
	    {
	        $this->Session->setFlash(___d('alaxos', 'the action to perform is not defined', true), 'flash_error');
	        $this->redirect($this->referer());
	    }
	}
	
	function deleteAll()
	{
	    $ids = Set :: extract('/Menu/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Menu->deleteAll(array('Menu.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Menus deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Menus were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No menu to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_menu($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Menu->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Menu', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('menu', $this->data);
	}
	
	
}
?>