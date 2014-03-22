<?
$this->pageTitle = 'Glossaire'; 
?>
<div class="glossaires index">
	
	 	
	<?php
	if($session->read('Auth.User.role')=="administrator") {

	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
}
	?>

	<?php
	echo $alaxosForm->create('Glossaire', array('controller' => 'glossaires', 'url' => $this->passedArgs));
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
<?php
	if($session->read('Auth.User.role')=="administrator") {
?>
	<th style="width:5px;"></th>
	<?}?>
			<th><?php echo $this->Paginator->sort(__('libelle', true), 'Glossaire.libelle');?></th>

		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<tr class="searchHeader">
<?php
	if($session->read('Auth.User.role')=="administrator") {
?>		<td></td>
	<?}?>
				<td>
			<?php
				echo $this->AlaxosForm->filter_field('libelle');
			?>
		</td>
		
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $alaxosForm->create('Glossaire', array('id' => 'chooseActionForm', 'url' => array('controller' => 'glossaires', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($glossaires as $glossaire):
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
<?php
	if($session->read('Auth.User.role')=="administrator") {
?>
		<td>
		<?php
		echo $alaxosForm->checkBox('Glossaire.' . $i . '.id', array('value' => $glossaire['Glossaire']['id']));
		?>
		</td>
<?}?>

		<td>
			<?php echo $glossaire['Glossaire']['libelle']; ?>
		</td>

		<td class="actions">

			<?php echo $html->link($html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $glossaire['Glossaire']['id']), array('id' => 'detail', 'escape' => false)); ?>
	<?php
	/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
	?>	
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $glossaire['Glossaire']['id']), array('escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $glossaire['Glossaire']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $glossaire['Glossaire']['libelle'])); ?>
<?}?>

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
	/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
	?>	
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
	<?}?>

</div>
