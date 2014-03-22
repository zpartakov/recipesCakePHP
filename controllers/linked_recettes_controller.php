<?php
class LinkedRecettesController extends AppController {

	var $name = 'LinkedRecettes';
    var $components = array('Auth');

	function index() {
		$this->LinkedRecette->recursive = 0;
		$this->set('linkedRecettes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid linked recette', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('linkedRecette', $this->LinkedRecette->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->LinkedRecette->create();
			if ($this->LinkedRecette->save($this->data)) {
				$this->Session->setFlash(__('The linked recette has been saved', true));
//				$this->redirect(array('action' => 'index'));
				$this->redirect($this->referer());

			} else {
				$this->Session->setFlash(__('The linked recette could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid linked recette', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->LinkedRecette->save($this->data)) {
				$this->Session->setFlash(__('The linked recette has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linked recette could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LinkedRecette->read(null, $id);
		}
		$recettes = $this->LinkedRecette->Recette->find('list');
		$this->set(compact('recettes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for linked recette', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LinkedRecette->delete($id)) {
			$this->Session->setFlash(__('Linked recette deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Linked recette was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
