<?php
//affiche les types pour la recherche
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

$query = TableRegistry::get('Countries')->find();
//$query->order(['prov' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";

foreach ($query as $article) {
    $regimes.= "<option value=\"".$article->name."\">".$article->name."</option>";
    $nbrec2++;
}
$nbrec2 = Configure::read('selNbre');
echo "<select name=\"prov\" size=\"" .$nbrec2."\" style=\"width: 200px; height: ".($nbrec2*1) ."pt; display: block\"><option value='' selected>-- all --</option>";
//echo "<select name=\"prov\" size=\"" .$nbrec2."\" style=\"width: 200px; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";
?>
