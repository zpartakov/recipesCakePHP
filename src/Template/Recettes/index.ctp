<?php
$this->set('title', "Liste de recettes de cuisine");

//$this->AuthUser->id();
//$username=$this->AuthUser->user('username');

/*
if ($this->Session->read('Auth.User')){
	echo "<br>session username: "; echo $this->Session->read('Auth.User')['username'];
	echo "<br>session role: "; echo $this->Session->read('Auth.User')['role'];
	echo "<br>session email: "; echo $this->Session->read('Auth.User')['email'];
	echo "<br>session id: "; echo $this->Session->read('Auth.User')['id'];
//session: Array ( [username] => radeff [] => fradeff@akademia.ch [pseudo] => radeff [role] => administrator [id] => 6 [dateIn] => Cake\I18n\Time Object ( [date] => 2010-11-29 17:15:00 [timezone_type] => 3 [timezone] => UTC ) )
}
*/
if($this->Session->read('Auth.User')['role']!="administrator" && $_SERVER["HTTP_HOST"]!="localhost"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}

use Cake\Filesystem\Folder;
//use Cake\Filesystem\File; //not mandatory
$dir = new Folder(WWW_ROOT . 'img/pics');
?>

<div class="actions columns large-2 medium-3" style="<?php echo $lestyle; ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Recette'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mode Cuissons'), ['controller' => 'ModeCuissons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mode Cuisson'), ['controller' => 'ModeCuissons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diets'), ['controller' => 'Diets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diet'), ['controller' => 'Diets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recette User'), ['controller' => 'RecetteUser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette User'), ['controller' => 'RecetteUser', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stats'), ['controller' => 'Stats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stat'), ['controller' => 'Stats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users Tags'), ['controller' => 'UsersTags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Users Tag'), ['controller' => 'UsersTags', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</div>

<div class="recettes index large-10 medium-9 columns">
	<?php
if($_GET['source']||$_GET['titre']||$_GET['prep']||$_GET['temps']||$_GET['type_id']||$_GET['ingr']||$_GET['ingrNot']||$_GET['ingrNot1']||$_GET['prov']||$_GET['mode_cuisson_id']||$_GET['kids']||$_GET['diet_id']){
echo "<h3>Recherche avancée</h3>";
	if($_GET['source']) {
		echo "<h3>Recherche source: " .$_GET['source'] ."</h3>";
	}
	if($_GET['titre']) {
		echo "<h3>Recherche titre: " .$_GET['titre'] ."</h3>";
	}
	if($_GET['prep']) {
		echo "<h3>Recherche préparation: " .$_GET['prep'] ."</h3>";
	}
}elseif($_GET['globalsearch']){
echo "<h3>Recherche simple</h3>";
}else{
echo "<h3>Nouveautés</h3>";
}

if(!is_nan($nbrec)) {
echo "<h3>Nombre de recettes: #" .$nbrec ."</h3>";
}
	?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th style="<?php echo $lestyle; ?>">
            <?= $this->Paginator->sort('titre') ?></th>
			<th style="<?php echo $lestyle; ?>">Pays d'origine</th>
            <th style="<?php echo $lestyle; ?>"><?= $this->Paginator->sort('type_id') ?></th>
            <th class="actions" style="<?php echo $lestyle; ?>"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php
		foreach ($recettes as $recette): ?>


    <?php
    //do not display if private recipe to non-logged users
			$prive=$recette->private;
			if(($prive=="1") && (!$this->Session->read('Auth.User')['role']) &&  ($_SERVER["HTTP_HOST"]!="localhost")) {
			} else {
    ?>

        <tr>
            <td>
				<strong>
				<?php
				//echo "<h1>private?: ".$prive."</h1>";
				$titre=$recette->titre;
				$titre=preg_replace("/<!--.*-->/","",$titre);

				//any image of the recipe?
				$files = $dir->find($recette->pict, true);
				$nimg=count($files);
				if($nimg==1) {
					echo $this->Html->image('pics/'.$recette->pict, [
						'style'=>'width: 100px;',
						'alt' => $titre,
						'title' => $titre,
						'url' => ['controller' => 'Recettes', 'action' => 'view', $recette->id]]);
				}
				?>
			&nbsp;<?= $this->Html->link($titre, ['action' => 'view', $recette->id]) ?></strong></td>
            <td style="<?php echo $lestyle; ?>"><?= h($recette->prov) ?></td>
            <td style="<?php echo $lestyle; ?>">
                <?= $recette->has('type') ? $this->Html->link($recette->type->name, ['controller' => 'Types', 'action' => 'view', $recette->type->id]) : '' ?>
            </td>
            <td class="actions" style="<?php echo $lestyle; ?>">
                <?= $this->Html->link(__('View'), ['action' => 'view', $recette->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $recette->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $recette->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recette->id)]) ?>
            </td>
        </tr>




    <?php
}

     endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
