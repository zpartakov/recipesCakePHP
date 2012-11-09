<div class="liens form">

	<?php echo $this->AlaxosForm->create('Lien');?>
	
 	<h2><?php ___('add lien'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
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
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
 	</tr>
	</table>

</div>
