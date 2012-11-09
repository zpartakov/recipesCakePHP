<div class="menus form">

	<?php echo $this->AlaxosForm->create('Menu');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit menu'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $menu['Menu']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('identifiantmenu') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('identifiantmenu', array('label' => false)); ?>
		</td>
	</tr>
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
			<?php ___('rem') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('rem', array('label' => false)); ?>
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
