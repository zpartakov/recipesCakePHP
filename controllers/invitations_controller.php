<?php
class InvitationsController extends AppController {

	var $name = 'Invitations';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');
	var $paginate = array(
        'limit' => 30,
        'order' => array(
            'Invitation.id' => 'desc'
        )
    );
	function index()
	{
		$this->Invitation->recursive = 0;
		$this->set('invitations', $this->paginate($this->Invitation, $this->AlaxosFilter->get_filter()));
		
		$menus = $this->Invitation->Menu->find('list');
		$this->set(compact('menus'));
	}

	function view($id = null)
	{
		$this->_set_invitation($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Invitation->create();
			if ($this->Invitation->save($this->data))
			{
				$this->Session->setFlash(___('the invitation has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the invitation could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$menus = $this->Invitation->Menu->find('list');
		$this->set(compact('menus'));
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid invitation', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Invitation->save($this->data))
			{
				$this->Session->setFlash(___('the invitation has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the invitation could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_invitation($id);
		
		$menus = $this->Invitation->Menu->find('list');
		$this->set(compact('menus'));
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for invitation', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Invitation->delete($id))
		{
			$this->Session->setFlash(___('invitation deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('invitation was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Invitations/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Invitation/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Invitation->deleteAll(array('Invitation.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Invitations deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Invitations were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No invitation to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_invitation($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Invitation->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Invitation', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('invitation', $this->data);
	}
	
	
}
?>