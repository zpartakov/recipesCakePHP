<?php
		$this->layout = '';
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
	$db = new mysqli('localhost', LOGINMYSQL , PASSWORDMYSQL, DBMYSQL);
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				#admin$admoin
				$admin="";
if($session->read('Auth.User.role')=="member"||$session->read('Auth.User.role')=="administrator") {
$s=1;
}
if($s==1) {
 } else {
#surfer
    $admin=" AND private=0";   
  }
/* projects*/
				$sql="
				SELECT titre AS value FROM recettes 
				WHERE 
				titre LIKE '$queryString%' " .$admin ." 
				LIMIT 30";
				
				$query = $db->query($sql);
				#echo $sql;
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
	         			echo '<li class="projet_autofill" onClick="fill(\''.utf8_encode($result->value).'\');">'
	         			.'<span style="background-color: orange; padding: 2px;">'.utf8_encode($result->value).'</span></li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query:<br>'.$sql;
				}
				
	
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
