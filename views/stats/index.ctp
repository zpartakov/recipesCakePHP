<div class="stats index">
	
	<h2><?php ___('stats');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $alaxosForm->create('Stat', array('controller' => 'stats', 'url' => $this->passedArgs));
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('recette', true), 'Stat.recette_id');?></th>
		<th><?php echo $this->Paginator->sort(__('user', true), 'Stat.user_id');?></th>
		<th><?php echo $this->Paginator->sort(__('ip', true), 'Stat.ip');?></th>
		<th><?php echo $this->Paginator->sort(__('date', true), 'Stat.date');?></th>
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
			<td>
			<?php
				echo $this->AlaxosForm->filter_field('recette_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('user_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('ip');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('date');
			?>
		</td>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $alaxosForm->create('Stat', array('id' => 'chooseActionForm', 'url' => array('controller' => 'stats', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($stats as $stat):
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
		echo $alaxosForm->checkBox('Stat.' . $i . '.id', array('value' => $stat['Stat']['id']));
		?>
		</td>
		<td>
			<?php echo $this->Html->link($stat['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $stat['Recette']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($stat['User']['email'], array('controller' => 'users', 'action' => 'view', $stat['User']['id'])); ?>
		</td>
		<td>
			<?php echo $stat['Stat']['ip']; ?>
		</td>
		<td>
			<?php echo DateTool :: sql_to_date($stat['Stat']['date']); ?>
		</td>
		<td class="actions">

			<?php echo $html->link($html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $stat['Stat']['id']), array('id' => 'detail', 'escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $stat['Stat']['id']), array('escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $stat['Stat']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $stat['Stat']['id'])); ?>

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
	
	<?php
if($i > 0)
{
	echo '<div class="choose_action">';
	echo ___d('alaxos', 'action to perform on the selected items', true);
	echo '&nbsp;';
	echo $alaxosForm->input_actions_list();
	echo '&nbsp;';
	echo $alaxosForm->end(array('label' =>___d('alaxos', 'go', true), 'div' => false));
	echo '</div>';
}
?>
	
</div>