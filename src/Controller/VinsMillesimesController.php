<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VinsMillesimes Controller
 *
 * @property \App\Model\Table\VinsMillesimesTable $VinsMillesimes
 */
class VinsMillesimesController extends AppController
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
        $this->paginate = [
            'contain' => ['VinTypes']
        ];
        $this->set('vinsMillesimes', $this->paginate($this->VinsMillesimes));
        $this->set('_serialize', ['vinsMillesimes']);
    }

    /**
     * View method
     *
     * @param string|null $id Vins Millesime id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vinsMillesime = $this->VinsMillesimes->get($id, [
            'contain' => ['VinTypes']
        ]);
        $this->set('vinsMillesime', $vinsMillesime);
        $this->set('_serialize', ['vinsMillesime']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vinsMillesime = $this->VinsMillesimes->newEntity();
        if ($this->request->is('post')) {
            $vinsMillesime = $this->VinsMillesimes->patchEntity($vinsMillesime, $this->request->data);
            if ($this->VinsMillesimes->save($vinsMillesime)) {
                $this->Flash->success(__('The vins millesime has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vins millesime could not be saved. Please, try again.'));
            }
        }
        $vinTypes = $this->VinsMillesimes->VinTypes->find('list', ['limit' => 200]);
        $this->set(compact('vinsMillesime', 'vinTypes'));
        $this->set('_serialize', ['vinsMillesime']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vins Millesime id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vinsMillesime = $this->VinsMillesimes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vinsMillesime = $this->VinsMillesimes->patchEntity($vinsMillesime, $this->request->data);
            if ($this->VinsMillesimes->save($vinsMillesime)) {
                $this->Flash->success(__('The vins millesime has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vins millesime could not be saved. Please, try again.'));
            }
        }
        $vinTypes = $this->VinsMillesimes->VinTypes->find('list', ['limit' => 200]);
        $this->set(compact('vinsMillesime', 'vinTypes'));
        $this->set('_serialize', ['vinsMillesime']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vins Millesime id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vinsMillesime = $this->VinsMillesimes->get($id);
        if ($this->VinsMillesimes->delete($vinsMillesime)) {
            $this->Flash->success(__('The vins millesime has been deleted.'));
        } else {
            $this->Flash->error(__('The vins millesime could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
