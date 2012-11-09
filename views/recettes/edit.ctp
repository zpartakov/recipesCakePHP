<?
$this->pageTitle = "Modifier une recette"; 
$largeur_champs_text=50;
$largeur_champs_textarea=60;
$hauteur_champs_textarea=20;
?>
<div class="recettes form">
<?php echo $this->Form->create('Recette');?>
	<fieldset>
 		<legend><?php __('Edit Recette'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('prov');
		echo $this->Form->input('titre');
		echo $this->Form->input('temps');
		echo $this->Form->input('ingr');
		echo $this->Form->input('pers');
		echo $this->Form->input('type_id');
		echo $this->Form->input('prep');
		echo $this->Form->input('date');
		echo $this->Form->input('score');
		echo $this->Form->input('source');
		echo $this->Form->input('pict');
		echo $this->Form->input('private');
		echo $this->Form->input('mode_cuisson_id');
		echo $this->Form->input('time');
		echo $this->Form->input('difficulty');
		echo $this->Form->input('price');
		echo $this->Form->input('diet_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
