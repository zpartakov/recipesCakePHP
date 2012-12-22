<?php
/*
 * functions out of php core
 * 
 * */

function titre_recette($id) {
	$sql="SELECT titre FROM recettes WHERE id=".$id;
	$sql=mysql_query($sql);
	echo mysql_result($sql,0,'titre');
}

/*
 * fonction to find children linked recipes
 * */

function recettes_liees($id,$idnot) {
	$sql="
	SELECT * FROM recettes AS r, linked_recettes AS lr 
	WHERE (lr.recette_id=".$id ." AND r.id=lr.recettes_id)";
	if($idnot) {
	$sql.=" AND r.id NOT LIKE " .$idnot ." ";		
	}
	$sql.=" 
	GROUP BY r.titre
	ORDER BY r.titre";
	
	//echo $sql;
	$sql=mysql_query($sql);
	$i=0;
	while($i<mysql_num_rows($sql)) {
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,$i,'r.id')."\">".mysql_result($sql,$i,'r.titre')."</a></li>";
	$i++;
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

function lignes_vides($txt) {
	/*
	 * une fonction pour supprimer les espaces blancs à l'affichage,
	 * et mettre un saut de ligne HTML à la place des retours chariots restants
	 */
	$txt=preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $txt);
	/*
	 * si majuscule, ajouter un saut de ligne avant
	 */
	$txt=preg_replace("/\n([A-Z])/", "\n\n$1", $txt);
	
	$txt=stripslashes(stripslashes(nl2br($txt)));
	return $txt;
}



?>
