Corrige pays
<?php 
$sql="SELECT * FROM recettes ORDER BY id";
$sql=mysql_query($sql);
$i=0;
while($i<mysql_num_rows($sql)){
	$pays=mysql_result($sql,$i,'prov');
	echo $pays;
	$pays="SELECT id FROM countries WHERE name LIKE '" .$pays ."'";
	$pays=mysql_query($pays);
	$pays=mysql_result($pays,0,'id');
	echo " = id: " .$pays;
	
	echo "<br>";
	$i++;
}
?>