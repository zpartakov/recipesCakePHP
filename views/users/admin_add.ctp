<div class="users form">

	<?php echo $this->AlaxosForm->create('User');?>
	
 	<h2><?php ___('admin add user'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('username') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('username', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('password') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('password', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('email') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('email', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('pseudo') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('pseudo', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('role') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('role', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('dateIn') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('dateIn', array('label' => false)); ?>
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
