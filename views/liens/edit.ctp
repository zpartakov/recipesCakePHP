<div class="liens form">

	<?php echo $this->AlaxosForm->create('Lien');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit lien'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $lien['Lien']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('lib') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('lib', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('url') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('url', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('note') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('note', array('label' => false)); ?>
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
			<?php echo $this->AlaxosForm->end(___('update', true)); ?> 		</td>
 	</tr>
	</table>

</div>
