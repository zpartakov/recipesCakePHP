<div class="linkedRecettes form">
<?php echo $this->Form->create('LinkedRecette');?>
	<fieldset>
 		<legend><?php __('Edit Linked Recette'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('recette_id');
		echo $this->Form->input('recettes_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('LinkedRecette.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('LinkedRecette.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Linked Recettes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Recettes', true), array('controller' => 'recettes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recette', true), array('controller' => 'recettes', 'action' => 'add')); ?> </li>
	</ul>
</div>