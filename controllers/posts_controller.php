<?php
class PostsController extends AppController {

	var $name = 'Posts';

	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	#var $components = array('Alaxos.AlaxosFilter','Auth', 'RequestHandler');
	var $components = array('Alaxos.AlaxosFilter','Auth', 'RequestHandler');
	
	function beforeFilter() {
		$this->Auth->allow('index','view');
	 }

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Post.created' => 'desc'
        )
    );


	function index() {
		$this->Post->recursive = 0;
		
		if($this->data['Post']['q']) {
					$q = $this->data['Post']['q']; 
					
					$options = array(
					"Post.Title LIKE '%" .$q ."%'" ." OR Post.Body LIKE '%" .$q ."%'"					);										

					$this->set(array('posts' => $this->paginate('Post', $options))); 

		} else {
		$this->set('posts', $this->paginate());
	}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
	}

	
function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for Post', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Post->delete($id))
		{
			$this->Session->setFlash(___('Post deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('Post was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	

function autoComplete() {
	//Partial strings will come from the autocomplete field as
	//$this->data['Post']['subject'] 
	$this->set('posts', $this->Post->find('all', array(
				'conditions' => array(
					'Post.title LIKE' => $this->data['Post']['title'].'%'
				),
				'fields' => array('title')
	)));
	$this->layout = 'ajax';
}

}
?>
