<?php
namespace App\Controller;
use App\Controller\AppController;

use Cake\Datasource\ConnectionManager; //hack quick n dirty

/**
 * Recettes Controller
 *
 */

class RecettesController extends AppController
{

	public $paginate = [
	'contain' => ['Types', 'ModeCuissons', 'Diets'],
	'limit' => 10,
	'order' => [
	'Recettes.id' => 'desc'
			]
			];


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
		$this->Auth->allow('index','chercher','view','total_recettes','pays','les_types','nouveau','rss','regime','les_regimes', 'suggestions');
	}


	public function rss() //radeff added rss3
    {
		$this->layout = 'rss/default';
		if(!$this->Auth->user('id')) { //unlogged users
			$recettes = $this->Recettes
						->find()
						->where(['Recettes.private' => '0'])
						->limit(20)
						->order(['id' => 'desc']);
					$this->set(compact('recettes'));
		} else { //logged users, display private recipes
			$recettes = $this->Recettes
						->find()
						->limit(20)
						->order(['id' => 'desc']);
					$this->set(compact('recettes'));
		}
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

		$boole=0;
		/*
		 * ###################### //global search #################
		 *
		 * */
		if($_GET['globalsearch']){
				$s=$_GET['globalsearch'];

			$conditions = array('OR' => array(
				array('Recettes.titre LIKE' => '%'.$s.'%'),
				array('Recettes.source LIKE' => '%'.$s.'%'),
				array('Recettes.prov LIKE' => '%'.$s.'%')
			));
				
			$query=$this->Recettes->find('all', array('conditions' => $conditions));
			$this->set('nbrec', $query->count());
				
			//debug($query); die;
			$this->set('recettes', $this->paginate($query));
		/*
		 * ###################### //specific search #################
		 *
		 * */
			}elseif($_GET['source']||$_GET['titre']||$_GET['prep']||$_GET['temps']||$_GET['type_id']||$_GET['ingr']||$_GET['prov']||$_GET['mode_cuisson_id']||$_GET['kids']||$_GET['diet_id']){ //recherche source (recettes Fred Radeff & famille)

				$sous_conditions=array();

				if($_GET['source']){ //recherche source (recettes Fred Radeff & famille)
				$sous_conditions[] =array('Recettes.source LIKE' => '%'.$_GET['source'].'%');
				//$query = $this->Recettes->find()->where(['source LIKE' => '%'.$_GET['source'].'%']);
				//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['titre']){ //recherche titre
				$sous_conditions[] =array('Recettes.titre LIKE' => '%'.$_GET['titre'].'%');
				//$query = $this->Recettes->find()->where(['titre LIKE' => '%'.$_GET['titre'].'%']);
				//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['prep']){ //recherche préparation
					$sous_conditions[] =array('RPreps.prep LIKE' => '%'.$_GET['prep'].'%');
					//$query = $this->Recettes->find()->where(['prep LIKE' => '%'.$_GET['prep'].'%']);
					//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['temps']){ //recherche temps
					$sous_conditions[] =array('Recettes.temps LIKE' => '%'.$_GET['temps'].'%');
					//$query = $this->Recettes->find()->where(['temps LIKE' => '%'.$_GET['temps'].'%']);
					//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['type_id']){ //recherche type_id
					$sous_conditions[] =array('Recettes.type_id LIKE' => $_GET['type_id']);
					//$query = $this->Recettes->find()->where(['type_id =' => $_GET['type_id']]);
					//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['ingr']){ //recherche ingrédient
					$sous_conditions[] =array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%');
					//$query = $this->Recettes->find()->where(['ingr LIKE' => '%'.$_GET['ingr'].'%']);
					//$this->set('recettes', $this->paginate($query));
				}

				if($_GET['prov']){ //recherche provenance
					$sous_conditions[] =array('Recettes.prov LIKE' => '%'.$_GET['prov'].'%');
					//$query = $this->Recettes->find()->where(['prov LIKE' => '%'.$_GET['prov'].'%']);
					//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['mode_cuisson_id']){ //recherche mode de cuisson
					$sous_conditions[] =array('Recettes.mode_cuisson_id =' => $_GET['mode_cuisson_id']);
					//$query = $this->Recettes->find()->where(['mode_cuisson_id =' => $_GET['mode_cuisson_id']]);
					//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['kids']){ //recherche recettes enfants
					$sous_conditions[] =array('RPreps.prep LIKE' => '%<!--kids-->%');
					//$query = $this->Recettes->find()->where(['prep LIKE' => '%<!--kids-->%']);
					//$this->set('recettes', $this->paginate($query));
				}
				if($_GET['diet_id']){ //recherche régimes
					$sous_conditions[] =array('Recettes.diet_id =' => $_GET['diet_id']);
					//$query = $this->Recettes->find()->where(['diet_id =' => $_GET['diet_id']]);
					//$this->set('recettes', $this->paginate($query));
				}
		/*
		 * ###################### //no search, display new recipes #################
		 *
		 * */

		 //print_r($sous_conditions); exit;
			$conditions = array('AND' => array($sous_conditions));
			$query=$this->Recettes->find('all', array('conditions' => $conditions));
				//			debug($query);
				$this->set('recettes', $this->paginate($query));
				$this->set('nbrec', $query->count());



		} elseif ($_GET['ingrNot']) { //recherches booléennes portant sur plusieurs ingrédients;on laisse tomber les sous-conditions pour les
			if ($_GET['ingrNot']) { //recherche ingrédient2
				//selection: empty = AND or NOT idem selection1
				if ($_GET['selection']=='NOT') {
					$conditions = array('AND' => array(
					array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%'),
					array('RIngrs.ingr NOT LIKE' => '%'.$_GET['ingrNot'].'%')));

				} else {
					$conditions = array('AND' => array(
					array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%'),
					array('RIngrs.ingr LIKE' => '%'.$_GET['ingrNot'].'%')));
				}
				$query=$this->Recettes->find('all', array('conditions' => $conditions));
				$this->set('recettes', $this->paginate($query));
			}
			if ($_GET['ingrNot1']) { //recherche ingrédient3
				//selection: empty = AND or NOT idem selection1
				if ($_GET['selection1']=='NOT') {
					if ($_GET['selection']=='NOT') {
						$conditions = array('AND' => array(
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('RIngrs.ingr NOT LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('RIngrs.ingr NOT LIKE' => '%'.$_GET['ingrNot1'].'%')));
					} else {
						$sous_conditions[] =array('Recettes. LIKE' => '%'.$_GET[''].'%');
						$conditions = array('AND' => array(
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('RIngrs.ingr NOT LIKE' => '%'.$_GET['ingrNot1'].'%')));
					}
				} else {
					if ($_GET['selection']=='NOT') {
						$sous_conditions[] =array('Recettes. LIKE' => '%'.$_GET[''].'%');
						$conditions = array('AND' => array(
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('RIngrs.ingr NOT LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingrNot1'].'%')));
					} else {
						$sous_conditions[] =array('Recettes. LIKE' => '%'.$_GET[''].'%');
						$conditions = array('AND' => array(
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('RIngrs.ingr LIKE' => '%'.$_GET['ingrNot1'].'%')));
					}
				}
				$query=$this->Recettes->find('all', array('conditions' => $conditions));
				$this->set('recettes', $this->paginate($query));
			}
		} else {
			//is the user an admin? if yes OR if localhost, display hidden recipes
			if ($this->Auth->user('id')||$_SERVER["HTTP_HOST"]=="localhost") {
				$query = $this->Recettes->find();
				$this->set('recettes', $this->paginate($query));
			//no? display only public recipes
			} else {
				$query = $this->Recettes->find()->where(['private LIKE' => '0']);
				$this->set('recettes', $this->paginate($query));
			}
			//debug($query);
						$this->set('nbrec', $query->count());

		}
		$this->set('_serialize', ['recettes']);
	}

    /**
     * Index method
     *
     * @return void
     */
    public function book()
    {
		$this->layout = 'print';
		$query = $this->Recettes->find('all')
		->where(['Recettes.prov LIKE' => $_GET['prov']])
		->order(['Recettes.type_id' => 'ASC'])
		->order(['Recettes.titre' => 'ASC']);
		$this->set('recettes', $query);
		//extract types
		$types = $this->Recettes->Types->find('list')
		->order(['Types.id'=>'ASC']);
		$types = $types->toArray();
		$this->set('types', $types);
		//extract modes de cuisson
		$ModeCuissons = $this->Recettes->ModeCuissons->find('list')
		->order(['ModeCuissons.lib'=>'ASC']);
		$ModeCuissons = $ModeCuissons->toArray();
		$this->set('ModeCuissons', $ModeCuissons);
		//extract Diets
		$Diets = $this->Recettes->Diets->find('list')
		->order(['Diets.lib'=>'ASC']);
		$Diets = $Diets->toArray();
		$this->set('Diets', $Diets);

	}



    /**
     * View method
     *
     * @param string|null $id Recette id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
//            'contain' => ['Types', 'ModeCuissons', 'Diets', 'Tags', 'Comments', 'Menus', 'RecetteUser', 'Stats', 'UsersTags']

        $recette = $this->Recettes->get($id, [
           'contain' => ['Types', 'ModeCuissons', 'Diets', 'RIngrs', 'RPreps']
        ]);
        $this->set('recette', $recette);
        $this->set('_serialize', ['recette']);
		$this->set('ingrs', $this->RIngrs);
        $this->set('preps', $this->RPreps);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recette = $this->Recettes->newEntity();
        if ($this->request->is('post')) {
            $recette = $this->Recettes->patchEntity($recette, $this->request->data);

            if ($this->Recettes->save($recette)) {	
				
				//begin hack quick n dirty
					$ingr=$_POST['RIngrs']['ingr'];
					$prep=$_POST['RPreps']['prep'];
							$query = $this->Recettes->find('all', [
								'order' => ['Recettes.id' => 'DESC']
							])->extract('id');
							$lastid = $query->first();
							$connection = ConnectionManager::get('default');
							$connection->insert('r_ingrs', [
								'ingr' => $ingr,
								'recette_id' => $lastid
							]);
							$connection->insert('r_preps', [
								'prep' => $prep,
								'recette_id' => $lastid
							]);
				//end hack quick n dirty

                $this->Flash->success(__('The recette has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The recette could not be saved. Please, try again.'));
            }
        }

		//lastid
		$query = $this->Recettes->find('all', [
			'order' => ['Recettes.id' => 'DESC']
		])->extract('id');
		$lastid = $query->first();
				//last_source
		$query = $this->Recettes->find('all', [
			'order' => ['Recettes.id' => 'DESC']
		])->extract('source');
		$last_source = $query->first();

		//last_country
		$query = $this->Recettes->find('all', [
			'order' => ['Recettes.id' => 'DESC']
		])->extract('prov');
		$prov = $query->first();
		//country
		$pays = $this->Recettes->find()->group('prov')->extract('prov');
        $types = $this->Recettes->Types->find('list', ['limit' => 200]);
        $modeCuissons = $this->Recettes->ModeCuissons->find('list', ['limit' => 200])->order('lib');
        $diets = $this->Recettes->Diets->find('list', ['limit' => 200])->order('lib');
        $tags = $this->Recettes->Tags->find('list', ['limit' => 200]);
        $this->set(compact('recette', 'types', 'modeCuissons', 'diets', 'tags', 'pays', 'lastid', 'last_source','prov'));
        $this->set('_serialize', ['recette']);
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Recette id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recette = $this->Recettes->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $recette = $this->Recettes->patchEntity($recette, $this->request->data);
            if ($this->Recettes->save($recette)) {
                $this->Flash->success(__('The recette has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The recette could not be saved. Please, try again.'));
            }
        }
        
        $types = $this->Recettes->Types->find('list', ['limit' => 200]);
        $modeCuissons = $this->Recettes->ModeCuissons->find('list', ['limit' => 200]);
        $diets = $this->Recettes->Diets->find('list', ['limit' => 200]);
        $tags = $this->Recettes->Tags->find('list', ['limit' => 200]);
        $this->set(compact('recette', 'types', 'modeCuissons', 'diets', 'tags'));
        $this->set('_serialize', ['recette'], 'ingr');
    }

    /**
     * Delete method
     *
     * @param string|null $id Recette id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recette = $this->Recettes->get($id);

        //begin hack quick n dirty
        header('Location: http://radeff.red/recettes/r_ingrs/delete?rec_id='.$id);
        //end hack quick n dirty
        
        if ($this->Recettes->delete($recette)) {
            $this->Flash->success(__('The recette has been deleted.'));
        } else {
            $this->Flash->error(__('The recette could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function cherchetitre() {
		//a function to search if the title is unique or not; if not, warns and give a link to the recipe matching
		$recettes = $this->Recettes
			->find()
			->where(['Recettes.titre LIKE' => '%'.$_GET['titre'].'%']);
					$this->set(compact('recettes'));
	}

	public function suggestions(){ //suggestions de recettes
	}


}
