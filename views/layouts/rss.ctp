<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
<channel>
<title>Fred Radeff : Recettes de cuisine akademia.ch</title>
<link>http://recettes.akademia.ch/</link>
<description>
</description>
<atom:link href="http://radeff.net/recettes2/recettes/rss/" rel="self"></atom:link>
<language>fr</language>
<lastBuildDate><?php echo date("D, d M Y h:i:s")?></lastBuildDate>
<?php 
	foreach ($recettes as $recette):
	if($recette['Recette']['private']=="0"){
?>	
	<item>
	<title><?php 
	$titre=ucfirst($recette['Recette']['titre']);
	$titre=preg_replace("/<br>/","",$titre);
	$titre=preg_replace("/<!--.*-->/","",$titre);
	$titre=preg_replace("/<.*>/","",$titre);
	$titre=preg_replace("/<\/.*>/","",$titre);
	$titre=preg_replace("/.feedburner:origLink./","",$titre);
	
	
	
	echo $titre;
	
	?></title>
	<link>http://radeff.net/recettes2/recettes/view/<?php echo $recette['Recette']['id'];?></link>
	<guid isPermaLink="false">http://radeff.net/recettes2/recettes/view/<?php echo $recette['Recette']['id'];?></guid>
	<pubDate><?php echo date("D, d m Y h:i:s");?></pubDate>
	<pays><![CDATA[<?php  echo ucfirst($recette['Recette']['prov']);?>]]></pays>
	<ingredients><![CDATA[<?php  echo ucfirst($recette['Recette']['ingr']);?>]]></ingredients>
	<preparation><![CDATA[<?php  echo ucfirst($recette['Recette']['prep']);?>]]></preparation>
	</item>
<?php
	}
endforeach; 
?>
</channel></rss>