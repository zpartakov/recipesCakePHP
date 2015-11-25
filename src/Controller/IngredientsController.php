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
        //auth check
        //return boolean
    }
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Auth', [
				'authorize'=> 'Controller',//added this line
				'authenticate' => [
				'Form' => [
				'fields' => [
				'username' => 'email',
				'password' => 'password'
				]
				]
				],
				'loginAction' => [
				'controller' => 'Users',
				'action' => 'login'
				],
				'unauthorizedRedirect' => $this->referer()
				]);
	
		// Allow the display action so our pages controller
		// continues to work.
		$this->Auth->allow(['display','view']);
	}
		public function beforeFilter(\Cake\Event\Event $event)
	{
				$this->Auth->allow('index','view');
	}
/* VARIOUS AUTH END */	

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('ingredients', $this->paginate($this->Ingredients));
        $this->set('_serialize', ['ingredients']);
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
