<?
$id=$_GET['id'];
#echo $id;

/*SELECT * FROM recette_mode_cuisson, recettes WHERE 
recettes.id = recette_mode_cuisson.recette_id 
AND recette_mode_cuisson.mode_cuisson_id=14
* 
* 
* mode_cuissons.id=".$id ." AND 
recette_mode_cuisson.mode_cuisson_id=".$id ." AND 
recettes.id = recette_mode_cuisson.recette_id
* */

$sql="
SELECT * FROM mode_cuissons, recette_mode_cuisson, recettes 
WHERE 
recettes.id = recette_mode_cuisson.recette_id 
AND recette_mode_cuisson.mode_cuisson_id=".$id ." 
AND mode_cuissons.id=recette_mode_cuisson.mode_cuisson_id
";
#echo $sql;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}

$i=0;
echo "<h1>Mode de cuisson: " .mysql_result($sql,0,'mode_cuissons.lib')."</h1><ul>";
while($i<mysql_num_rows($sql)){
		/*$infobulle= " (" .mysql_result($($sql,$i,'prov') .") <strong>" .mysql_result($($sql,$i,'date')
			 ."</strong><br>" .substr(mysql_result($($sql,$i,'prep'),0,50) ."...";*/

/*	echo "<li><a href=\"../recettes/view/" .mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,$i,'titre') ."<em><span></span>" .$infobulle ."</em></a>"."</li>";	*/
	echo "<li><a href=\"../recettes/view/" .mysql_result($sql,$i,'recettes.id') ."\">" .mysql_result($sql,$i,'titre') ."</a></li>";

	$i++;
	}
echo "</ul>";
?>
