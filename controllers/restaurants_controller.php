<?php
class RestaurantsController extends AppController {

	var $name = 'Restaurants';
	var $components = array('Auth','RequestHandler');
 function beforeFilter() {
		$this->Auth->allow('index','view');
	 }

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Restaurant.id' => 'desc'
        )
    );

	function index() {
		$this->Restaurant->recursive = 0;
		
		if($this->data['Restaurant']['q']) {
					$q = $this->data['Restaurant']['q']; 
					
					$options = array(
					"Restaurant.nom LIKE '%" .$q ."%'" ." OR Restaurant.ville LIKE '%" .$q ."%' OR Restaurant.type LIKE '%" .$q ."%'"					);										

					$this->set(array('restaurants' => $this->paginate('Restaurant', $options))); 

		} else {
		
		
		
		$this->set('restaurants', $this->paginate());
	}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid restaurant', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('restaurant', $this->Restaurant->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Restaurant->create();
			if ($this->Restaurant->save($this->data)) {
				$this->Session->setFlash(__('The restaurant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The restaurant could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid restaurant', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Restaurant->save($this->data)) {
				$this->Session->setFlash(__('The restaurant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The restaurant could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Restaurant->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for restaurant', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Restaurant->delete($id)) {
			$this->Session->setFlash(__('Restaurant deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Restaurant was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
