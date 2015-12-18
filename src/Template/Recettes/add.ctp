<SCRIPT LANGUAGE="JavaScript">
function ClipBoard(s) {
	text=document.getElementById('pict').value;
	window.prompt ("Copier dans le presse-papier: Ctrl+C, Enter", text);
    }
</SCRIPT> 
<?php


$lastid=$lastid+1;
$image=$lastid.".jpg";
?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Recettes'), ['action' => 'index']) ?></li>
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
<div class="recettes form large-10 medium-9 columns">
    <?= $this->Form->create($recette) ?>
    <fieldset>
        <legend><?= __('Add Recette') ?></legend>
         <div class="input select required"><label for="prov">Prov</label>
         <select name="prov" style="width: 230px" required="required" id="prov">
		 <?php
			foreach ($pays as $pay): 
				echo "<option>".$pay."</option>";
			endforeach;
		?>
		 </select>
        <?php
        /*
         * http://stackoverflow.com/questions/31353085/validating-fields-as-unique-in-cakephp-3-0
         * http://book.cakephp.org/3.0/fr/orm/validation.html
         * http://book.cakephp.org/3.0/fr/core-libraries/validation.html
         * */
			//echo $this->Form->input('prov', ['options' => $lespays, 'style'=>'width: 230px']);
//            echo $this->Form->input('titre', ['label'=>'Titre de la recette', "onBlur"=>"checkunik(document.getElementById('titre').value)"]);
            echo $this->Form->input('titre', ['label'=>'Titre de la recette']);
            echo $this->Form->input('temps', ['type'=>'text','label'=>'Temps de repos/préparation', 'value'=>0]);
            echo $this->Form->input('ingr', ['label'=>'Ingrédients']);
            echo $this->Form->input('pers', ['type'=>'text', 'value'=>6]);
            echo $this->Form->input('type_id', ['options' => $types]);
            echo $this->Form->input('prep', ['label'=>'Préparation']);
            echo $this->Form->input('date', ['type'=>'hidden', 'value'=>date('Y-m-d')]);
            echo $this->Form->input('score', ['type'=>'hidden', 'value'=>0]);
            echo $this->Form->input('source', ['type'=>'text','label'=>'Source (url)', 'value'=>$last_source]);
            echo $this->Form->input('pict', ['type'=>'text','label'=>'Image', 'value'=>$image, 'onClick' => "ClipBoard();"]);
            echo $this->Form->input('private', ['checked'=>'1']);
            echo $this->Form->input('mode_cuisson_id', ['options' => $modeCuissons]);
            echo $this->Form->input('time', ['type'=>'hidden', 'value'=>0]);
            echo $this->Form->input('difficulty', ['type'=>'hidden', 'value'=>0]);
            echo $this->Form->input('price', ['type'=>'hidden', 'value'=>0]);
            echo $this->Form->input('diet_id', ['options' => $diets]);
            //echo $this->Form->input('tags._ids', ['options' => $tags, ['type'=>'hidden']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

