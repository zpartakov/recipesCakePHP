<?php
class ModeCuissonsController extends AppController {

	var $name = 'ModeCuissons';
	
		var $components = array('Auth','RequestHandler');

  function beforeFilter() {
		$this->Auth->allow('index','view');
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
}
?>
