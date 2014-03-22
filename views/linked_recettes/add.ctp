<div class="linkedRecettes form">
<?php echo $this->Form->create('LinkedRecette');?>
	<fieldset>
 		<legend><?php __('Add Linked Recette'); ?></legend>
	<?php
	//echo $this->$linkedRecette['Recette']['titre'];
	//echo $this->Form->value('Recette.titre'))
		echo $this->Form->input('recette_id', array("type"=>"text","value"=>$_GET['id']));
		echo $this->Form->input('recettes_id', array("type"=>"text", "label"=>"Recette liée"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Linked Recettes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Recettes', true), array('controller' => 'recettes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recette', true), array('controller' => 'recettes', 'action' => 'add')); ?> </li>
	</ul>
</div>
