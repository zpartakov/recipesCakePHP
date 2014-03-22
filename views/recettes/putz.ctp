<?php 

$sqltl="SELECT * FROM  recettes ORDER BY id";
$result = mysql_query($sqltl);
testsql($result);
$i=0;
while($i<mysql_num_rows($result)) {
	
	$ingr=mysql_result($result,$i,'ingr');
	$prep=mysql_result($result,$i,'prep');

	$ingr1=str_replace("<p>&nbsp;</p>","",$ingr);
	
	if($ingr1!=$ingr){
		$ingr1=addslashes($ingr1);
//echo $ingr1 ."<br>";
		$sql="UPDATE recettes SET ingr='".$ingr1 ."' WHERE id=".mysql_result($result,$i,'id');
		//echo $sql ."<br>";
		//$sql=mysql_query($sql);
		testsql($sql);
	}

	$prep1=str_replace("<p>&nbsp;</p>","",$prep);
	if($prep1!=$prep){
		$prep1=addslashes($prep1);
		$sql="UPDATE recettes SET prep='".$prep1 ."' WHERE id=".mysql_result($result,$i,'id');
		//echo $sql ."<br>";
		//$sql=mysql_query($sql);
		testsql($sql);
	}



	$i++;
}
	?>