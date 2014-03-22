<?php
if($session->read('Auth.User.role')) {
		echo "Bienvenue, " .$session->read('Auth.User.username');
	echo "<br>Ton groupe: " .$session->read('Auth.User.role')."<br>";
			echo "<br>Ton identifiant: " .$session->read('Auth.User.id')."<br>";
}

$sql="
		SELECT * FROM recettes,recette_user,users 
		 WHERE  
			recettes.id=recette_user.recette_id 
		 AND users.id=recette_user.user_id
		 AND users.id=" .$session->read('Auth.User.id') ." 
		 ORDER BY type_id,titre asc";

echo "<pre>$sql</pre>";
		$sql=mysql_query($sql);
		/*
		 * not owner, sorry out!
		 */
	if(mysql_num_rows($sql)<1) {
		//echo 		mysql_num_rows($sql);
		echo "<br>Pas encore de recette(s)"; 
	} else {
		echo "<br>Tu as entré: #" .mysql_num_rows($sql) ." recettes.";
	}
	$i=0;
	
	echo "<hr/>";
$i=0;
while($i<mysql_num_rows($sql)){
	echo "<a href=\"/recettes2/recettes/view/" .mysql_result($sql, $i,'recettes.id') ."\">";
	echo mysql_result($sql, $i,'recettes.titre');
	echo "</a>";
	echo "<br>";
	$i++;
	
}
	
	?>