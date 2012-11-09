<div class="stats view">
	
	<h2><?php ___('stat');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $stat['Stat']['id'], 'delete_id' => $stat['Stat']['id'], 'delete_text' => ___('do you really want to delete this stat ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('recette'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($stat['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $stat['Recette']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('user'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($stat['User']['email'], array('controller' => 'users', 'action' => 'view', $stat['User']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('ip'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $stat['Stat']['ip']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo DateTool :: sql_to_date($stat['Stat']['date']); ?>
		</td>
	</tr>
	</table>
</div>
