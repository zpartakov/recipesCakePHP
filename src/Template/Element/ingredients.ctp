<?php
//affiche les ingrédients pour la recherche
use Cake\Core\Configure;

use Cake\ORM\TableRegistry;

$query = TableRegistry::get('Ingredients')->find();
$query->order(['libelle' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";

foreach ($query as $article) {
    $regimes.= "<option value=\"".$article->id."\">".$article->libelle."</option>";
    $nbrec2++;
}

$nbrec2 = Configure::read('selNbre');
	echo "<select name=\"ingredient_id\" size=\"" .$nbrec2 ."\" style=\"width: 200px; height: ".($nbrec2*1) ."pt; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";
?>
