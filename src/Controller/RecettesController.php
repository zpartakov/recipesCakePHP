<?php
namespace App\Controller;
use App\Controller\AppController;

/**
 * Recettes Controller
 *
 */

class RecettesController extends AppController
{

	public $paginate = [
	'contain' => ['Types', 'ModeCuissons', 'Diets'],
	'limit' => 100,
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
				array('Recettes.ingr LIKE' => '%'.$s.'%'),
				array('Recettes.prov LIKE' => '%'.$s.'%')
			));
			$query=$this->Recettes->find('all', array('conditions' => $conditions));
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
					$sous_conditions[] =array('Recettes.prep LIKE' => '%'.$_GET['prep'].'%');
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
					$sous_conditions[] =array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%');
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
					$sous_conditions[] =array('Recettes.prep LIKE' => '%<!--kids-->%');
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



		} elseif ($_GET['ingrNot']) { //recherches booléennes portant sur plusieurs ingrédients;on laisse tomber les sous-conditions pour les
			if ($_GET['ingrNot']) { //recherche ingrédient2
				//selection: empty = AND or NOT idem selection1
				if ($_GET['selection']=='NOT') {
					$conditions = array('AND' => array(
					array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%'),
					array('Recettes.ingr NOT LIKE' => '%'.$_GET['ingrNot'].'%')));

				} else {
					$conditions = array('AND' => array(
					array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%'),
					array('Recettes.ingr LIKE' => '%'.$_GET['ingrNot'].'%')));
				}
				$query=$this->Recettes->find('all', array('conditions' => $conditions));
				$this->set('recettes', $this->paginate($query));
			}
			if ($_GET['ingrNot1']) { //recherche ingrédient3
				//selection: empty = AND or NOT idem selection1
				if ($_GET['selection1']=='NOT') {
					if ($_GET['selection']=='NOT') {
						$conditions = array('AND' => array(
						array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('Recettes.ingr NOT LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('Recettes.ingr NOT LIKE' => '%'.$_GET['ingrNot1'].'%')));
					} else {
						$sous_conditions[] =array('Recettes. LIKE' => '%'.$_GET[''].'%');
						$conditions = array('AND' => array(
						array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('Recettes.ingr LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('Recettes.ingr NOT LIKE' => '%'.$_GET['ingrNot1'].'%')));
					}
				} else {
					if ($_GET['selection']=='NOT') {
						$sous_conditions[] =array('Recettes. LIKE' => '%'.$_GET[''].'%');
						$conditions = array('AND' => array(
						array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('Recettes.ingr NOT LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('Recettes.ingr LIKE' => '%'.$_GET['ingrNot1'].'%')));
					} else {
						$sous_conditions[] =array('Recettes. LIKE' => '%'.$_GET[''].'%');
						$conditions = array('AND' => array(
						array('Recettes.ingr LIKE' => '%'.$_GET['ingr'].'%'),
						array('Recettes.ingr LIKE' => '%'.$_GET['ingrNot'].'%'),
						array('Recettes.ingr LIKE' => '%'.$_GET['ingrNot1'].'%')));
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
           'contain' => ['Types', 'ModeCuissons', 'Diets']
        ]);
        $this->set('recette', $recette);
        $this->set('_serialize', ['recette']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recette = $this->Recettes->newEntity();
/*
 * 		//a function to search if the title is unique or not; if not, warns and give a link to the recipe matching
		$recettes = $this->Recettes
			->find()
			->where(['Recettes.titre LIKE' => '%'.$_GET['titre'].'%']);
					$this->set(compact('recettes'));

 * */


        if ($this->request->is('post')) {
            $recette = $this->Recettes->patchEntity($recette, $this->request->data);
                        //print_r($recette); exit;


            if ($this->Recettes->save($recette)) {
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

		//country
		$pays = $this->Recettes->find()->group('prov')->extract('prov');
        $types = $this->Recettes->Types->find('list', ['limit' => 200]);
        $modeCuissons = $this->Recettes->ModeCuissons->find('list', ['limit' => 200])->order('lib');
        $diets = $this->Recettes->Diets->find('list', ['limit' => 200])->order('lib');
        $tags = $this->Recettes->Tags->find('list', ['limit' => 200]);
        $this->set(compact('recette', 'types', 'modeCuissons', 'diets', 'tags', 'pays', 'lastid', 'last_source'));
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
        $this->set('_serialize', ['recette']);
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


	/*
	 * BRONX
	 *
	 *
	if($this->Session->read('Auth.User')['role']=="admin"){
//	$this->set('recettes', $this->paginate());


			/*
			 *
			 * By default, CakePHP joins multiple conditions with boolean AND. This means the snippet below would only match posts that have been created in the past two weeks, and have a title that matches one in the given set. However, we could just as easily find posts that match either condition:

array("OR" => array(
    "Post.title" => array("First post", "Second post", "Third post"),
    "Post.created >" => date('Y-m-d', strtotime("-2 weeks"))
))

CakePHP accepts all valid SQL boolean operations, including AND, OR, NOT, XOR, etc., and they can be upper or lower case, whichever you prefer. These conditions are also infinitely nestable. Let’s say you had a belongsTo relationship between Posts and Authors. Let’s say you wanted to find all the posts that contained a certain keyword (“magic”) or were created in the past two weeks, but you wanted to restrict your search to posts written by Bob:

array(
    "Author.name" => "Bob",
    "OR" => array(
        "Post.title LIKE" => "%magic%",
        "Post.created >" => date('Y-m-d', strtotime("-2 weeks"))
    )
)

If you need to set multiple conditions on the same field, like when you want to do a LIKE search with multiple terms, you can do so by using conditions similar to:

array('OR' => array(
    array('Post.title LIKE' => '%one%'),
    array('Post.title LIKE' => '%two%')
))

			$conditions = array("OR" => array(
    "Recette.titre LIKE " => '%'.$s.'%'),
    "Recette.source LIKE " => '%'.$s.'%'));

			 *
			 * */
		/*
		 * fonctionne mais bien compliqué... vu qu'il faudrait calculer TOUTES LES COMBINAISONS = 11!
		 *
			$conditions = array('AND' => array(
			array('Recettes.titre LIKE' => '%'.$_GET['titre'].'%'),
			array('Recettes.prep LIKE' => '%'.$_GET['prep'].'%')));
						$query=$this->Recettes->find('all', array('conditions' => $conditions));
		//			debug($query);
							$this->set('recettes', $this->paginate($query));
							*
							*
							*
							*
							*
5.3.1. Adding Values to the End of an Array

To insert more values into the end of an existing indexed array, use the [] syntax:

    $family = array('Fred', 'Wilma');
    $family[] = 'Pebbles';                 // $family[2] is 'Pebbles'

This construct assumes the array's indexes are numbers and assigns elements into the next available numeric index, starting from 0. Attempting to append to an associative array is almost always a programmer mistake, but PHP will give the new elements numeric indexes without issuing a warning:

    $person = array('name' => 'Fred');
    $person[] = 'Wilma';                   // $person[0] is now 'Wilma'


			*/
