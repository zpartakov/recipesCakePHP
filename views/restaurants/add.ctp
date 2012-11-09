<div class="restaurants form">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
 		<legend><?php __('Add Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('nom');
		echo $this->Form->input('adresse');
		echo $this->Form->input('tel');
		echo $this->Form->input('email');
		echo $this->Form->input('url');
		echo $this->Form->input('zip');
		echo $this->Form->input('ville');
		echo $this->Form->input('pays');
		echo $this->Form->input('type');
		echo $this->Form->input('rem');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Restaurants', true), array('action' => 'index'));?></li>
	</ul>
</div>