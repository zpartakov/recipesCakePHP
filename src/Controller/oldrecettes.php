<?php
class RecettesController extends AppController {

var $name = 'Recettes';
var $helpers = array('Form', 'Fck','Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml','Html','Ajax','Javascript');
#var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml','Html','Ajax','Javascript');
var $components = array('Alaxos.AlaxosFilter','Auth','RequestHandler');

function beforeFilter() {
	$this->Auth->allow('index','chercher','view','total_recettes','pays','les_types','nouveau','rss','regime','les_regimes', 'suggestions');
}

var $paginate = array(
        'limit' => 100,
        'order' => array(
            'Recette.date' => 'desc'
        )
    );


/*
 * mise à jour des recettes 
 */
function putz() {
	
}

/* suggestions de recettes */
function suggestions(){
	
}
function cherchetitre() {
	/* 
	 * a function to search if the title is unique or not; if not, warns and give a link to the recipe matching
	 * */
}

function index()
{
	$this->Recette->recursive = 0;
	
	if( $this->RequestHandler->isRss() ){
	        $recettes = $this->Recette->find('all', array('conditions' => array('Recette.private' => '0'),'limit' => 30, 'order' => 'Recette.date DESC'));
	        $this->set(compact('recettes'));
	    } else {
	if(!$session->read('Auth.User.role')) {
	$recettes = $this->Recette->find('all', array('conditions' => array('Recette.private' => '0')));
	} else {
	$recettes=$this->Recette;
	}
	$this->set('recettes', $this->paginate($recettes, $this->AlaxosFilter->get_filter()));
	}
}
function mesrecettes() {
	/*
	 * a function to display all recipes from a given user
	 */
}
function chercher() {
}

function view($id = null)
{
	$this->_set_recette($id);
	$this->set('comment', $this->Recette->read(null, $id));
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
	$types = $this->Recette->Type->find('list');
	$modeCuissons = $this->Recette->ModeCuisson->find('list');
	$diets = $this->Recette->Diet->find('list');
	$this->set(compact('types', 'modeCuissons', 'diets'));
}





function webcopy()
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
	$types = $this->Recette->Type->find('list');
	$modeCuissons = $this->Recette->ModeCuisson->find('list');
	$diets = $this->Recette->Diet->find('list');
	$this->set(compact('types', 'modeCuissons', 'diets'));
}
function edit($id = null)
{
	/* protection
	 * 
	 * if the logged user is not an admin
	 * */
	if($_SESSION['Auth']['User']['role']!="administrator"){

		/*
		 * owner of the recipe?
		 */
		$sql="
		SELECT * FROM recettes,recette_user,users 
		 WHERE 
		 recettes.id=" .$id ."
		 AND recettes.id=recette_user.recette_id 
		 AND users.id=recette_user.user_id
		 AND users.id=" .$_SESSION['Auth']['User']['id'];
		
		//echo $sql;
		
		$sql=mysql_query($sql);
		/*
		 * not owner, sorry out!
		 */
		if(mysql_num_rows($sql)<1) {
		//echo 		mysql_num_rows($sql);
		echo "<br>unallowed"; 
		exit;
		}
	}
	/*
	 * end protection
	 */
	
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
	$types = $this->Recette->Type->find('list');
	
	$modeCuissons = $this->Recette->ModeCuisson->find('list', array('order' => array('ModeCuisson.lib ASC')));
	 $diets = $this->Recette->Diet->find('list', array('order' => array('Diet.lib ASC')));
	//$diets = $this->Recette->Diet->find('list', array('conditions' => array('ORDER Diet.lib' => 'asc')));
	
	$this->set(compact('types', 'modeCuissons', 'diets'));
	$this->_set_recette($id);

}

function delete($id = null)
{
	
		/* protection
	 * 
	 * if the logged user is not an admin
	 * */
	if($_SESSION['Auth']['User']['role']!="administrator"){

		/*
		 * owner of the recipe?
		 */
		$sql="
		SELECT * FROM recettes,recette_user,users 
		 WHERE 
		 recettes.id=" .$id ."
		 AND recettes.id=recette_user.recette_id 
		 AND users.id=recette_user.user_id
		 AND users.id=" .$_SESSION['Auth']['User']['id'];
		$sql=mysql_query($sql);
		/*
		 * not owner, sorry out!
		 */
		if(mysql_num_rows($sql)!=1) {
		//echo 		mysql_num_rows($sql);
		echo "<br>unallowed"; 
		exit;
		}
	}
	/*
	 * end protection
	 */
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
echo "<br><font color=red>Total recettes: $nbrec";

if($this->Session->read('Auth.User.role')) {//surfer
	$admin=" WHERE (date <= '" .$today ."') AND private=0";
	
$sql="SELECT * FROM recettes " .$admin;
#echo $sql;
$result = mysql_query($sql);
testsql($result);
$nbrec=mysql_num_rows($result);
echo " dont: " .$nbrec ." recettes publiques";
}


echo "</font></span><br>";
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

/*affiche la liste des régimes*/
function regime() {
	$sql="SELECT * FROM `diets` ORDER BY lib";
	#echo $sql; exit;
	$result = mysql_query($sql);
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$nbrec2=$nbrec+1;
	
	echo "<select name=\"data[Recette][diet_id]\" size=" .$nbrec2."><option value='' selected>-- all --";
	$i=0;
	while($i<$nbrec) {
		$prov=mysql_result($result,$i,'id');
		$provT=mysql_result($result,$i,'lib');
		$provT=ucfirst($provT);
		echo "<option value=\"$prov\">" .$provT ."\n</option>";
		$i++;	
	}
echo "</select>";
}

/*affiche la liste des régimes pour la recherche*/
function les_regimes() {
	$sql="SELECT * FROM `diets` ORDER BY lib";
	#echo $sql; exit;
	$result = mysql_query($sql);
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$nbrec2=$nbrec+1;

	echo "<select name=\"diet_id\" size=" .$nbrec2."><option value='' selected>-- all --";
	$i=0;
	while($i<$nbrec) {
		$prov=mysql_result($result,$i,'id');
		$provT=mysql_result($result,$i,'lib');
		$provT=ucfirst($provT);
		echo "<option value=\"$prov\">" .$provT ."\n</option>";
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



function autocomplete() {
	$this->set('recettes', $this->Recette->find('all', array(
			'conditions' => array(
					'Recette.titre =' => $this->data['Recette']['titre'].'%'
			),
			'fields' => array('titre')
	)));
	$this->layout = 'ajax';
}

}




########################### OUT OF MAIN CLASS ############


//renvoyer le libellé du type
function le_type_lib($idt) {
#$letype=preg_replace("/7/","Entrées",$idt);
$sqltl="SELECT name FROM types WHERE id =" .$idt;
# echo $sqltl;
#echo $letype;
$result = mysql_query($sqltl);
testsql($result);
echo mysql_result($result,0,'name');
}

function modecuisson($id) {
	
	$sql="SELECT * FROM mode_cuissons WHERE id=".$id;
	//echo $sql;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "sql error: " .mysql_error();
	}
	echo "<img alt=\"".mysql_result($sql,0,'lib')."\" title=\"".mysql_result($sql,0,'lib')."\" style=\"width: 70px\" src=\"/recettes2/img/glossaire/"
	.mysql_result($sql,0,'img')."\"><br/>".mysql_result($sql,0,'lib');

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
	echo "<select id=\"RecetteTypeId\" name=\"data[Recette][type_id]\" size=\"6\">
	<option value='' selected>-- all --</option>\n";
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
NULL , '" .$id ."', '" .$_SESSION['Auth']['User']['id'] ."', '" .$_SERVER["REMOTE_ADDR"] ."', '".date("Y-m-d H:i:s") ."'
)";
# echo $sql."<br>";
$result = mysql_query($sql);
testsql($result);
}

/*
 * renvoie les régimes
*/
function les_regimes($iddiet) {
	#$letype=preg_replace("/7/","Entrées",$idt);
	$sqltl="SELECT * FROM diets ORDER BY lib";
//echo $sqltl;
	$result = mysql_query($sqltl);
	testsql($result);
	echo '
	<label for="RecetteDietId">Régime</label>
	<select name="[diet_id]" id="RecetteDietId">';
	$i=0;
	while($i<mysql_num_rows($result)) {
		$lib=mysql_result($result,$i,'lib');
		echo "<option value=\"" .mysql_result($result,$i,'id') ."\"";
		//special to erase later
		if(mysql_result($result,$i,'id')=='$iddiet') {
			echo " selected";
		}
		echo ">" .mysql_result($result,$i,'lib') ."</option>\n";
		$i++;
	}

	echo '</select>';
}


/*
 * renvoie les régimes
*/
function mode_de_cuisson($id) {
	if(!$id){
		$id=21;
	}
	$sqltl="SELECT * FROM  mode_cuissons ORDER BY lib";
	$result = mysql_query($sqltl);
	testsql($result);
	echo '
	<label for="RecetteModeCuissonId">Mode Cuisson</label>
	<select name="data[Recette][mode_cuisson_id]" id="RecetteModeCuissonId">
	';
	$i=0;
	while($i<mysql_num_rows($result)) {
		$lib=mysql_result($result,$i,'lib');
		echo "<option value=\"" .mysql_result($result,$i,'id') ."\"";
		//special to erase later
		if(mysql_result($result,$i,'id')==$id) {
			echo " selected";
		}
		echo ">" .mysql_result($result,$i,'lib') ."</option>\n";
		$i++;
	}

	echo '</select>';
}


?>







