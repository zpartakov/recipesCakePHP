<?php	
//affiche les types pour la recherche
use Cake\ORM\TableRegistry;

$query = TableRegistry::get('Countries')->find();
//$query->order(['prov' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";

foreach ($query as $article) {
    $regimes.= "<option value=\"".$article->name."\">".$article->name."</option>";
    $nbrec2++;
}

	echo "<select name=\"prov\" size=\"" .$nbrec2."\" style=\"width: 200px; height: ".($nbrec2*1) ."pt; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";	
?>	
