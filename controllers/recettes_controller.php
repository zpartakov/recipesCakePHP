<?php
class RecettesController extends AppController {

	var $name = 'Recettes';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter','Auth','RequestHandler');

  function beforeFilter() {
		$this->Auth->allow('index','chercher','view','total_recettes','pays','les_types','nouveau','rss');
	 }

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Recette.date' => 'desc'
        )
    );

	function index()
	{
		$this->Recette->recursive = 0;
		
	if( $this->RequestHandler->isRss() ){
        $recettes = $this->Recette->find('all', array('limit' => 20, 'order' => 'Recette.date DESC'));
        $this->set(compact('recettes'));
    } else {
		if(!$_SESSION['Auth']['User']['role']) { 
			 $recettes = $this->Recette->find('all', array('conditions' => array('Recette.private' => '0')));
		} else {
			$recettes=$this->Recette;
		}
		$this->set('recettes', $this->paginate($recettes, $this->AlaxosFilter->get_filter()));
	}
	}

	function chercher() {
	}

	function view($id = null)
	{
		$this->_set_recette($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Recette->create();
			$this->data['Recette']['titre']=ucfirst($this->data['Recette']['titre']);
			$this->data['Recette']['titre']=trim($this->data['Recette']['titre']);
			$this->data['Recette']['ingr']=trim($this->data['Recette']['ingr']);
			
	    // upload the file to the server  
	    if(strlen($this->data['Recette']['image']['tmp_name'])>1) {
		$success = move_uploaded_file($this->data['Recette']['image']['tmp_name'], WWW_ROOT.'img/pics/'.$this->data['Recette']['pict']);
   					if(!$success) {
						$result['errors'][] = "Error uploaded file. Please try again.";
					}
		}
  /* if(strlen($this->data['Recette']['image']['tmp_name'])<1) {
	   $this->data['Recette']['pict']="";
   }*/
		if ($this->Recette->save($this->data))
			{
				$this->Session->setFlash(___('the recette has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'add'));
			}
			else
			{
				$this->Session->setFlash(___('the recette could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}
	
	
	
function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid recette', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Recette->save($this->data))
			{
				$this->Session->setFlash(___('the recette has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the recette could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_recette($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for recette', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Recette->delete($id))
		{
			$this->Session->setFlash(___('recette deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('recette was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Recettes/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Recette/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Recette->deleteAll(array('Recette.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Recettes deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Recettes were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No recette to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_recette($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Recette->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for Recette', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('recette', $this->data);
	}
	
	
	
/*affiche le nombre de recettes*/
function total_recettes() {
	$today=date("Y-m-d");
	//if($this->Session->read('Auth.User.role')!="administrator") {//surfer
	if(!$this->Session->read('Auth.User.role')) {//surfer
		$admin=" WHERE (date <= '" .$today ."') AND private=0";   
	}
	$sql="SELECT * FROM recettes " .$admin;
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	echo "<br><font color=red>Total recettes: $nbrec</font></span><br>";
}

	
/*affiche la liste des pays*/
function pays() {
	$today=date("Y-m-d");
	//if($this->Session->read('Auth.User.role')!="administrator") {//surfer
		if(!$this->Session->read('Auth.User.role')) {//surfer

		$admin=" WHERE (date <= '" .$today ."') AND private=0";   
	}
	$sql="SELECT COUNT(id),prov FROM recettes " .$admin ." GROUP BY prov";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$nbrec2=$nbrec+1;
	$nbrec2=24;
	#echo $nbrec;
	echo "<h2>Provenance</h2>";
	echo "<select name=prov size=" .$nbrec2 ."><option value='' selected>-- all --";
	$i=0;
	while($i<$nbrec) {
		$prov=mysql_result($result,$i,'prov');
		if ($prov=="") {
			$prov=" *** sans *** ";
		}
		$hit=mysql_result($result,$i,'count(id)');
		echo "<option value=\"$prov\">" .$prov ." # " .$hit ."\n";
		$i++;
	}
	echo "</select>";
	}
	

	/*affiche la liste des types de recettes*/
function les_types() {
	$sql="SELECT COUNT(recettes.id) AS total,type_id,name FROM `recettes`, `types` WHERE type_id=types.id GROUP BY type_id";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$nbrec2=$nbrec+1;
	echo "<select name=typ size=" .$nbrec2."><option value='' selected>-- all --";
	$i=0;
	while($i<$nbrec) {
		$prov=mysql_result($result,$i,'type_id');
		$hit=mysql_result($result,$i,'total');
		$provT=mysql_result($result,$i,'name');
		$provT=ucfirst($provT);
		echo "<option value=\"$prov\">" .$provT ." # " .$hit ."\n";
		$i++;
	}
	echo "</select>";
}


	/*affiche la liste des titres des recettes (pour les menus) */
function recettesTitresAZ() {
	$sql="SELECT id,titre FROM `recettes` ORDER BY titre";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$i=0;
	while($i<$nbrec) {
		$id=mysql_result($result,$i,'id');
		$titre=mysql_result($result,$i,'titre');
		$titre=ucfirst($titre);
		echo "<option value=\"".$id ."\">" .substr($titre,0,50) ."</option>\n";
		$i++;
	}
}

function rss() {
       $this->layout = '';
      
}

}




########################### OUT OF MAIN CLASS ############


//renvoyer le libellé du type
function le_type_lib($idt) {
#$letype=preg_replace("/7/","Entrées",$idt);
	$sqltl="SELECT name FROM types WHERE id =" .$idt;
#	echo $sqltl; 
#echo $letype;
	$result = mysql_query($sqltl); 
	testsql($result);
	echo mysql_result($result,0,'name');
}

	/*affiche la liste des pays pour ajout recette*/
function addpays($pays) {
#echo "Pays" .$pays ."<br>";
	$sql="SELECT prov FROM recettes GROUP BY prov";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
		$nbrec=mysql_num_rows($result);

	#echo $nbrec;
	echo "<select id=\"RecetteProv\" name=\"data[Recette][prov]\" size=\"5\"\">";
	echo "<option value=''";
	if(strlen($pays)<1){
		echo " selected";
	}
	echo ">-- all --</option>\n";
	$i=0;
	while($i<$nbrec) {
		$prov=mysql_result($result,$i,'prov');
		echo "<option value=\"" .$prov ."\"";
		//special to erase later
		if('$prov'=='$pays') {
			echo " selected";
		}
		echo ">" .$prov ."</option>\n";
		$i++;
	}
	echo "</select>";
	}
	
	/*affiche la liste des types de recettes*/
function addtypes() {
	$sql="SELECT COUNT(recettes.id) AS total,type_id,name FROM `recettes`, `types` WHERE type_id=types.id GROUP BY type_id";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	echo "<select id=\"RecetteTypeId\" name=\"data[Recette][type_id]\"><option value='' selected>-- all --</option>\n";
	$i=0;
	while($i<$nbrec) {
		$prov=mysql_result($result,$i,'type_id');
		$provT=mysql_result($result,$i,'name');
		$provT=ucfirst($provT);
		echo "<option value=\"$prov\"";
		if($prov=="7") { echo " selected";}
		echo ">" .$provT ."</option>\n";
		$i++;
	}
	echo "</select>";
}

/* une fonction pour générer des statistiques sur les recettes les plus consultées, appellée lors de chaque "view" d'une recette */
function stats($id) {
	$sql="INSERT INTO `akademiach9`.`stats` (
	`id` ,
	`recette_id` ,
	`user_id` ,
	`ip`,
	`date`
	)
	VALUES (
	NULL , '" .$id ."', '" .$_SESSION['Auth']['User']['id'] ."', '" .$_SERVER["REMOTE_ADDR"]  ."', '".date("Y-m-d H:i:s") ."'
	)";
#	echo $sql."<br>";
	$result = mysql_query($sql); 
	testsql($result);
}

	
?>
