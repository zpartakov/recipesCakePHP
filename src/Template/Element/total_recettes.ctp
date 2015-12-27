<?php	
//affiche le nombre de recettes total
use Cake\ORM\TableRegistry;
$query = TableRegistry::get('Recettes')->find();
if($this->Session->read('Auth.User')['role']!="administrator" && $_SERVER["HTTP_HOST"]!="localhost"){
	$query->where(['private' => 0]); // Return the same query object	
}

$query->select(['count' => $query->func()->count('*')]);
foreach ($query as $article) {
	echo "<p>Total recettes: " .$article->count."</p>";
}
?>	
