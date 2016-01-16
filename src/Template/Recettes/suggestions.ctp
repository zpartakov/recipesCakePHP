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
 if($this->Session->read('Auth.User')['role']!="administrator"){
   $admin=0;
 	$lestyle="display: none";
 }else {
 	$admin=1;
 	$lestyle="";
 }
random_recipes(30,$admin);
?>
</div>
