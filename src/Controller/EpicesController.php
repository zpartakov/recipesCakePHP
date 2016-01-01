<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Epices Controller
 *
 * @property \App\Model\Table\EpicesTable $Epices
 */
class EpicesController extends AppController
{
		public $paginate = [
	'limit' => 25,
	'order' => [
	'Epices.lib' => 'asc'
			]
			];
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
		$this->loadComponent('RequestHandler'); //radeff added rss2


		// Allow the display action so our pages controller
		// continues to work.
		$this->Auth->allow(['index', 'display','view']);
	}
		public function beforeFilter(\Cake\Event\Event $event)
	{
				//$this->Auth->allow('index','view');
	}
/* VARIOUS AUTH END */
    /**
     * Index method
     *
     * @return void
     */
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
				array('Epices.lib LIKE' => '%'.$s.'%'),
				array('Epices.url LIKE' => '%'.$s.'%'),
				array('Epices.origine LIKE' => '%'.$s.'%'),
				array('Epices.def LIKE' => '%'.$s.'%'),
				array('Epices.util LIKE' => '%'.$s.'%')
			));
			$query=$this->Epices->find('all', array('conditions' => $conditions));
			$this->set('epices', $this->paginate($query));
		/*
		 * ###################### //specific search #################
		 *
		 * */
			} else {
        $this->set('epices', $this->paginate($this->Epices));
        $this->set('_serialize', ['epices']);
	}
    }

    /**
     * View method
     *
     * @param string|null $id Epice id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $epice = $this->Epices->get($id, [
            'contain' => []
        ]);
        $this->set('epice', $epice);
        $this->set('_serialize', ['epice']);
		//find recipes containing this ingredient
        $data = $epice->toArray();
        $lib=$data['lib'];
//exceptions
if(preg_match("/amchoor/",$lib)) {
	$lib="mangue";
} elseif (preg_match("/^ase fétide/",$lib)) {
	$lib="ase fétide";
} elseif (preg_match("/^baie de Genièvre/",$lib)) {
	$lib="genièvre";
}elseif (preg_match("/^Ache des montagnes/",$lib)) {
 $lib="livèche";
}elseif (preg_match("/^Achillée millefeuille/",$lib)) {
 $lib="Achillée";
}

//


        $conditions = array('AND' => array(
				array('Recettes.ingr LIKE' => '%'.$lib .'%'),
				array('Recettes.private' => '0')
			));
		$this->loadModel('Recettes');
		$recettes=$this->Recettes->find('all', array('conditions' => $conditions, 'order'=>'Recettes.titre'));
		$this->set('recettes', $recettes);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $epice = $this->Epices->newEntity();
        if ($this->request->is('post')) {
            $epice = $this->Epices->patchEntity($epice, $this->request->data);
            if ($this->Epices->save($epice)) {
                $this->Flash->success(__('The epice has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The epice could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('epice'));
        $this->set('_serialize', ['epice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Epice id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $epice = $this->Epices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $epice = $this->Epices->patchEntity($epice, $this->request->data);





            if ($this->Epices->save($epice)) {
                $this->Flash->success(__('The epice has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The epice could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('epice'));
        $this->set('_serialize', ['epice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Epice id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $epice = $this->Epices->get($id);
        if ($this->Epices->delete($epice)) {
            $this->Flash->success(__('The epice has been deleted.'));
        } else {
            $this->Flash->error(__('The epice could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
