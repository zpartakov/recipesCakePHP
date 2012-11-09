<?php
$this->pageTitle = 'Nouvelles recettes'; 

#admin
	if($session->read('Auth.User.role')=="member") {
$s=1;
}
  if($s==1) {
 } else {
#surfer
    $admin=" AND private=0";   
  }
#echo $admin;
#exit;
$today=date("Y-m-d");

  if($s==1) {
$sql="select * "
. "from recettes ORDER BY date DESC LIMIT 0,25";
  } else {
#surfer
$sql=$sql.$admin;
 }
$result = mysql_query($sql);
$nbRec = mysql_num_rows($result);
 echo "<table border=0><tr><td>";
while ($i < mysql_num_rows($result)) {
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
			/*$type_id=ereg_replace("^[0-9].[0-9]?", "", $type_id);
			$type_id=ereg_replace("_", " ", $type_id);
			$type_id=ucfirst($type_id);*/
			
			#£
			echo  "</td></tr>\n\n<tr><td colspan=2><span style=\"background-color: tomato; padding-left: 3px; padding-right: 3px\">";
			#echo $type_id;
			le_type_lib($type_id);
			echo "</span></td></tr><tr><td>";   
 		}
		$id=mysql_result($result,$i,'id');
  echo "<li class=\"liste\"><a href=\"view/" .$id."\" style=\"".$style."\">" .$j ." " .ucfirst(mysql_result($result,$i,'titre')) ."</a> <span style=\"font-size: x-small\">(" .mysql_result($result,$i,'prov') .")</span>";
  if(strlen(mysql_result($result,$i,'pict')>0)) {

	  
  }
  $i++;
}
echo "</td></tr></table>";
########################
#recettes

#echo "<p align='center'><input type=submit value='Sélectionner les recettes retenues'></p></form>";
echo '<br><script language="JavaScript" src="bak2top.js"></script>';
include("footer.inc.php");

?>
<p>&nbsp;</p>
