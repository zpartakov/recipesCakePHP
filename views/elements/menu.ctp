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
			<li><a href="<? echo CHEMIN; ?>pages/search">Recherche avancée</a></li>
			<li><a href="<? echo CHEMIN; ?>recettes/chercher?new=1">Nouveautés</a></li>
			<li><a href="/dokuwiki/doku.php?id=cuisine:aide_recettes">Aide</a></li>
			<li><a href="<? echo CHEMIN; ?>recettes/chercher?source=radeff" target="_blank">Les recettes de Fred</a></li>
			<li><a href="/cms/dotclear/index.php?tag/cuisine">Le blog de Fred (cuisine)</a></li>
			<li><a href="/c5/cuisine-cooking/mes-livres-de-cuisine/?">Les livres de recettes de Fred</a></li>
			
	  <!--  <li><a href="<? echo CHEMIN; ?>recettes/rss">Flux RSS</a></li>-->
			</ul>
	<li>
		<a href="<? echo CHEMIN; ?>recettes/chercher?titre=mare%25monti" title="Des recettes de la mer et de la montagne">Mare & Monti</a>
		<ul>
			<li><a href="<? echo CHEMIN; ?>restaurants" title="Restaurants">Restaurants</a></li>
			<li><a href="<? echo CHEMIN; ?>liens/">Liens</a></li>		
			<li><a href="<? echo CHEMIN; ?>mode_cuissons/">Modes de cuisson</a></li>
			<li><a href="<? echo CHEMIN; ?>glossaires/">Glossaire</a>
			<li><a href="<? echo CHEMIN; ?>pages/conversions">Conversions</a>
			<!-- 
		 	<li><?php echo '<a class="contact" href="/dokuwiki/contact" title="Contact">'.$html->image('ico-contact.gif', array("alt"=>"Contact", "width"=>"20","height"=>"20")).'&nbsp;Contact</a>';?></li>
			<li><a href="/biblio/result.php?type=cuisine" target="_blank">Livres de cuisine</a></li>
			<li><a href="/voc/pendu/?donnees=script/datas/recettes_ingr.js" target="_blank">Jeu du Pendu</a></li> 
			-->
		
		</ul>
	</li>

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
			<li><a href="recettes/app/webroot/img/up.php">Nouvelle image TODO</a></li>
			<li><a href="<? echo CHEMIN; ?>menus/">Menus</a></li>
			<li><a href="<? echo CHEMIN; ?>diets/">Régimes</a></li>
			<li><a href="<? echo CHEMIN; ?>invitations/">Invitations</a></li>
			<li><a href="<? echo CHEMIN; ?>users">Users</a></li>
			<li><a href="<? echo CHEMIN; ?>groups">Groups</a></li>
			<li><a href="<? echo CHEMIN; ?>pages">Pages</a></li>
			<li><a href="https://oblomov.info/mysql/db_structure.php?db=cake_recettes" target="_blank">MySQLAdmin db=akademiach9</a></li>
			<li><a href="<? echo CHEMIN; ?>stats/resume">Statistiques</a></li>		
			<li><a href="<? echo CHEMIN; ?>ingredients">Ingrédients</a></li>			
		</ul>
	</li>
<?
	}
?>

<!-- login -->
	<li><a href="<? echo CHEMIN; ?>users/login" title="S'enregistrer">Login</a>
		<ul class="sousMenu">
			<li><a href="<? echo CHEMIN; ?>users/logout">Logout</a></li>
			<li><a href="https://github.com/zpartakov/recipesCakePHP" title="zeBlog">Repository (github)</a></li>
			</ul>
	</li>


<?php
############## ADMIN AREA ##################
/*  hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>
            <li><a style="color: PeachPuff" href="<? echo CHEMIN; ?>recettes/add">Nouvelle recette</a></li>

<?php
}
?>


</ul>
<?
echo $messagebrowser;
?>
</div>

