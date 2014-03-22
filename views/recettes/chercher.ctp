<?php
App::import('Lib', 'functions'); //imports app/libs/functions

#cake title of the page
$this->pageTitle = 'Chercher'; 
#get passed vars
$id=$_GET['id'];
$titre=$_GET['titre'];
$titre=preg_replace("/'/","%",$titre);
$prep=$_GET['prep'];
$temps=$_GET['temps'];
$pers=$_GET['pers'];
$type_id=$_GET['typ'];
$ingr=$_GET['ingr'];
$ingrNot=$_GET['ingrNot'];
$ingrNot1=$_GET['ingrNot1'];
$source=$_GET['source'];
$prov=addslashes($_GET['prov']);
$rech_globale=addslashes($_GET['chercher']);
$image=$_GET['image'];
$kids=$_GET['kids'];
$new=$_GET['new'];
$fulltext=$_GET['fulltext'];
$selection=$_GET['selection'];
$mode_cuisson=$_GET['mode_cuisson'];
if (!is_numeric($mode_cuisson)) {
$mode_cuisson="%%";
}
$regime=$_GET['diet_id'];
//echo $mode_cuisson; exit;
#conditions based on vars
if($kids==1) {
$prep=$prep."%<!--kids-->%";
}
if (isset($id)) {
  $selectid=$id;
}

#admin
if($session->read('Auth.User.role')=="member"||$session->read('Auth.User.role')=="administrator") {
$s=1;
}
if($s==1) {
 } else {
#surfer
    $admin=" AND private=0";   
  }

$today=date("Y-m-d");
if(!isset($email)) {
if($type_id=="") {
$type_id="%";
}
/*todo
#mots vides
//include("stopwords.inc.php");
# extraction orthographes fantaisistes, synonymes, autres langues
//include("orthographe.inc.php");
*/
#trim vars
$titre=addslashes(trim($titre));
$prep=addslashes(trim($prep));
$temps=addslashes(trim($temps));
$ingr=addslashes(trim($ingr));
$pers=addslashes(trim($pers));
$type_id=addslashes(trim($type_id));
$ingr=addslashes(trim($ingr));
$ingrNot=addslashes(trim($ingrNot));
$ingrNot1=addslashes(trim($ingrNot1));
$source=addslashes(trim($source));

#RECHERCHE GLOBALE

if($rech_globale<>"") {
	$rech_globale=trim($rech_globale);
	$rech_globale=preg_replace("/ /", "%", $rech_globale);
#admin
  if($s==1) {
$sql="SELECT * FROM recettes WHERE prov like '%$rech_globale%' OR titre like '%$rech_globale%' OR prep like '%$rech_globale%' OR ingr like '%$rech_globale%' ORDER BY type_id,titre asc";
  } else {
#surfer
$sql="SELECT * FROM recettes WHERE (prov like '%$rech_globale%' OR titre like '%$rech_globale%' OR prep like '%$rech_globale%' OR ingr like '%$rech_globale%') AND private=0 ORDER BY type_id,titre asc";
  }
 if($image==1){
#admin
  if($s==1) {
$sql="SELECT * FROM recettes WHERE prov like '%$rech_globale%' OR titre like '%$rech_globale%' OR prep like '%$rech_globale%' OR temps like '%$rech_globale%' OR ingr like '%$rech_globale%' OR pers like '%$rech_globale%' OR type_id like '$rech_globale' ORDER BY type_id,titre asc";
  } else {
#surfer
$sql="select * from recettes where (prov like '%$rech_globale%' OR titre like '%$rech_globale%' OR prep like '%$rech_globale%' OR ingr like '%$rech_globale%') AND private=0 AND pict NOT LIKE '' order by type_id,titre asc";
  }
 }
# echo "<!-- SQL: $sql -->";
} else {
#RECHERCHE SPECIALISEE
if($ingrNot||$ingrNot1||$titre) {
########################
#TODO: ajout synonmyes, eg. calamar -> calamars, pluriels etc.
#MISE EN FORME DU MOTIF DE RECHERCHE
#CREATION D'UN VECTEUR
#titre
  if($titre) {
$motif=explode(' ', $titre);
 $titreBoole="";
$i=0;
 while($i<count($motif)) {
   $lemot=$motif[$i];
#is there a synonym, a wrong spell or another languague	(eg. psicologie -> psychologie; psychology -> psychologie)
   if(eregi($lemot, $orthographesTxt)) {
     $orthographes="SELECT orthographe FROM recettes_orthographe WHERE (aurtograf LIKE '%$lemot%' OR orthographe LIKE '%$lemot%') ";
     $orthographes=mysql_query($orthographes);
     $lemot=mysql_result($orthographes,0,'orthographe');
   }
	#is the word not a stopword?
   if(!eregi("$lemot",$stopwordsTxt)) {
      #on ajoute le AND
      $titreBoole.="+".$lemot ."* ";
    }
$i++;
}
 $titreBoole=eregi_replace(" $","",$titreBoole);
 $titreBoole="AND MATCH (titre) AGAINST ('$titreBoole' IN BOOLEAN MODE)";
   }
#echo $titreBoole;
#exit;

#ingredient texte libre: $ingrNot
  if($ingrNot) {
$motif=explode(' ', $ingrNot);
 $ingrNot="";
$i=0;
while($i<count($motif)) {
$lemot=$motif[$i];
	#is there a synonym, a wrong spell or another languague	(eg. psicologie -> psychologie; psychology -> psychologie)
if(eregi($lemot, $orthographesTxt)) {
$orthographes="SELECT orthographe FROM recettes_orthographe WHERE (aurtograf LIKE '%$lemot%' OR orthographe LIKE '%$lemot%') ";
$orthographes=mysql_query($orthographes);
$lemot=mysql_result($orthographes,0,'orthographe');
}
	#is the word not a stopword?
	if(!eregi("$lemot",$stopwordsTxt)) {
	#on ajoute le AND
	$ingrNot.="+".$lemot ."* ";
        }
$i++;
}
$ingrNot=eregi_replace(" $","",$ingrNot);
$ingrNot="AND $selection MATCH (ingr) AGAINST ('$ingrNot' IN BOOLEAN MODE)";
  }
#fin orthographes
}

#recherche simple initiale
#admin
  if($s==1) {
$sql="
SELECT * "
. "FROM recettes "
. "WHERE prov LIKE '%$prov%' 
AND titre LIKE '%$titre%' 
AND prep LIKE '%$prep%' 
AND temps LIKE '%$temps%' 
AND ingr LIKE '%$ingr%' 
AND pers LIKE '%$pers%' 
AND type_id LIKE '$type_id' 
AND ingr LIKE '%$ingr%' 
AND ingr ". $selection. " LIKE '%$ingrNot%' 
AND ingr ". $selection1. " LIKE '%$ingrNot1%' "
. " AND source LIKE '%$source%' 
AND diet_id = " .$regime ." 
AND mode_cuisson_id LIKE '$mode_cuisson' 
ORDER BY type_id,titre ASC
";
  } else {
#surfer
$sql="
SELECT * "
. "FROM recettes "
. "WHERE prov LIKE '%$prov%' 
AND titre LIKE '%$titre%' 
AND prep LIKE '%$prep%' 
AND temps LIKE '%$temps%' 
AND ingr LIKE '%$ingr%' 
AND pers LIKE '%$pers%' 
AND type_id LIKE '$type_id' 
AND ingr LIKE '%$ingr%' 
AND ingr ". $selection. " LIKE '%$ingrNot%' 
AND ingr ". $selection1. " LIKE '%$ingrNot1%' "
. " AND source LIKE '%$source%' 
AND diet_id = " .$regime ." 
  AND private=0 
  AND mode_cuisson_id LIKE '$mode_cuisson' 
  ORDER BY type_id,titre ASC";
  }

#menus
  if($menus=="on"){
    $delimiter=";";
    $array = explode($delimiter, $menu);

    #returns the number of elements in the array
    $size=count($array);

    for ($i=0; $i <= $size; $i++) {
      if($array[$i]!=''){
    $sqlmenu.=$array[$i] ." OR id=";
      }}
    $sqlmenu=preg_replace("/ OR id=$/","",$sqlmenu);
$sql="SELECT * FROM recettes WHERE id=$sqlmenu ORDER BY type_id,titre asc";
  }
 //echo $sql;
  @$result = mysql_query($sql);
@$nbRec = mysql_num_rows($result);
# echo $nbRec;
# exit;
#si rien on lance le booléen
if ($nbRec==0) {
#admin
  if($s==1) {
$sql = "
SELECT * 
FROM `recettes`
WHERE 
prov LIKE '%$prov%' 
$titreBoole
AND prep LIKE '%$prep%' 
AND temps LIKE '%$temps%' 
AND ingr LIKE '%$ingr%' 
AND pers LIKE '%$pers%' 
AND type_id LIKE '$type_id' 
AND ingr LIKE '%$ingr%' 
$ingrNot
AND ingr $selection1 LIKE '%$ingrNot1%' 
AND source LIKE '%$source%' 
AND mode_cuisson_id LIKE '$mode_cuisson' 

ORDER BY type_id,titre asc
";
  } else {
#surfer
$sql = "
SELECT * 
FROM `recettes`
WHERE 
prov LIKE '%$prov%' 
$titreBoole
AND prep LIKE '%$prep%' 
AND temps LIKE '%$temps%' 
AND ingr LIKE '%$ingr%' 
AND pers LIKE '%$pers%' 
AND type_id LIKE '$type_id' 
AND ingr LIKE '%$ingr%' 
$ingrNot
AND ingr $selection1 LIKE '%$ingrNot1%' 
AND source LIKE '%$source%' 
AND private=0 
AND mode_cuisson_id LIKE '$mode_cuisson' 

ORDER BY type_id,titre asc
";
  }
}

# echo "<pre>Pas de résultat correspondant pour votre requête, essai avec du booléen</pre>";
#recettes avec image
 if($image=="1"){
#admin
  if($s==1) {
   $sql="select * "
     . "from recettes "
     . "where prov like '%$prov%' and titre like '%$titre%' and prep like '%$prep%' and temps like '%$temps%' and ingr like '%$ingr%' and pers like '%$pers%' and type_id like '$type_id' and ingr like '%$ingr%' AND ingr "
     . $selection
     . " like '%$ingrNot%' AND ingr "
     . $selection1
     . " like '%$ingrNot1%' "
     . " AND source LIKE '%$source%' AND pict NOT LIKE '' 
   AND mode_cuisson_id LIKE '$mode_cuisson' 
     
   order by type_id,titre asc";
 } else {
#surfer
   $sql="select * "
     . "from recettes "
     . "where prov like '%$prov%' and titre like '%$titre%' and prep like '%$prep%' and temps like '%$temps%' and ingr like '%$ingr%' and pers like '%$pers%' and type_id like '$type_id' and ingr like '%$ingr%' AND ingr "
     . $selection
     . " like '%$ingrNot%' AND ingr "
     . $selection1
     . " like '%$ingrNot1%' "
     . " AND private=0 AND source LIKE '%$source%' AND pict NOT LIKE '' 
    AND mode_cuisson_id LIKE '$mode_cuisson' 
     
 	order by type_id,titre asc";

  }
 }		    
}
} else {
#admin
  if($s==1) {
$sql="select * "
. "from recettes "
. "where prep like '%Source: club - $email%' "

. "order by type_id,titre asc";
  } else {
#surfer
$sql="select * "
. "from recettes "
. "where prep like '%Source: club - $email%'    AND mode_cuisson_id LIKE '$mode_cuisson' 
"
. "AND private=0 order by type_id,titre asc";
  }
if($image=1){
#admin
  if($s==1) {
$sql="select * "
. "from recettes "
. "where prep like '%Source: club - $email%'  AND pict NOT LIKE ''   AND mode_cuisson_id LIKE '$mode_cuisson' 
"
. "order by type_id,titre asc";
 } else {
#surfer
$sql="select * "
. "from recettes "
. "where prep like '%Source: club - $email%'  AND pict NOT LIKE ''   AND mode_cuisson_id LIKE '$mode_cuisson' 
"
. "AND private=0 order by type_id,titre asc";
  }
 }
}
if($prov==" *** sans *** ") {
#admin
$sql="select * "
. "from recettes "
. "where prov LIKE '' "
. $admin   

. "   AND mode_cuisson_id LIKE '$mode_cuisson' 
order by type_id,titre asc";
}

###### NEW RECIPES #######
if($new==1) { //search nouveautes
#admin
  if($s==1) {
$sql="SELECT * FROM recettes ORDER BY id DESC LIMIT 0,100";
  } else {
#surfer
$sql="SELECT * FROM recettes WHERE private=0 ORDER BY id DESC LIMIT 0,100";
  }
}

######################## END SQL CONSTRUCTION ##############
$sql=preg_replace("/\%\%\%\%/", "%", $sql);
//Configure::write('debug', 2);
if($kids==1) {
//	echo "kids"; exit;
	//&&preg_match("/prep LIKE \'\%\%\'/", $sql)
$sql=str_replace("prep LIKE '%%'", "prep LIKE '%<!--kids-->%'", $sql);
}

/*
 * TESTS
 */

//echo "<pre>$sql</pre>"; exit; //tests£


$result = mysql_query($sql);
if ($selectid) {
$result = mysql_query("select * from recettes where id=$selectid $admin"); 
}



$nbRec = mysql_num_rows($result);
#echo $nbRec;
#TOO MUCH RESULTS STOP
$resultattot = mysql_query("select * from recettes WHERE date <= '$today' $admin"); 
$nbrec=mysql_num_rows($resultattot);
if ($nbRec>=$nbrec) {
echo "<h2>Merci de choisir au moins un critère de recherche</h2><h1><a href=./>Retour</a></h1>";
 exit;
 }

########################
#NO RESULT SEND FEEDBACK
if ($nbRec==0) {

#on lance l'usine à gaz levenshtein()
#a faire: 
#-generer liste de mots
#-crontab pour générer la liste des mots
//include("mysql_extract_voc.php");

echo "<h2>Désolé, pas de résultats!</h2><h1><a href=\"".CHEMIN."\">Retour</a></h1>";

/*
########################
#ecrit dans la db
$ingr.= " - " .$ingrNot ." - " .$ingrNot1;
if(isset($rech_globale)){
$ingr="GLOBALE: $rech_globale";
}
$date=date("Y-m-d H:m:s");
$sql="
insert into recet_not_found (id, titre, type_id, prov, ingr, prep, date, source, pict, REMOTE_ADDR) 
VALUES 
('', '$titre', '$type_id', '$prov', '$ingr', '$prep', '$date', '$source', '$image','$REMOTE_ADDR')
";

########################
#echo $sql ."<br>";
$result = mysql_query ("$sql");
if(!$result){
echo "Failed to write feedback";
}
*/
########################
#$doit=mail("fradeff@akademia.ch", "recette pas trouvée", "$sql", "From:recettes@akademia.ch");
} else if($fulltext=="1") { //fulltext
//	echo "<style>tr {margin-bottom: 20px;}</style>";
			/*
			 * show whole recipes eg ebooks conv
			 */
	echo "  Nombre de recettes: $nbRec";
	
			echo "<h1>Fulltext</h1>";

		/* now display full recipes
		 * 
		 */
		$i=0;
			echo '<h2>Recettes</h2>';
			while ($i < mysql_num_rows($result)) {
			#loop sur les recettes
			$j=$i+1;
				if(intval($j/2)==$j/2) {
				$style="background-color: white;";
				} else {
				$style="background-color: #F4E7CF;";
				}
			 $type_id=mysql_result($result,$i,'type_id');
				if($i>0) {
				$i1=$i-1;
				$typP=mysql_result($result,$i1,'type_id');
						if("$type_id"=="$typP") {
				$afficheType=0;
						} else {
						$afficheType=1;		  		
						}
				}
				if($i==0||$afficheType==1) {
					
		if($new!=1) { //don't print category if nouveautés
					echo "<h1>";
					le_type_lib($type_id);
					echo "</h1>";
		}
		 		}
				$id=mysql_result($result,$i,'id');
?>		  

			<h2><?php echo mysql_result($result,$i,'titre'); ?></h2>
		<p>
			<?php ___('Provenance'); ?>
		</p>

		<p>
			<?php echo mysql_result($result,$i,'prov'); ?>
		</p>

		<p>
			<?php ___('Ingrédients'); ?>
		</p>

		<p>
			<?php echo "<em>" .stripslashes(stripslashes(nl2br(mysql_result($result,$i,'ingr')))) ."</em>"; ?>
		</p>
		<p>
			<?php ___('Préparation'); ?>
		</p>

		<p>
			<?php echo stripslashes(stripslashes(nl2br(mysql_result($result,$i,'prep')))); ?>
		</p>
	<?


	  

		  $i++;
		}
		
		
		echo "<br/><br/><br/><br/><hr/>";
		
}else { 
/*
 * print screen list of recipes
 * 
 */
echo "  Nombre de recettes: $nbRec";
?>

<!--  ###### BEGIN DISPLAY LIST ####### -->
<p align="center">
<!--<form action=selectsearch.php method=get>
<input type=submit value='Sélectionner les recettes retenues'></p>-->
<table cellpadding=5>
<? 
$i = 0;
########################
#titres + liens ancres internes
 echo "<table border=0><tr><td>";
while ($i < mysql_num_rows($result)) {
	#loop sur les recettes
	$j=$i+1;
		if(intval($j/2)==$j/2) {
		$style="background-color: white;";
		} else {
		$style="background-color: #F4E7CF;";
		}
	 $type_id=mysql_result($result,$i,'type_id');
		if($i>0) {
		$i1=$i-1;
		$typP=mysql_result($result,$i1,'type_id');
				if("$type_id"=="$typP") {
		$afficheType=0;
				} else {
				$afficheType=1;		  		
				}
		}
		if($i==0||$afficheType==1) {
			
			echo  "</td></tr>\n\n";
if($new!=1) { //don't print category if nouveautés
			echo "<tr><td colspan=2><h3>";
			le_type_lib($type_id);
			echo "</h3></td></tr>";
}
			
			echo "<tr><td>";   
			
 		}
		$id=mysql_result($result,$i,'id');
		
		$infobulle= " (" .mysql_result($result,$i,'prov') .") <strong>" .mysql_result($result,$i,'date')

             ."</strong>";
          //   ."</strong><br>" .substr(mysql_result($result,$i,'prep'),0,50) ."...";

#disting private-public with css
if(mysql_result($result,$i,'private')=="1") {
	$private="private";
} else {
	$private="public";
}

$bgcolor=note(mysql_result($result,$i,'time'));
$zestyle="background-color: " .$bgcolor;
  echo "<li class=\"" .$private ."\" style=\"" .$zestyle."\">";
  
  
  
  echo "<a href=\"view/" .$id."\" class=\"tooltip\" style=\"".$style."\">"
   .ucfirst(mysql_result($result,$i,'titre')) ." <span style=\"font-style: italic; font-size: smaller\">(";
  
  le_type_lib(mysql_result($result,$i,'type_id'));
  
  echo ")</span><em><span></span>" .$infobulle ."</em></a></li>";
  

  
  if(strlen(mysql_result($result,$i,'pict')>0)) {

	  
  }
  $i++;
}


echo "</td></tr></table>";



########################
#recettes

#echo "<p align='center'><input type=submit value='Sélectionner les recettes retenues'></p></form>";
echo '<br><script language="JavaScript" src="bak2top.js"></script>';
}
//include("footer.inc.php");

?>
<p>&nbsp;</p>
