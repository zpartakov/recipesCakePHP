<div class="ingredients form">

	<?php echo $this->AlaxosForm->create('Ingredient');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit ingredient'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $ingredient['Ingredient']['id']));
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
			<?php ___('typ') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('typ', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unit') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('unit', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kcal') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('kcal', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('price') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('price', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('img') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('img', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('commissions') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('commissions', array('label' => false)); ?>
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
