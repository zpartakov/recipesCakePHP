<?php
class GroupsController extends AppController {

	var $name = 'Groups';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');

	function index()
	{
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate($this->Group, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_group($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Group->create();
			if ($this->Group->save($this->data))
			{
				$this->Session->setFlash(___('the group has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the group could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid group', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Group->save($this->data))
			{
				$this->Session->setFlash(___('the group has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the group could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_group($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for group', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Group->delete($id))
		{
			$this->Session->setFlash(___('group deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('group was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Groups/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Group/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Group->deleteAll(array('Group.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Groups deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Groups were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No group to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_group($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Group->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Group', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('group', $this->data);
	}
	
	
	function admin_index()
	{
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate($this->Group, $this->AlaxosFilter->get_filter()));
		
	}

	function admin_view($id = null)
	{
		$this->_set_group($id);
	}

	function admin_add()
	{
		if (!empty($this->data))
		{
			$this->Group->create();
			if ($this->Group->save($this->data))
			{
				$this->Session->setFlash(___('the group has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the group could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function admin_edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid group', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Group->save($this->data))
			{
				$this->Session->setFlash(___('the group has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the group could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_group($id);
		
	}

	function admin_delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for group', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Group->delete($id))
		{
			$this->Session->setFlash(___('group deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('group was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
	        if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Groups/admin_' . $this->data['_Tech']['action']))
	        {
	            $this->setAction('admin_' . $this->data['_Tech']['action']);
	        }
	        elseif(!isset($this->Acl))
	        {
	        	$this->setAction('admin_' . $this->data['_Tech']['action']);
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
	
	function admin_deleteAll()
	{
	    $ids = Set :: extract('/Group/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Group->deleteAll(array('Group.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Groups deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Groups were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No group to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	
}
?>