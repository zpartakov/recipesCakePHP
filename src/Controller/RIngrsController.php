<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RIngrs Controller
 *
 * @property \App\Model\Table\RIngrsTable $RIngrs
 */
class RIngrsController extends AppController
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
        $rIngrs = $this->paginate($this->RIngrs);

        $this->set(compact('rIngrs'));
        $this->set('_serialize', ['rIngrs']);
    }

    /**
     * View method
     *
     * @param string|null $id R Ingr id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rIngr = $this->RIngrs->get($id, [
            'contain' => ['Recettes']
        ]);

        $this->set('rIngr', $rIngr);
        $this->set('_serialize', ['rIngr']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rIngr = $this->RIngrs->newEntity();
        if ($this->request->is('post')) {
            $rIngr = $this->RIngrs->patchEntity($rIngr, $this->request->data);
            if ($this->RIngrs->save($rIngr)) {
                $this->Flash->success(__('The r ingr has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The r ingr could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RIngrs->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rIngr', 'recettes'));
        $this->set('_serialize', ['rIngr']);
    }

    /**
     * Edit method
     *
     * @param string|null $id R Ingr id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	//begin horrible hack to get ingr from given recipe
    	if($_GET['rec_id']){
    		$rec_id=$_GET['rec_id'];
    		$query = $this->RIngrs->find('all')
    		->where(['recette_id' => $rec_id]);
			foreach ($query as $row) {
				$id=$row->id;
			}
			//die;    		
    	}
    	//end horrible hack to get ingr from given recipe
    	
        $rIngr = $this->RIngrs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rIngr = $this->RIngrs->patchEntity($rIngr, $this->request->data);
            if ($this->RIngrs->save($rIngr)) {
                return $this->redirect('/recettes/edit/'.$rec_id);
            } else {
                $this->Flash->error(__('The r ingr could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RIngrs->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rIngr', 'recettes'));
        $this->set('_serialize', ['rIngr']);
    }

    /**
     * Delete method
     *
     * @param string|null $id R Ingr id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
    	//begin horrible hack
    	if($_GET['rec_id']){
    		$rec_id=$_GET['rec_id'];
    		$query = $this->RIngrs->find('all')
    		->where(['recette_id' => $rec_id]);
    		foreach ($query as $row) {
    			$id=$row->id;
    		}
    		
    	}
    	//end horrible hack
    	   
        $rIngr = $this->RIngrs->get($id);
    	
    	if ($this->RIngrs->delete($rIngr)) {
            header('Location: http://radeff.red/recettes/r_preps/delete?rec_id='.$id);
        } else {
            $this->Flash->error(__('The r ingr could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
