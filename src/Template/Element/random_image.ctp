<?php	
$test=0;
	//affiche des images aléatoires
	use Cake\ORM\TableRegistry;
	$query = TableRegistry::get('Recettes')->find();
	use Cake\Filesystem\Folder;
	//use Cake\Filesystem\File; //not mandatory
	$dir = new Folder(WWW_ROOT . 'img/pics');

while($test==0){

	if($this->Session->read('Auth.User')['role']!="administrator"){
		$query->where(['private' => 0]); // Return the same query object	
	}
	$query->where(['Recettes.pict NOT LIKE' => '']);
	$query->order('rand()');
	$query->firstOrFail();


		foreach ($query as $recette) {
			//any image of the recipe?
			$files = $dir->find($recette->pict, true);
			$nimg=count($files);
			if($nimg==1) {
				$test=1;
				echo $this->Html->image('pics/'.$recette->pict, [
				'style'=>'width: 30%;', 
				'alt' => $recette->titre ."(".$recette->prov.")",
				'title' => $recette->titre ."(".$recette->prov.")",
				'url' => ['controller' => 'Recettes', 'action' => 'view', $recette->id]]);
				echo $this->Html->link($recette->titre, ['controller'=>'recettes', 'action' => 'view', $recette->id]);

			}
		}
}
?>	
