<?
$this->pageTitle="Liens";
?>
<div class="liens index">
	
	 	
	<?php
if($session->read('Auth.User.role')=="administrator") {
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
}
	echo $alaxosForm->create('Lien', array('controller' => 'liens', 'url' => $this->passedArgs));
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
<?if($session->read('Auth.User.role')=="administrator") {?>
		<th style="width:5px;"></th>
<?}?>
		<th><?php echo $this->Paginator->sort(__('Libellé', true), 'Lien.lib');?></th>
		<th><?php echo $this->Paginator->sort(__('date', true), 'Lien.date');?></th>
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<tr class="searchHeader">
			<td colspan="2">
			<?php
				echo $this->AlaxosForm->filter_field('lib');
			?>
		</td>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('Chercher', true));?>
    		</div>
    		
    		<?php
			echo $alaxosForm->create('Lien', array('id' => 'chooseActionForm', 'url' => array('controller' => 'liens', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($liens as $lien):
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
<?if($session->read('Auth.User.role')=="administrator") {?>
		<td>
		<?php
		echo $alaxosForm->checkBox('Lien.' . $i . '.id', array('value' => $lien['Lien']['id']));
		?>
		</td>
<?}?>
		<td>
			<?php echo "<a href=\"" .$lien['Lien']['url'] ."\" target=\"_blank\">" .$lien['Lien']['lib'] ."</a>"; ?>
		</td>
		<td>
			<?php echo DateTool :: sql_to_date($lien['Lien']['date']); ?>
		</td>
		<td class="actions">

			<?php echo $html->link($html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $lien['Lien']['id']), array('id' => 'detail', 'escape' => false)); ?>
			<?php 
			if($session->read('Auth.User.role')=="administrator") {
				echo $html->link($html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $lien['Lien']['id']), array('escape' => false));
				echo $html->link($html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $lien['Lien']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $lien['Lien']['lib'])); 
			}
			?>

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
if($session->read('Auth.User.role')=="administrator") {
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
}
?>
	
</div>
