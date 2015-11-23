<?php	
//affiche les types pour la recherche
use Cake\ORM\TableRegistry;
/*
 * $sql="SELECT COUNT(id),prov FROM recettes " .$admin ." GROUP BY prov";
#echo $sql;
$result = mysql_query($sql);
testsql($result);
$nbrec=mysql_num_rows($result);
$nbrec2=$nbrec+1;
$nbrec2=24;
#echo $nbrec;
echo "<h2>Provenance</h2>";
echo "<select name= size=" .$nbrec2 ."><option value='' selected>-- all --";
$i=0;
while($i<$nbrec) {
$prov=mysql_result($result,$i,'prov');
if ($prov=="") {
$prov=" *** sans *** ";
}
$hit=mysql_result($result,$i,'count(id)');
echo "<option value=\"$prov\">" .$prov ." # " .$hit ."\n";
$i++;
}
echo "</select>";
}
 * */
$query = TableRegistry::get('Recettes')->find()->group('prov');
//$query->order(['prov' => 'ASC']); // Still same object, no SQL executed
$nbrec2=1; $regimes="";

foreach ($query as $article) {
    $regimes.= "<option value=\"".$article->prov."\">".$article->prov."</option>";
    $nbrec2++;
}

	echo "<select name=\"prov\" size=\"" .$nbrec2."\" style=\"width: 200px; height: ".($nbrec2*1) ."pt; display: block\"><option value='' selected>-- all --</option>";
	echo $regimes;
	echo "</select>";	
?>	
