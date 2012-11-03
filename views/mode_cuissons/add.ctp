<div class="modeCuissons form">
<?php echo $this->Form->create('ModeCuisson');?>
	<fieldset>
 		<legend><?php __('Add Mode Cuisson'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Mode Cuissons', true), array('action' => 'index'));?></li>
	</ul>
</div>