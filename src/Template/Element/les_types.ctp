<?php	
//affiche les types pour la recherche
use Cake\ORM\TableRegistry;

$query = TableRegistry::get('Types')->find();
//$query->order(['lib' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";
foreach ($query as $article) {
    $regimes.= "<option value=\"".$article->id."\">".$article->name."</option>";
    $nbrec2++;
}

	echo "<select name=\"type_id\" size=\"" .$nbrec2."\" style=\"height: ".($nbrec2*16) ."pt; width: 200px;\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";	
?>	
