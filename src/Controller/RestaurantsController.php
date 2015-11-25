<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Restaurants Controller
 *
 * @property \App\Model\Table\RestaurantsTable $Restaurants
 */
class RestaurantsController extends AppController
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


	public $paginate = [
	'limit' => 10,
	'order' => [
	'id' => 'desc'
			]
			];
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('restaurants', $this->paginate($this->Restaurants));
        $this->set('_serialize', ['restaurants']);
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => []
        ]);
        $this->set('restaurant', $restaurant);
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $restaurant = $this->Restaurants->newEntity();
        if ($this->request->is('post')) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('restaurant'));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('restaurant'));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurant = $this->Restaurants->get($id);
        if ($this->Restaurants->delete($restaurant)) {
            $this->Flash->success(__('The restaurant has been deleted.'));
        } else {
            $this->Flash->error(__('The restaurant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}