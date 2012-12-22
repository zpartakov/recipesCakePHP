<?
//check browser, warning if IE
if(preg_match("/MSIE/",$_SERVER['HTTP_USER_AGENT'])&&preg_match("/8.0/",$_SERVER['HTTP_USER_AGENT'])){
	$messagebrowser="<div style=\"font-size: 12pt; background-color: #FF778F; padding: 10px; border: thin solid red; border-style: outset;\">Vous utilisez Internet Explorer 8 ou 9: ce logiciel propriétaire ne vous permet pas de consulter le site avec toutes ses fonctionnalités (notamment les menus déroulants que vous devriez voir à la place de ce texte, etc.). Nous vous recommandons d'utiliser Firefox, logiciel libre que vous pouvez télécharger sur <a href=\"http://www.mozilla-europe.org/fr/firefox/\" target=\"_blank\">http://www.mozilla-europe.org/fr/firefox/</a>. Il est disponible pour linux, mac et windows.</div>";

} else {
	$messagebrowser="";
}
?>

	<div id="cakephp-global-navigation">
<ul id="menuDeroulant">
	<!-- homepage -->
	<li>
		<a href="<? echo CHEMIN; ?>">Accueil</a>
		<ul class="sousMenu">
			<li><a href="http://www.akademia.ch/dokuwiki/doku.php?id=cuisine:aide_recettes" target="_blank">Aide / Wiki</a></li>
		<li><?php echo '<a class="contact" href="http://www.akademia.ch/dokuwiki/contact" title="Contact">'.$html->image('ico-contact.gif', array("alt"=>"Contact", "width"=>"20","height"=>"20")).'&nbsp;Contact</a>';?></li>
			<li><a href="<? echo CHEMIN; ?>liens/">Liens</a></li>		



			<li><a href="<? echo CHEMIN; ?>recettes/chercher?source=radeff" target="_blank">Mes Recettes</a></li>
			<li><a href="http://www.akademia.ch/biblio/result.php?type=cuisine" target="_blank">Livres de cuisine</a></li>
			<li><a href="<? echo CHEMIN; ?>mode_cuissons/">Modes de cuisson</a></li>
			<li><a href="<? echo CHEMIN; ?>recettes/chercher?new=1">Nouveautés</a></li>
			<li><a href="<? echo CHEMIN; ?>stats/resume">Statistiques</a></li>
				<li><a href="<? echo CHEMIN; ?>glossaires/">Glossaire</a>
						<li><a href="<? echo CHEMIN; ?>ingredients">Ingrédients</a></li>



			<!-- <li><a href="http://www.akademia.ch/voc/pendu/?donnees=script/datas/recettes_ingr.js" target="_blank">Jeu du Pendu</a></li> -->
	</ul>

<?php
############## MEMBERS ##################
	/*	hide from non registred user */
	if($session->read('Auth.User.role')=="member") {
		?>
	<li><a href="" title="">Le club</a>
		<ul class="sousMenu">
			<li><a href="<? echo CHEMIN; ?>statuts-gastronautes.php">Statuts</a></li>
			<li><a href="<? echo CHEMIN; ?>groups">Groups</a></li>
		</ul>
	</li>
	<?
	}
?>

<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>

	<li><a href="" title="">Admin</a>
		<ul class="sousMenu">
			<li><a style="color: PeachPuff" href="<? echo CHEMIN; ?>recettes/">Recettes</a></li>
			<li><a style="color: PeachPuff" href="<? echo CHEMIN; ?>recettes/add">Nouvelle recette</a></li>
			<li><a style="color: PeachPuff" href="<? echo CHEMIN; ?>/linked_recettes/">Recettes liées</a></li>
			<li><a style="color: PeachPuff" href="<? echo CHEMIN; ?>/users_tags/">Tags & Users</a></li>
						
			<li><a href="<? echo CHEMIN; ?>recettes/rss">MàJ flux RSS</a></li>
			<li><a href="recettes/app/webroot/img/up.php">Nouvelle image TODO</a></li>
			<li><a href="<? echo CHEMIN; ?>menus/">Menus</a></li>
			<li><a href="<? echo CHEMIN; ?>diets/">Régimes</a></li>
			<li><a href="<? echo CHEMIN; ?>invitations/">Invitations</a></li>
			<li><a href="<? echo CHEMIN; ?>stats/">Statistiques</a></li>

			<li><a href="<? echo CHEMIN; ?>users">Users</a></li>
			<li><a href="<? echo CHEMIN; ?>groups">Groups</a></li>
			<li><a href="<? echo CHEMIN; ?>pages">Pages</a></li>
			<li><a href="http://www.akademia.ch/MySQLAdmin/" target="_blank">MySQLAdmin</a></li>
			<li><a href="http://imu105.infomaniak.ch/MySQLAdmin/index.php?db=akademiach9" target="_blank">MySQL aka9</a></li>
			
		</ul>
	</li>
<?
	}
?>

<li><a href="" title="">News</a>
		<ul class="sousMenu">
			<li><a href="<? echo CHEMIN; ?>posts" title="zeBlog">Blog</a></li>
			<li><a href="https://github.com/zpartakov/recipesCakePHP" title="zeBlog">Repository (github)</a></li>
			<li><a href="<? echo CHEMIN; ?>restaurants" title="Restaurants">Restaurants</a></li>
		</ul>
</li>

<!-- login -->
	<li><a href="<? echo CHEMIN; ?>users/login" title="S'enregistrer">Login</a>
		<ul class="sousMenu">
			<li><a href="<? echo CHEMIN; ?>users/logout">Logout</a></li>
		</ul>
	</li>
<li>
<!--	<a href="<? echo CHEMIN; ?>recettes/flux.rss">
	<? #echo $html->image('rss.gif', array("alt"=>"rss-syndication", "style"=> "position: relative; top: 6px;"));?>
</a>-->
</li>



</ul>
<?
echo $messagebrowser;
?>
</div>

