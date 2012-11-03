<div class="menus view">
	
	<h2><?php ___('menu');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $menu['Menu']['id'], 'delete_id' => $menu['Menu']['id'], 'delete_text' => ___('do you really want to delete this menu ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('identifiantmenu'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $menu['Menu']['identifiantmenu']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('recette id'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $menu['Menu']['recette_id']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $menu['Menu']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
