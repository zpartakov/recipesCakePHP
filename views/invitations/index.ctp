<div class="invitations index">
	
	<h2><?php ___('invitations');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $alaxosForm->create('Invitation', array('controller' => 'invitations', 'url' => $this->passedArgs));
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('date', true), 'Invitation.date');?></th>
		<th><?php echo $this->Paginator->sort(__('invites', true), 'Invitation.invites');?></th>
		<th><?php echo $this->Paginator->sort(__('menu', true), 'Invitation.menu_id');?></th>
		<th><?php echo $this->Paginator->sort(__('remarques', true), 'Invitation.remarques');?></th>
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
			<td>
			<?php
				echo $this->AlaxosForm->filter_field('date');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('invites');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('menu_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('remarques');
			?>
		</td>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $alaxosForm->create('Invitation', array('id' => 'chooseActionForm', 'url' => array('controller' => 'invitations', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($invitations as $invitation):
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
		echo $alaxosForm->checkBox('Invitation.' . $i . '.id', array('value' => $invitation['Invitation']['id']));
		?>
		</td>
		<td>
			<?php echo DateTool :: sql_to_date($invitation['Invitation']['date']); ?>
		</td>
		<td>
			<?php echo $invitation['Invitation']['invites']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($invitation['Menu']['id'], array('controller' => 'menus', 'action' => 'view', $invitation['Menu']['id'])); ?>
		</td>
		<td>
			<?php echo $invitation['Invitation']['remarques']; ?>
		</td>
		<td class="actions">

			<?php echo $html->link($html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $invitation['Invitation']['id']), array('id' => 'detail', 'escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $invitation['Invitation']['id']), array('escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $invitation['Invitation']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $invitation['Invitation']['date'])); ?>

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