<?
$sql="SELECT * FROM recettes WHERE prov LIKE ''";
#echo $sql;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}

$i=0;
while($i<mysql_num_rows($sql)){
	echo "<br>" .mysql_result($sql,$i,'titre');
	$i++;
	}
?>
