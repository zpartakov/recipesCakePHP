<div class="invitations form">

	<?php echo $this->AlaxosForm->create('Invitation');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit invitation'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $invitation['Invitation']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
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
		<td>
			<?php ___('invites') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('invites', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('menu_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('menu_id', array('label' => false, 'type'=>'text')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('remarques') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('remarques', array('label' => false)); ?>
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
