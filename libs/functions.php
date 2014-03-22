<?php
/*
 * functions out of php core
 * 
 * */
function note($note){
	//echo $note;
	$prioritecolor=array("white","#FFD5D5","#FAB1B1","#F87676","#CDF3CD","#A5F9A5","#71F871");
		$bgcolor= $prioritecolor[$note];
		return ($bgcolor); 
		//print_r($prioritecolor);
	}
function titre_recette($id) {
	$sql="SELECT titre FROM recettes WHERE id=".$id;
	$sql=mysql_query($sql);
	echo mysql_result($sql,0,'titre');
}

/*
 * display n randomized recipes
 */
function random_recipes($nb,$role) {
	
	$offset_result = mysql_query( "
			SELECT FLOOR(RAND() * COUNT(*)) AS `offset` FROM `recettes` ");
	
	
	$offset_row = mysql_fetch_object( $offset_result );
	$offset = $offset_row->offset;
	
	//echo "role: " .$role;
	
	if($role=="") {
		$condition =" WHERE private=0 ";
	} else {
		$condition ="";
		
	}
	
	$sql=" SELECT * FROM `recettes` " .$condition ."LIMIT $offset, ".$nb;
	//echo $sql; exit;
	$resultran = mysql_query($sql);
	
	
	$i=0;
	if(mysql_num_rows($resultran)<$nb) {
		random_recipes($nb);
	}
	echo "<table>";
	while($i<mysql_num_rows($resultran)) {
		recette_link(mysql_result($resultran, $i, 'id'));
		$i++;
	}
	echo "</table>";

}
/*
 * for a given recipe, make a table with a link on view recipe
 */
function recette_link($id){
	$query="SELECT * FROM recettes WHERE id=".$id;
	$result=mysql_query($query);
	$titre_recette=mysql_result($result, 0, 'titre');
	echo "<tr>";
	echo "<td>";
	echo "<a href=\"/recettes2/recettes/view/" .mysql_result($result, 0, 'id') ."\">";
	echo $titre_recette;
	echo "</a>";
    echo " <span style=\"text-style: italic; font-size: smaller\">(" 
    .mysql_result($result,0,'prov').")</span>";

	echo "</td><td>";
	echo "<a href=\"/recettes2/recettes/view/" .mysql_result($result, 0, 'id') ."\">";
    if(strlen(mysql_result($result,0,'pict')>0)){
    	echo "<img style=\"width: 100px\" class=\"rounded\" src=\"/recettes2/img/pics/";
    	echo mysql_result($result,0,'pict');
    	echo "\"/>";
    }
	echo "</a>";
    
	echo "</td>";
	echo "</tr>";
}
/*
 * fonction to find children linked recipes
 * */

function recettes_liees($id) {
	$sql="
	SELECT * FROM recettes AS r, linked_recettes AS lr 
	WHERE (lr.recette_id=".$id ." AND r.id=lr.recettes_id) 
	GROUP BY r.titre
	ORDER BY r.titre";
	
	//echo $sql;
	$sql=mysql_query($sql);
	if(mysql_num_rows($sql)>0) {
	echo "<h2>Recettes liées</h2>";	
	$i=0;
	while($i<mysql_num_rows($sql)) {
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,$i,'r.id')."\">".mysql_result($sql,$i,'r.titre')."</a></li>";
	$i++;
	}	
	}
}

function recettes_parentes($id) {
$sql="
SELECT * FROM recettes AS r WHERE id = (SELECT lr.recette_id FROM linked_recettes AS lr
WHERE (lr.recettes_id=".$id ."))
GROUP BY r.titre
ORDER BY r.titre";
$sql=mysql_query($sql);
	if(mysql_num_rows($sql)>0) {
		echo "<h2>Recette parente</h2>";
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,0,'r.id')."\">".mysql_result($sql,$i,'r.titre')."</a></li>";
	}
}
/*
 * reverse fonction to find parents linked recipes
 * */
function recettes_liees2($id) {
	$sql="
	SELECT * FROM linked_recettes AS lr,  recettes AS r
	WHERE lr.recettes_id=".$id ." AND r.id=lr.recettes_id";
	$sql=mysql_query($sql);
	if(mysql_result($sql,0,'r.id')!=$id) {
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,0,'r.id')."\">".mysql_result($sql,0,'r.titre')."</a></li>";
	}
recettes_liees(mysql_result($sql,0,'lr.recette_id'),$id);

}

/* ############# HTML ############## */
/* function to extract urls from variables */
function urlize($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = preg_replace("/(https:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	$chaine=preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	//now replace emails
	if(!preg_match("/[a-zA-Z0-9]*\.[a-zA-Z0-9]*@/",$chaine)){
	#$chaine = ereg_replace('[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_/-])*','<a href="mailto:\\0">\\0</a>',$chaine);
	#$chaine = preg_replace('/[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);
	}else {
	$chaine = preg_replace('/[-a-zA-Z0-9]*\.?[-a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);	
	}

	echo nl2br($chaine);
}
function melto($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = "<a href=\"mailto:" .$chaine ."\">".$chaine ."</a>";
	echo $chaine;
}

function generate_password($length){
     // A List of vowels and vowel sounds that we can insert in
     // the password string
     $vowels = array("a",  "e",  "i",  "o",  "u",  "ae",  "ou",  "io",  
                     "ea",  "ou",  "ia",  "ai"); 
     // A List of Consonants and Consonant sounds that we can insert
     // into the password string
     $consonants = array("b",  "c",  "d",  "g",  "h",  "j",  "k",  "l",  "m",
                         "n",  "p",  "r",  "s",  "t",  "u",  "v",  "w",  
                         "tr",  "cr",  "fr",  "dr",  "wr",  "pr",  "th",
                         "ch",  "ph",  "st",  "sl",  "cl");
     // For the call to rand(), saves a call to the count() function
     // on each iteration of the for loop
     $vowel_count = count($vowels);
     $consonant_count = count($consonants);
     // From $i .. $length, fill the string with alternating consonant
     // vowel pairs.
     for ($i = 0; $i < $length; ++$i) {
         $pass .= $consonants[rand(0,  $consonant_count - 1)] .
                  $vowels[rand(0,  $vowel_count - 1)];
     }
     
     // Since some of our consonants and vowels are more than one
     // character, our string can be longer than $length, use substr()
     // to truncate the string
     return substr($pass,  0,  $length);
 
}

function lignes_vides($txt,$id) {
	/*
	 * une fonction pour supprimer les espaces blancs à l'affichage,
	 * et mettre un saut de ligne HTML à la place des retours chariots restants
	 */
	$txt=preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $txt);
	/*
	 * si majuscule, ajouter un saut de ligne avant
	 */
	$txt=preg_replace("/\n([A-Z])/", "\n\n$1", $txt);
/*
 * put a new line only for "old" recipes before wysiwig editor
 */	
	if($id<12343) {
		$txt=nl2br($txt);
	}
	$txt=stripslashes(stripslashes($txt));
	
	return $txt;
}



?>
