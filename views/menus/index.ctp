<div class="menus index">
	
	<h2><?php ___('menus');?></h2>
	 	
	
	
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('identifiantmenu', true), 'Menu.identifiantmenu');?></th>
		<th><?php echo $this->Paginator->sort(__('recette_id', true), 'Menu.recette_id');?></th>
		<th><?php echo $this->Paginator->sort(__('rem', true), 'Menu.rem');?></th>
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	

	
	<?php
	$i = 0;
	foreach ($menus as $menu):
		$class = null;
		if ($i++ % 2 == 0)
		{
			$class = ' class="row"';
		}
		else
		{
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php
		
		
		?>
		</td>
		<td>
			<?php 
			//echo $alaxosForm->checkBox('Menu.' . $i . '.id', array('value' => $menu['Menu']['id']));
		$sql="SELECT *
FROM invitations
WHERE menu_id LIKE '".$menu['Menu']['identifiantmenu'] ."'";
		$sql=mysql_query($sql);
		$sql=mysql_result($sql, 0, 'id');
		echo '<a href="http://radeff.net/recettes2/invitations/view/'.$sql .'">';
		
			echo $menu['Menu']['identifiantmenu']; 
			
					echo '</a>';
			?>
		</td>
		<td>
			<?php #echo $menu['Menu']['recette_id']; ?>
			<?
		$sql="
		SELECT * FROM `recettes` 
		 WHERE 
id =" .$menu['Menu']['recette_id'];
	#echo $sql;
	$result = mysql_query($sql); 
	testsql($result);
	$nbrec=mysql_num_rows($result);
	$i=0;
	while($i<$nbrec) {
		$titre=mysql_result($result,$i,'titre');
		$titre=ucfirst($titre);
		echo "<li><a href=\"/recettes2/recettes/view/" .$titre=mysql_result($result,$i,'id') ."\">".mysql_result($result,$i,'titre') ."</a></li>\n";
		$i++;
	}
	?>
		</td>
		<td>
			<?php echo $menu['Menu']['rem']; ?>
		</td>
		<td class="actions">

			<?php echo $html->link($html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $menu['Menu']['id']), array('id' => 'detail', 'escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $menu['Menu']['id']), array('escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $menu['Menu']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $menu['Menu']['id'])); ?>

		</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 |
	 	<?php echo $this->Paginator->numbers();?>	 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	

	
</div>