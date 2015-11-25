<nav>
   <!--The mobile navigation Markup hidden via css-->
        <ul>
    	<!-- homepage -->
	<li><a href="<? echo CHEMIN; ?>">Accueil</a>
			<li><a href="<? echo CHEMIN; ?>recettes/">Nouveautés</a></li>
			<li><a href="/dokuwiki/doku.php?id=cuisine:aide_recettes">Aide</a></li>
			<li><a href="<? echo CHEMIN; ?>recettes/?source=radeff" target="_blank">Les recettes de Fred</a></li>
			<li><a href="/cms/dotclear/index.php?tag/cuisine">Le blog de Fred (cuisine)</a></li>
			<li><a href="<? echo CHEMIN; ?>recettes/?titre=mare%25monti" title="Des recettes de la mer et de la montagne">Mare & Monti</a></li>
			<li><a href="<? echo CHEMIN; ?>restaurants" title="Restaurants">Restaurants</a></li>
			<!-- 
			<li><a href="/c5/cuisine-cooking/mes-livres-de-cuisine/?">Livres de recettes</a></li> 
			<li><a href="<? echo CHEMIN; ?>recettes/index.rss">Flux RSS</a></li>
			<li><a href="<? echo CHEMIN; ?>recettes/suggestions">Suggestions</a></li>
		 	<li><?php //echo '<a class="contact" href="/dokuwiki/contact" title="Contact">'.$html->image('ico-contact.gif', array("alt"=>"Contact", "width"=>"20","height"=>"20")).'&nbsp;Contact</a>';?></li>
			<li><a href="/biblio/result.php?type=cuisine" target="_blank">Livres de cuisine</a></li>
			<li><a href="/voc/pendu/?donnees=script/datas/recettes_ingr.js" target="_blank">Jeu du Pendu</a></li> 
			<li><a href="<? echo CHEMIN; ?>liens/">Liens</a></li>		
			<li><a href="<? echo CHEMIN; ?>mode_cuissons/">Modes de cuisson</a></li>
			<li><a href="<? echo CHEMIN; ?>glossaires/">Glossaire</a>
			<li><a href="<? echo CHEMIN; ?>pages/conversions">Conversions</a>
			-->

<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */


//if($session->read('Auth.User.role')=="administrator") {
if($this->Session->read('Auth.User')['role']=="administrator") {
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


if($this->Session->read('Auth.User')['role']=="administrator") {
?>
            <li><a style="color: PeachPuff" href="<? echo CHEMIN; ?>recettes/add">Nouvelle recette</a></li>

<?php
}

?>


</ul>
</nav>

