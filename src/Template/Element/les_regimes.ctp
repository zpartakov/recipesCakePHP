<?php	
//affiche la liste des régimes pour la recherche
use Cake\ORM\TableRegistry;
$query = TableRegistry::get('Diets')->find();
$query->order(['lib' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";
foreach ($query as $article) {   
    $regimes.= "<option value=\"".$article->id."\">".$article->lib."</option>";
    $nbrec2++;
}
	echo "<select name=\"diet_id\" size=\"" .$nbrec2."\" style=\"height: ".($nbrec2*15) ."pt; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";	
?>	
