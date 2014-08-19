<?php 
App::import('Lib', 'functions'); //imports app/libs/functions 

$this->pageTitle = 'Accueil'; 

if($session->read('Auth.User.role')) {
		echo "Bienvenue, " .$session->read('Auth.User.username');
	echo "<br>Ton groupe: " .$session->read('Auth.User.role')."<br>";
}
 //total_recettes
      $this->requestAction('/recettes/total_recettes');
?>
<br/>
<h1>
<form method="get" action="<? echo CHEMIN; ?>recettes/chercher">
Chercher <input style="font-size: 1.2em" type="text" name="chercher" value="" id="inputString" />
<input style="width: 30px" type="image" src="/recettes2/img/find.png" alt="Chercher" title="Chercher">
&nbsp;<span style="font-size: 0.7em"><a href=pages/search>Recherche avancée</a></span>
</form>
</h1>
<div id="suggestion_recette">
<h1>Suggestions du jour &nbsp;
<?php 
echo $html->image('suggestions/suggestion2.jpg',
array("alt"=>"Suggestion", "width" => "100px", "style"=>"vertical-align: middle", "title"=>"cliquer pour de nouvelles suggestions", "url"=>"./"));
?>
</h1>
<?php 
/*
 * a random suggestion of n recipes (12)
 */
random_recipes(12,$session->read('Auth.User.role'));
?>
</div>










