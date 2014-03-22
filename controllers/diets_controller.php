<?php
class DietsController extends AppController {

	var $name = 'Diets';
	var $components = array('Auth','RequestHandler');
	
	function beforeFilter() {
		$this->Auth->allow('index','view');
	}
	
	var $paginate = array(
			'limit' => 25,
			'order' => array(
					'Diet.lib' => 'asc'
			)
	);
	
	function index() {
		$this->Diet->recursive = 0;
		$this->set('diets', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid diet', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('diet', $this->Diet->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Diet->create();
			if ($this->Diet->save($this->data)) {
				$this->Session->setFlash(__('The diet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The diet could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid diet', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Diet->save($this->data)) {
				$this->Session->setFlash(__('The diet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The diet could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Diet->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for diet', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Diet->delete($id)) {
			$this->Session->setFlash(__('Diet deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Diet was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>