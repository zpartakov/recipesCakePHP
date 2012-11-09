<div class="groups view">
	
	<h2><?php ___('group');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $group['Group']['id'], 'delete_id' => $group['Group']['id'], 'delete_text' => ___('do you really want to delete this group ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('name'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $group['Group']['name']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('created'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo DateTool :: sql_to_date($group['Group']['created']); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('modified'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo DateTool :: sql_to_date($group['Group']['modified']); ?>
		</td>
	</tr>
	</table>
</div>
