<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VinsTypes Controller
 *
 * @property \App\Model\Table\VinsTypesTable $VinsTypes
 */
class VinsTypesController extends AppController
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
        $this->set('vinsTypes', $this->paginate($this->VinsTypes));
        $this->set('_serialize', ['vinsTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Vins Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vinsType = $this->VinsTypes->get($id, [
            'contain' => []
        ]);
        $this->set('vinsType', $vinsType);
        $this->set('_serialize', ['vinsType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vinsType = $this->VinsTypes->newEntity();
        if ($this->request->is('post')) {
            $vinsType = $this->VinsTypes->patchEntity($vinsType, $this->request->data);
            if ($this->VinsTypes->save($vinsType)) {
                $this->Flash->success(__('The vins type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vins type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vinsType'));
        $this->set('_serialize', ['vinsType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vins Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vinsType = $this->VinsTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vinsType = $this->VinsTypes->patchEntity($vinsType, $this->request->data);
            if ($this->VinsTypes->save($vinsType)) {
                $this->Flash->success(__('The vins type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vins type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vinsType'));
        $this->set('_serialize', ['vinsType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vins Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vinsType = $this->VinsTypes->get($id);
        if ($this->VinsTypes->delete($vinsType)) {
            $this->Flash->success(__('The vins type has been deleted.'));
        } else {
            $this->Flash->error(__('The vins type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
