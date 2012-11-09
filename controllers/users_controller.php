<?php
#http://book.cakephp.org/view/1250/Authentication
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	#var $helpers = array('Form');
	#var $components = array('Alaxos.AlaxosFilter','Alaxos.AlaxosAccessManager');
	#var $components = array('Alaxos.AlaxosFilter','RequestHandler','Auth');

	var $components = array('Alaxos.AlaxosFilter','Auth');
	var $paginate = array(
        'limit' => 30,
        'order' => array(
            'User.email' => 'asc'
        )
    );


  function beforeFilter() {
#		$this->Auth->allow('login','logout','langue', 'passwordreminder', 'renvoiemail', 'confirmation');
		$this->Auth->allow('login','logout');
	 }

	function index()
	{
				eject_non_admin(); //on autorise pas les non-administrateurs

		$this->User->recursive = 0;
		$this->set('users', $this->paginate($this->User, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_user($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->User->create();
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid user', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_user($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for user', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->User->delete($id))
		{
			$this->Session->setFlash(___('user deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('user was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Users/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/User/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->User->deleteAll(array('User.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Users deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Users were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No user to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_user($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->User->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for User', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('user', $this->data);
	}
	
	
	function admin_index()
	{
		$this->User->recursive = 0;
		$this->set('users', $this->paginate($this->User, $this->AlaxosFilter->get_filter()));
		
	}

	function admin_view($id = null)
	{
		$this->_set_user($id);
	}

	function admin_add()
	{
		if (!empty($this->data))
		{
			$this->User->create();
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function admin_edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid user', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_user($id);
		
	}

	function admin_delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for user', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->User->delete($id))
		{
			$this->Session->setFlash(___('user deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('user was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
	        if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Users/admin_' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/User/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->User->deleteAll(array('User.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Users deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Users were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No user to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
		function login() {
		/*$this->loadModel('ErgoLangue');*/
		# $langues = $this->ErgoLangue->find('all');
		#$this -> Session -> write("variable", "value");
			$this->Session->setFlash("Vous êtes maintenant connecté.");

		#$this->redirect(array('page'=>'home'));
	}


    function logout()
    {
	#destroy session language
	$this->Session->setFlash("Vous êtes maintenant déconnecté.");
	$this->redirect($this->Auth->logout());
    } 
	
	
}
?>
