<?php 

/*
 * a ajax function to search if the title is unique or not; if not, warns and give a link to the recipe matching
 * 
 * */

$titre=$_GET['titre'];
$sql="SELECT * FROM recettes WHERE titre LIKE '".$titre."'";
$sql=mysql_query($sql);

/*
 * there is already a recipe with the same title, printa warning
 */

if(mysql_num_rows($sql)==1){
	echo "<div style=\"background-color: lightyellow; padding: 5px\">";
	echo "Attention: le titre <a href=\"./view/" .mysql_result($sql,0,'id') ."\">"
 	.$titre ."</a> existe!";
	echo "<br>Source: " .mysql_result($sql,0,'source');
	echo "</div>";
}
?>