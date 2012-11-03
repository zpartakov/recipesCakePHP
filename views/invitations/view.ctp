<div class="invitations view">
	
	<h2><?php ___('invitation');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $invitation['Invitation']['id'], 'delete_id' => $invitation['Invitation']['id'], 'delete_text' => ___('do you really want to delete this invitation ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('date'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo DateTool :: sql_to_date($invitation['Invitation']['date']); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('invites'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $invitation['Invitation']['invites']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('menu'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $invitation['Invitation']['menu_id']; ?>
		</td>
	</tr>
	
	<tr>
	<td>
	Mets
	</td>
	<td>
	:
	</td>
	<td>
	<?
		$sql="
		SELECT * FROM `menus`,`recettes` 
		 WHERE 
		menus.recette_id=recettes.id 
		 AND 
		menus.identifiantmenu LIKE '" .$invitation['Invitation']['menu_id'] .
		"' ORDER BY type_id, titre";
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$i=0;
	while($i<$nbrec) {
		$titre=mysql_result($result,$i,'titre');
		$titre=ucfirst($titre);
		echo "<li><a href=\"/recettes2/recettes/view/" .$titre=mysql_result($result,$i,'recettes.id') ."\">".$titre ."</a></li>\n";
		$i++;
	}
	?>
	</td>
	</tr>
	
	<tr>
		<td>
			<?php ___('remarques'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $invitation['Invitation']['remarques']; ?>
		</td>
	</tr>
	</table>
</div>
