<?php
//affiche la liste des régimes pour la recherche
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

$query = TableRegistry::get('Diets')->find();
$query->order(['lib' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";
foreach ($query as $article) {
    //debug($article->lib);

    $regimes.= "<option value=\"".$article->id."\">".$article->lib."</option>";
    $nbrec2++;
}
$nbrec2 = Configure::read('selNbre');

echo "<select name=\"diet_id\" size=\"" .$nbrec2."\" style=\"height: ".($nbrec2*1) ."pt; display: block\"><option value='' selected>-- all --</option>";
//echo "<select name=\"diet_id\" size=\"" .$nbrec2."\" style=\"height: ".($nbrec2*15) ."pt; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";
?>
