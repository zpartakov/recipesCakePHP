<?
$this->pageTitle = "Modes de cuisson"; 
?>
<style>
h2 {
	margin-left: 10px;
}
h3 {
	margin-left: 30px;
}
</style>
<?
echo "<h1 style=\"font-style: bigger\">" .$this->pageTitle ."</h1>";
$sql="SELECT * FROM mode_cuissons WHERE parent=0";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
		$i=0;
		while($i<mysql_num_rows($sql)){
			$id1=mysql_result($sql,$i,'id');
			echo "<h1>" .mysql_result($sql,$i,'lib') ."</h1>";
			$sql2="SELECT * FROM mode_cuissons WHERE parent=".$id1;
				#do and check sql
				$sql2=mysql_query($sql2);
				if(!$sql2) {
					echo "SQL error: " .mysql_error(); exit;
				}
				$i2=0;
				while($i2<mysql_num_rows($sql2)){
					$id2=mysql_result($sql2,$i2,'id');
					echo "<h2>" .mysql_result($sql2,$i2,'lib') ."</h2>";
					$sql3="SELECT * FROM mode_cuissons WHERE parent=".$id2;
					#echo $sql3;
						#do and check sql
						$sql3=mysql_query($sql3);
						if(!$sql3) {
							echo "SQL error: " .mysql_error(); exit;
						}
						$i3=0;
						while($i3<mysql_num_rows($sql3)){
							$id3=mysql_result($sql3,$i,'id');
							echo "<h3><a href=\"modecuisson?id=" .$id3 ."\">" .mysql_result($sql3,$i3,'lib') ."</a></h3>";
							$i3++;
						}

					$i2++;
				}
	$i++;
	}

?>
