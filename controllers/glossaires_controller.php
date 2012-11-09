<?php
class GlossairesController extends AppController {

	var $name = 'Glossaires';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter','Auth','RequestHandler');
	
	function beforeFilter() {
		$this->Auth->allow('index','view');
	 }

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Glossaire.libelle' => 'asc'
        )
    );
	function index()
	{
	
		$this->Glossaire->recursive = 0;

			$this->set('glossaires', $this->paginate($this->Glossaire, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_glossaire($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Glossaire->create();
			if ($this->Glossaire->save($this->data))
			{
				$this->Session->setFlash(___('the glossaire has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the glossaire could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid glossaire', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Glossaire->save($this->data))
			{
				$this->Session->setFlash(___('the glossaire has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the glossaire could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_glossaire($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for glossaire', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Glossaire->delete($id))
		{
			$this->Session->setFlash(___('glossaire deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('glossaire was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Glossaires/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Glossaire/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Glossaire->deleteAll(array('Glossaire.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Glossaires deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Glossaires were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No glossaire to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_glossaire($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Glossaire->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Glossaire', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('glossaire', $this->data);
	}
	
	
}
?>
