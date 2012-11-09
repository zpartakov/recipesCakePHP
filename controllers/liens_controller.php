<?php
class LiensController extends AppController {

	var $name = 'Liens';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter','Auth');
	
	  function beforeFilter() {
#		$this->Auth->allow('login','logout','langue', 'passwordreminder', 'renvoiemail', 'confirmation');
		$this->Auth->allow('view','index');
	 }
	
	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Lien.date' => 'desc'
        )
    );	
    	
	function index()
	{
		$this->Lien->recursive = 0;
		$this->set('liens', $this->paginate($this->Lien, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_lien($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Lien->create();
			if ($this->Lien->save($this->data))
			{
				$this->Session->setFlash(___('the lien has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the lien could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid lien', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Lien->save($this->data))
			{
				$this->Session->setFlash(___('the lien has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the lien could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_lien($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for lien', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Lien->delete($id))
		{
			$this->Session->setFlash(___('lien deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('lien was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Liens/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Lien/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Lien->deleteAll(array('Lien.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Liens deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Liens were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No lien to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_lien($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Lien->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Lien', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('lien', $this->data);
	}
	
	
}
?>
