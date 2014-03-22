<script type="text/javascript">
$(function(){
$('.tags-input input').tagsInput();
});
</script>
<?php
echo $javascript->link('ckeditor/ckeditor', NULL, false);

if($session->read('Auth.User.role')) {
	echo $this->Form->input('Tag.tags', array('div' => array('class' => 'tags-input input'), 'label' => 'Tags'));
}


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
		echo $this->Form->input('mode_cuisson_id');
		echo $this->Form->input('prov', array("style"=>"width: 200px; height: 20px"));
		echo $this->Form->input('titre', array("style"=>"width: 600px; height: 20px; font-weight: bold"));
		echo $this->Form->input('temps', array("style"=>"width: 600px; height: 20px"));
		echo $this->Form->input('pers');
		
		?></td>
		</tr>
		<tr>
<td>
		<?php 
		echo $this->Form->input('ingr', array("style"=>"width: 300px; height: 400px", "value"=>$this->data['Recette']['ingr']));
		echo $fck->load('Recette.ingr');
		
?>
</td></tr>
		<tr>
<td>
<?php 		
		echo $this->Form->input('type_id');
		echo $this->Form->input('prep', array("style"=>"width: 300px; height: 400px", "value"=>$this->data['Recette']['prep']));
		echo $fck->load('Recette.prep');
		
		?>		</td></tr>
		<tr>
<td>		<?php 
		echo $this->Form->input('date');
		echo $this->Form->input('score');
		echo $this->Form->input('source', array("style"=>"width: 600px; height: 20px"));
		echo $this->Form->input('pict', array("style"=>"width: 200px; height: 20px"));
?>
</td></tr>
		<tr>
<td>
<?php 		
		echo $this->Form->input('private');
		echo $this->Form->input('time', array("label"=>"Note"));
		echo $this->Form->input('difficulty');
		echo $this->Form->input('price');
		echo $this->Form->input('diet_id');

		
		?>

</fieldset>
<div style="position: absolute; top: 240px; right: 6%"><?php echo $this->Form->end(__('Submit', true));?></div>
</td></tr>	
</table></div>
