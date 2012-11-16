<?
$this->pageTitle = "Modifier une recette"; 
$largeur_champs_text=50;
$largeur_champs_textarea=60;
$hauteur_champs_textarea=20;
?>
<div class="recettes_edit">
<?php echo $this->Form->create('Recette');?>
 		<table>
<fieldset>
 		<legend><?php __('Edit Recette'); ?></legend>
 		<tr>
<td>	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('prov', array("style"=>"width: 200px; height: 20px"));
		echo $this->Form->input('titre', array("style"=>"width: 300px; height: 20px"));
		echo $this->Form->input('temps', array("style"=>"width: 200px; height: 20px"));
		echo $this->Form->input('ingr', array("style"=>"width: 300px; height: 400px"));
		echo $this->Form->input('pers');
?>
</td>
<td>
<?php 		
		echo $this->Form->input('type_id');
		echo $this->Form->input('prep', array("style"=>"width: 300px; height: 400px"));
		echo $this->Form->input('date');
		echo $this->Form->input('score');
		echo $this->Form->input('source', array("style"=>"width: 200px; height: 20px"));
		echo $this->Form->input('pict', array("style"=>"width: 200px; height: 20px"));
?>
</td>
<td>
<?php 		
		echo $this->Form->input('private');
		echo $this->Form->input('mode_cuisson_id');
		echo $this->Form->input('time');
		echo $this->Form->input('difficulty');
		echo $this->Form->input('price');
		echo $this->Form->input('diet_id');
	?>

</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</td></tr>	
</table></div>
