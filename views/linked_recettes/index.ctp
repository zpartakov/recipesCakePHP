<?php
	App::import('Lib', 'functions'); //imports app/libs/functions
?>
<div class="linkedRecettes index">
	<h2><?php __('Linked Recettes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('recette_id');?></th>
			<th><?php echo $this->Paginator->sort('recettes_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($linkedRecettes as $linkedRecette):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $linkedRecette['LinkedRecette']['id']; ?>&nbsp;</td>
		<td>
			<?php titre_recette($linkedRecette['LinkedRecette']['recette_id']); ?>
		</td>
		<td><?php titre_recette($linkedRecette['LinkedRecette']['recettes_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $linkedRecette['LinkedRecette']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $linkedRecette['LinkedRecette']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $linkedRecette['LinkedRecette']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $linkedRecette['LinkedRecette']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Linked Recette', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Recettes', true), array('controller' => 'recettes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recette', true), array('controller' => 'recettes', 'action' => 'add')); ?> </li>
	</ul>
</div>
