<div class="liens view">
	
	<h2><?php ___('lien');?></h2>
	
	<?php
if($session->read('Auth.User.role')=="administrator") {
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $lien['Lien']['id'], 'delete_id' => $lien['Lien']['id'], 'delete_text' => ___('do you really want to delete this lien ?', true)));
} else {
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
}
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('Libellé'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $lien['Lien']['lib']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('url'); ?>
		</td>
		<td>:</td>
		<td>
			<?php 
				echo "<a href=\"".$lien['Lien']['url']."\" target=\"_blank\">" .$lien['Lien']['url'] ."</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('note'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $lien['Lien']['note']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo DateTool :: sql_to_date($lien['Lien']['date']); ?>
		</td>
	</tr>
	</table>
</div>
