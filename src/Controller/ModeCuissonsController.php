<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ModeCuissons Controller
 *
 * @property \App\Model\Table\ModeCuissonsTable $ModeCuissons
 */
class ModeCuissonsController extends AppController
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
        $this->set('modeCuissons', $this->paginate($this->ModeCuissons));
        $this->set('_serialize', ['modeCuissons']);
    }

    /**
     * View method
     *
     * @param string|null $id Mode Cuisson id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modeCuisson = $this->ModeCuissons->get($id, [
            'contain' => ['Recettes', 'Recettes00']
        ]);
        $this->set('modeCuisson', $modeCuisson);
        $this->set('_serialize', ['modeCuisson']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modeCuisson = $this->ModeCuissons->newEntity();
        if ($this->request->is('post')) {
            $modeCuisson = $this->ModeCuissons->patchEntity($modeCuisson, $this->request->data);
            if ($this->ModeCuissons->save($modeCuisson)) {
                $this->Flash->success(__('The mode cuisson has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mode cuisson could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('modeCuisson'));
        $this->set('_serialize', ['modeCuisson']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mode Cuisson id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modeCuisson = $this->ModeCuissons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modeCuisson = $this->ModeCuissons->patchEntity($modeCuisson, $this->request->data);
            if ($this->ModeCuissons->save($modeCuisson)) {
                $this->Flash->success(__('The mode cuisson has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mode cuisson could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('modeCuisson'));
        $this->set('_serialize', ['modeCuisson']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mode Cuisson id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modeCuisson = $this->ModeCuissons->get($id);
        if ($this->ModeCuissons->delete($modeCuisson)) {
            $this->Flash->success(__('The mode cuisson has been deleted.'));
        } else {
            $this->Flash->error(__('The mode cuisson could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
