<?php
class IngredientsController extends AppController {

	var $name = 'Ingredients';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter','Auth','RequestHandler');
	
	function beforeFilter() {
		$this->Auth->allow('index','view','liste_ingredients');
	 }

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Ingredient.libelle' => 'asc'
        )
    );
    
	function index()
	{
		$this->Ingredient->recursive = 0;
		$this->set('ingredients', $this->paginate($this->Ingredient, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_ingredient($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Ingredient->create();
			if ($this->Ingredient->save($this->data))
			{
				$this->Session->setFlash(___('the ingredient has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the ingredient could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid ingredient', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Ingredient->save($this->data))
			{
				$this->Session->setFlash(___('the ingredient has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the ingredient could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_ingredient($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for ingredient', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Ingredient->delete($id))
		{
			$this->Session->setFlash(___('ingredient deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('ingredient was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Ingredients/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Ingredient/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Ingredient->deleteAll(array('Ingredient.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Ingredients deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Ingredients were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No ingredient to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_ingredient($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Ingredient->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Ingredient', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('ingredient', $this->data);
	}
	
		/*affiche tous les ingrédients */

function liste_ingredients() {
	$sql="SELECT * FROM ingredients ORDER BY libelle";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	echo "<select name=\"ingr\" size=\"18\">";
	echo "<option value='' selected>-- all --";
	$i=0;
	while ($i < mysql_num_rows($result)) {
		
		echo "<option value=\"" .preg_replace("/'/","%",mysql_result($result,$i,'libelle')) ."\">" .mysql_result($result,$i,'libelle') ."</option>\n";
		$i++;
	}
	echo "</select>";
}
	
}

########################### OUT OF MAIN CLASS ############

?>
