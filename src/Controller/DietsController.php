<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Diets Controller
 *
 * @property \App\Model\Table\DietsTable $Diets
 */
class DietsController extends AppController
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
		$this->loadComponent('Auth');

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
        $this->set('diets', $this->paginate($this->Diets));
        $this->set('_serialize', ['diets']);
    }

    /**
     * View method
     *
     * @param string|null $id Diet id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diet = $this->Diets->get($id, [
            'contain' => ['Recettes', 'Recettes00']
        ]);
        $this->set('diet', $diet);
        $this->set('_serialize', ['diet']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diet = $this->Diets->newEntity();
        if ($this->request->is('post')) {
            $diet = $this->Diets->patchEntity($diet, $this->request->data);
            if ($this->Diets->save($diet)) {
                $this->Flash->success(__('The diet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diet could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('diet'));
        $this->set('_serialize', ['diet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Diet id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diet = $this->Diets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diet = $this->Diets->patchEntity($diet, $this->request->data);
            if ($this->Diets->save($diet)) {
                $this->Flash->success(__('The diet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diet could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('diet'));
        $this->set('_serialize', ['diet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Diet id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diet = $this->Diets->get($id);
        if ($this->Diets->delete($diet)) {
            $this->Flash->success(__('The diet has been deleted.'));
        } else {
            $this->Flash->error(__('The diet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
