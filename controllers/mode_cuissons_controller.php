<?php
class ModeCuissonsController extends AppController {

	var $name = 'ModeCuissons';
	
		var $components = array('Auth','RequestHandler');

  function beforeFilter() {
		$this->Auth->allow('index','view','liste_modecuisson');
	 }
	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'ModeCuisson.lib' => 'desc'
        )
    );
	function index() {
		$this->ModeCuisson->recursive = 0;
		$this->set('modeCuissons', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid mode cuisson', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('modeCuisson', $this->ModeCuisson->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ModeCuisson->create();
			if ($this->ModeCuisson->save($this->data)) {
				$this->Session->setFlash(__('The mode cuisson has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mode cuisson could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid mode cuisson', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ModeCuisson->save($this->data)) {
				$this->Session->setFlash(__('The mode cuisson has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mode cuisson could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ModeCuisson->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mode cuisson', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ModeCuisson->delete($id)) {
			$this->Session->setFlash(__('Mode cuisson deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mode cuisson was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function modecuisson() {
	}
	
	/*affiche tous les ingrédients */
	
	function liste_modecuisson() {
		$sql="SELECT * FROM mode_cuissons ORDER BY lib";
		#echo $sql;
		$result = mysql_query($sql);
		testsql($result);
		echo "<select name=\"mode_cuisson\" size=\"18\">";
		echo "<option value='' selected>-- tous --";
		$i=0;
		while ($i < mysql_num_rows($result)) {
	
			echo "<option value=\"" .mysql_result($result,$i,'id') ."\">" .mysql_result($result,$i,'lib') ."</option>\n";
			$i++;
		}
		echo "</select>";
	}
}
?>
