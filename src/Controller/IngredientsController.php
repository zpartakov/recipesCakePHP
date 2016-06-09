<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ingredients Controller
 *
 * @property \App\Model\Table\IngredientsTable $Ingredients
 */
class IngredientsController extends AppController
{
	/* VARIOUS AUTH BEGIN */
		public function isAuthorized($user) {
		}

		public function initialize()
		{
			parent::initialize();
			$this->loadComponent('Paginator');
			$this->loadComponent('RequestHandler'); //radeff added rss2
			$this->loadComponent('Auth');
			$this->Auth->allow(['index', 'view']);//radeff added rss6
		}

		public function beforeFilter(\Cake\Event\Event $event)
		{
			$this->Auth->allow('index','view');
		}
	/* VARIOUS AUTH END */

	public $paginate = [
	'limit' => 10,
	'order' => [
	'libelle' => 'asc'
			]
			];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
			if($_GET['globalsearch']){
			$s=$_GET['globalsearch'];

		$conditions = array('OR' => array(
			array('Ingredients.libelle LIKE' => '%'.$s.'%')
		));
//		print_r($conditions); exit;
		$query=$this->Ingredients->find('all', array('conditions' => $conditions));
		//debug($query); exit;
		$this->set('ingredients', $this->paginate($query));
	/*
	 * ###################### //specific search #################
	 *
	 * */
		} else {
        $this->set('ingredients', $this->paginate($this->Ingredients));
        $this->set('_serialize', ['ingredients']);
			}
    }

    /**
     * View method
     *
     * @param string|null $id Ingredient id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ingredient = $this->Ingredients->get($id, [
            'contain' => []
        ]);
        $this->set('ingredient', $ingredient);
        $this->set('_serialize', ['ingredient']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ingredient = $this->Ingredients->newEntity();
        if ($this->request->is('post')) {
            $ingredient = $this->Ingredients->patchEntity($ingredient, $this->request->data);
            if ($this->Ingredients->save($ingredient)) {
                $this->Flash->success(__('The ingredient has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ingredient could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ingredient'));
        $this->set('_serialize', ['ingredient']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ingredient id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ingredient = $this->Ingredients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ingredient = $this->Ingredients->patchEntity($ingredient, $this->request->data);
            if ($this->Ingredients->save($ingredient)) {
                $this->Flash->success(__('The ingredient has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ingredient could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ingredient'));
        $this->set('_serialize', ['ingredient']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ingredient id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ingredient = $this->Ingredients->get($id);
        if ($this->Ingredients->delete($ingredient)) {
            $this->Flash->success(__('The ingredient has been deleted.'));
        } else {
            $this->Flash->error(__('The ingredient could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
