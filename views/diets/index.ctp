<?php 
$this->pageTitle="Régimes";
?>
<div class="diets index">
	<h2>Régimes</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('lib');?></th>
			<th><?php echo $this->Paginator->sort('rem');?></th>
			<th><?php echo $this->Paginator->sort('date_mod');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($diets as $diet):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $diet['Diet']['id']; ?>&nbsp;</td>
		<td><?php echo $diet['Diet']['lib']; ?>&nbsp;</td>
		<td><?php echo $diet['Diet']['rem']; ?>&nbsp;</td>
		<td><?php echo $diet['Diet']['date_mod']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $diet['Diet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $diet['Diet']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $diet['Diet']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $diet['Diet']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nouveau régime', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Recettes', true), array('controller' => 'recettes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nouvelle Recette', true), array('controller' => 'recettes', 'action' => 'add')); ?> </li>
	</ul>
</div>