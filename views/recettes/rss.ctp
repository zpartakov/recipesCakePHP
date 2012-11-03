<?php
/*
 * Fred's radeff recipes RSS
 */

/* 
 * authentication, if yes show private recipes
 */
  		$user=$_GET['user'];
       $mdp=$_GET['password'];
       if($user&&$mdp) {
		$test=0;
       	$salt=Configure::read('Security.salt');
		$mdp = sha1($salt.$mdp);
       	$sql="SELECT * FROM users WHERE username LIKE '" .$user ."'";
       	$sql=mysql_query($sql);
       	
       	if(mysql_num_rows($sql)==1) {
       		if(mysql_result($sql,0,'password')==$mdp) {
			$test=1;
       		}
       	}
       }
       
/*
 * construct sql
 */       
		if($test==1) { 
		$sql="SELECT * FROM recettes ORDER BY date DESC limit 50";
		} else {
		$sql="SELECT * FROM recettes WHERE private=0 ORDER BY date DESC limit 50";
		}
		//echo "<br>sql:" .$sql ."<br>";
$sql=mysql_query($sql);

function sortieRSS($id, $titre, $date, $provenance)
	{
	 echo "
	   <item>
	    <title>" .$titre ." (" .$provenance .")</title>
	    <link>http://www.akademia.ch/recettes2/view/" .$id ."</link>
	    <pubDate>" .$date."</pubDate>
	    </item>
	 ";
	}

/*
 * 
 * <?xml version="1.0" encoding="utf-8"?>
 * 
 */
	header ("Content-Type:text/xml");  
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; 
	echo '<?xml-stylesheet title="XSL formatting" type="text/xsl" href="http://www.akademia.ch/recettes2/recettes/rss" ?><rss version="2.0"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:wfw="http://wellformedweb.org/CommentAPI/"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:atom="http://www.w3.org/2005/Atom">';
?>
  <channel>
  <title>Recettes de cuisine akademia.ch</title>
  <link>http://www.akademia.ch/recettes2/</link>
  <atom:link href="http://www.akademia.ch/recettes2/recettes/rss" rel="self" type="application/rss+xml"/>
  <description>Les recettes de cuisine de Fred Radeff sur akademia.ch</description>
  <language>fr</language>
  <pubDate><? echo date("d-m-Y H:i:s");?></pubDate>
<?php 
/* 
 * loop results
 * 
 * le_type_lib(mysql_result($sql,$i,'type_id'), 
	
 */
$i=0;
while ($i<mysql_num_rows($sql)) {
	sortieRSS(mysql_result($sql,$i,'id'), 
	mysql_result($sql,$i,'titre'), 
	mysql_result($sql,$i,'date'), 
	mysql_result($sql,$i,'prov')
	);
	$i++;
}
?>
</channel>
</rss>