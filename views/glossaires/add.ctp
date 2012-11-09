<div class="glossaires form">

	<?php echo $this->AlaxosForm->create('Glossaire');?>
	
 	<h2><?php ___('add glossaire'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('libelle') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('libelle', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('definition1') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('definition1', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('definition2') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('definition2', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('definition3') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('definition3', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('definition4') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('definition4', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('source') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('source', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('type') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('type', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('image') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('image', array('label' => false)); ?>
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
