<div class="menus form">

	<?php echo $this->AlaxosForm->create('Menu');?>
	
 	<h2><?php ___('add menu'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
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
			<?php echo $this->AlaxosForm->input('recette_id', array('label' => false, 'type'=>'text')); ?>
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
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
 	</tr>
	</table>

</div>
