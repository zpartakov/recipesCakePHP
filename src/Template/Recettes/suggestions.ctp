<?php 
require_once("/var/www/radeff/libs/Zpartakov.php");

$this->pageTitle = 'Suggestions'; 
?>
<br/>
 
<div id="suggestion_recette">
<h1>Suggestions du jour &nbsp;
<?php 
echo $this->Html->image('suggestions/suggestion2.jpg',
array("alt"=>"Suggestion", "width" => "100px", "style"=>"vertical-align: middle", "title"=>"cliquer pour de nouvelles suggestions", "url"=>"./"));
?>
</h1>
<?php 
/*
 * a random suggestion of n recipes (12)
 */
random_recipes(30,$session->read('Auth.User.role'));
?>
</div>

<?php
if($this->Session->read('Auth.User')['role']) {
		echo "Bienvenue, " .$this->Session->read('Auth.User')['username'];
	echo "<br>Ton groupe: " .$this->Session->read('Auth.User')['role']."<br>";
}
 //total_recettes
      //$this->requestAction('/recettes/total_recettes');
?>


<h1>
<form method="get" action="<? echo CHEMIN; ?>recettes/chercher">
Chercher <input style="font-size: 1.2em" type="text" name="chercher" value="" id="inputString" />
<input style="width: 30px" type="image" src="/recettes2/img/find.png" alt="Chercher" title="Chercher">
&nbsp;<span style="font-size: 0.7em"><a href=pages/search>Recherche avancée</a></span>
</form>
</h1>



