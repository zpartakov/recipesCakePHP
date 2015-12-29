<?php
$this->set('title', "Liste d'épices, condiments etc. de cuisine");
if($this->Session->read('Auth.User')['role']!="administrator"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}
?>
<div class="actions columns large-2 medium-3" style="<?php echo $lestyle; ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Epice'), ['action' => 'edit', $epice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Epice'), ['action' => 'delete', $epice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $epice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Epices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Epice'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="epices view large-10 medium-9 columns">
               <p style="float: right; width: 200px; margin-right: 3em">            
		<?php       
		/*
		 * is there any image of that recipe?
		 * */
		use Cake\Filesystem\Folder;
		//use Cake\Filesystem\File; //not mandatory
		$dir = new Folder(WWW_ROOT . 'img/pics/epices');
		$files = $dir->find($epice->image, true);
		$nimg=count($files);
		if($nimg==1) {
			//echo "<p>yo image!</p>"; //tests
            echo $this->Html->image('pics/epices/'.$epice->image);
		}
        ?>
	</p> <h2><?= h($epice->lib) ?></h2>
    <div class="row">
        <div class="large-7 columns numbers end">
            <h6 class="subheader"><?= __('Origine') ?></h6>
            <p><?= $this->Text->autoParagraph($epice->origine) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Définition') ?></h6>
            <?= $this->Text->autoParagraph(h($epice->def)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Utilisation') ?></h6>
            <?= $this->Text->autoParagraph(h($epice->util)) ?>
			<h6 class="subheader"><?= __('Url') ?></h6>
            <p><a href="<?= h($epice->url) ?>"><?= h($epice->url) ?></a></p>
        </div>
    </div>
    <hr />
<p><a href="/recettes/recettes/?ingrNot=<?php echo $epice->lib;?>">Chercher des recettes avec cette épice</a></p>
<div class=recipes>
<?php
//print_r($recettes);
//debug($recettes->toArray());
?>
    <?php //foreach ($recettes as $recette): ?>
<?php       
/*				echo "<p>";
				$titre=$recette->titre; 
				$titre=preg_replace("/<!--.*-->/","",$titre);

				//any image of the recipe?
				$files = $dir->find($recette->pict, true);
				$nimg=count($files);
				if($nimg==1) {
					echo $this->Html->image('pics/'.$recette->pict, [
						'style'=>'width: 30%;', 
						'alt' => $titre,
						'title' => $titre,
						'url' => ['controller' => 'Recettes', 'action' => 'view', $recette->id]]);
				}
				echo $titre;
				?>
			&nbsp;<?//= $this->Html->link($titre, ['action' => 'view', $recette->id]) ?></p>
  */  
     //endforeach; ?>
</div>
</div>
