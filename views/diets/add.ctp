<div class="diets form">
<?php echo $this->Form->create('Diet');?>
	<fieldset>
 		<legend><?php __('Ajouter un régime'); ?></legend>
	<?php
		echo $this->Form->input('lib');
		echo $this->Form->input('rem');
		echo $this->Form->input('date_mod');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Diets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Recettes', true), array('controller' => 'recettes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recette', true), array('controller' => 'recettes', 'action' => 'add')); ?> </li>
	</ul>
</div>