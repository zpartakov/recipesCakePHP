<?php	
//affiche modes de cuisson pour la recherche
use Cake\ORM\TableRegistry;
$query = TableRegistry::get('ModeCuissons')->find();
$query->order(['lib' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";
foreach ($query as $article) {
    //debug($article->lib);
    
    $regimes.= "<option value=\"".$article->id."\">".$article->lib."</option>";
    $nbrec2++;
}
	echo "<select onchange=\"cacheautresingredients()\" name=\"mode_cuisson_id\" size=\"" .$nbrec2."\" style=\"width: 200px; height: ".($nbrec2*15) ."pt; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";	
?>	
