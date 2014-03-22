<?php
class StatsController extends AppController {

	var $name = 'Stats';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter','Auth','RequestHandler');

  function beforeFilter() {
		$this->Auth->allow('resume');
	 }

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Stat.date' => 'desc'
        )
    );
    
    	function index()
	{
		$this->Stat->recursive = 0;
		$this->set('stats', $this->paginate($this->Stat, $this->AlaxosFilter->get_filter()));
		
		$recettes = $this->Stat->Recette->find('list');
		$users = $this->Stat->User->find('list');
		$this->set(compact('recettes', 'users'));
	}
    
	function resume()
	{
		$this->Stat->recursive = 0;
		$options="
			SELECT id, COUNT( id ) AS hits , recette_id 
			FROM `stats` 
			GROUP BY recette_id 
			ORDER BY hits DESC 
			LIMIT 0, 100
			";
		$this->set('stats', $this->Stat->Recette->query($options));
		
		if($_SESSION['Auth']['User']['role']=="administrator") { 
		$options="
			SELECT id, COUNT( id ) AS hits , recette_id 
			FROM `stats` 
			WHERE user_id = " .$_SESSION['Auth']['User']['id'] ."  
			GROUP BY recette_id 
			ORDER BY hits DESC 
			LIMIT 0, 100
			";
			#echo $options; exit;
		$this->set('mystats', $this->Stat->Recette->query($options));
			
		}
		$recettes = $this->Stat->Recette->find('list');
		$users = $this->Stat->User->find('list');
		$this->set(compact('recettes', 'users'));
	}

	function view($id = null)
	{
		$this->_set_stat($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Stat->create();
			if ($this->Stat->save($this->data))
			{
				$this->Session->setFlash(___('the stat has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the stat could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$recettes = $this->Stat->Recette->find('list');
		$users = $this->Stat->User->find('list');
		$this->set(compact('recettes', 'users'));
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid stat', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Stat->save($this->data))
			{
				$this->Session->setFlash(___('the stat has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the stat could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_stat($id);
		
		$recettes = $this->Stat->Recette->find('list');
		$users = $this->Stat->User->find('list');
		$this->set(compact('recettes', 'users'));
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for stat', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Stat->delete($id))
		{
			$this->Session->setFlash(___('stat deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('stat was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Stats/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Stat/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Stat->deleteAll(array('Stat.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Stats deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Stats were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No stat to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_stat($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Stat->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Stat', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('stat', $this->data);
	}
	
	
}

######### external functions ##########
function titre_recette($id) {
	$sql="SELECT titre FROM `recettes` WHERE recettes.id =" .$id;
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	echo mysql_result($result,0,'titre');
}
?>
