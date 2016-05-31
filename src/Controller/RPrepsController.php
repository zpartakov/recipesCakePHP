<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RPreps Controller
 *
 * @property \App\Model\Table\RPrepsTable $RPreps
 */
class RPrepsController extends AppController
{

	public function isAuthorized($user) {
    }

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('RequestHandler'); //radeff added rss2
		$this->loadComponent('Auth');
		$this->Auth->allow(['display','view', 'rss', 'index', 'suggestions']);//radeff added rss6
	}

	public function beforeFilter(\Cake\Event\Event $event)
	{
		$this->Auth->allow('index','view');
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Recettes']
        ];
        $rPreps = $this->paginate($this->RPreps);

        $this->set(compact('rPreps'));
        $this->set('_serialize', ['rPreps']);
    }

    /**
     * View method
     *
     * @param string|null $id R Prep id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rPrep = $this->RPreps->get($id, [
            'contain' => ['Recettes']
        ]);

        $this->set('rPrep', $rPrep);
        $this->set('_serialize', ['rPrep']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rPrep = $this->RPreps->newEntity();
        if ($this->request->is('post')) {
            $rPrep = $this->RPreps->patchEntity($rPrep, $this->request->data);
            if ($this->RPreps->save($rPrep)) {
                $this->Flash->success(__('The r prep has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The r prep could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RPreps->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rPrep', 'recettes'));
        $this->set('_serialize', ['rPrep']);
    }

    /**
     * Edit method
     *
     * @param string|null $id R Prep id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	//begin horrible hack to get ingr from given recipe
    	if($_GET['rec_id']){
    		$rec_id=$_GET['rec_id'];
    		$query = $this->RPreps->find('all')
    		->where(['recette_id' => $rec_id]);
    		foreach ($query as $row) {
    			$id=$row->id;
    		}
    	}
    	//end horrible hack to get ingr from given recipe
    	
        $rPrep = $this->RPreps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rPrep = $this->RPreps->patchEntity($rPrep, $this->request->data);
            if ($this->RPreps->save($rPrep)) {
                return $this->redirect('/recettes/edit/'.$rec_id);
            } else {
                $this->Flash->error(__('The r prep could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RPreps->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rPrep', 'recettes'));
        $this->set('_serialize', ['rPrep']);
    }

    /**
     * Delete method
     *
     * @param string|null $id R Prep id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
    	//begin horrible hack
    	if($_GET['rec_id']){
    		$rec_id=$_GET['rec_id'];
    		$query = $this->RPreps->find('all')
    		->where(['recette_id' => $rec_id]);
    		foreach ($query as $row) {
    			$id=$row->id;
    		}
    	}
    	//endhorrible hack
    	
    	$rPrep = $this->RPreps->get($id);
        if ($this->RPreps->delete($rPrep)) {
            $this->Flash->success(__('The recipe has been deleted.'));
        } else {
            $this->Flash->error(__('The r prep could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
