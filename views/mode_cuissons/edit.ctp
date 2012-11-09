<div class="modeCuissons form">
<?php echo $this->Form->create('ModeCuisson');?>
	<fieldset>
 		<legend><?php __('Edit Mode Cuisson'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent');
		echo $this->Form->input('lib');
		echo $this->Form->input('rem');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ModeCuisson.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ModeCuisson.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mode Cuissons', true), array('action' => 'index'));?></li>
	</ul>
</div>