<?php
class UsersTagsController extends AppController {

	var $name = 'UsersTags';
	var $components = array('Auth');
	
	function index() {
		$this->UsersTag->recursive = 0;
		$this->set('usersTags', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid users tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usersTag', $this->UsersTag->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UsersTag->create();
			if ($this->UsersTag->save($this->data)) {
				$this->Session->setFlash(__('The users tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users tag could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UsersTag->User->find('list');
		$recettes = $this->UsersTag->Recette->find('list');
		$tags = $this->UsersTag->Tag->find('list');
		$this->set(compact('users', 'recettes', 'tags'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid users tag', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersTag->save($this->data)) {
				$this->Session->setFlash(__('The users tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersTag->read(null, $id);
		}
		$users = $this->UsersTag->User->find('list');
		$recettes = $this->UsersTag->Recette->find('list');
		$tags = $this->UsersTag->Tag->find('list');
		$this->set(compact('users', 'recettes', 'tags'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsersTag->delete($id)) {
			$this->Session->setFlash(__('Users tag deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users tag was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>