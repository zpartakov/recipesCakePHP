<div class="stats form">

	<?php echo $this->AlaxosForm->create('Stat');?>
	
 	<h2><?php ___('add stat'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('recette_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('recette_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('user_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('user_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('ip') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('ip', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('date', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
 	</tr>
	</table>

</div>
