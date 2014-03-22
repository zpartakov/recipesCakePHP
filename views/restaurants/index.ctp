<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Restaurant', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<?
	}
?>
<?
$this->pageTitle = 'Restaurants'; 
?>
<!-- begin search form -->
<div class="Post">
 <table>
	 <tr>
		 <td>
<?php echo $form->create('Restaurant', array('url' => array('action' => 'index'))); ?>
		<?php echo $form->input('q', array('label' => false, 'size' => '50')); ?>
		</div>
</td><td>
<input type="button" value="Vider" onClick="javascript:vide_recherche('RestaurantQ')" />
<input type="submit" value="Chercher" /> 
</td>
</tr>
</table>
</div>
<!-- end search form --><div class="restaurants index">
	<h2><?php __('Restaurants');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nom');?></th>
			<th><?php echo $this->Paginator->sort('ville');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<!--<th><?php echo $this->Paginator->sort('Date','created');?></th>-->
	</tr>
	<?php
	$i = 0;
	foreach ($restaurants as $restaurant):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link(__($restaurant['Restaurant']['nom'], true), array('action' => 'view', $restaurant['Restaurant']['id'])); ?></td>
		<td><?php echo $restaurant['Restaurant']['ville']; ?>&nbsp;</td>
		<td><?php echo $restaurant['Restaurant']['type']; ?>&nbsp;</td>
		<!--<td><?php echo $restaurant['Restaurant']['created']; ?>&nbsp;</td>-->
		
			<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $restaurant['Restaurant']['id'])); ?>	<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $restaurant['Restaurant']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restaurant['Restaurant']['id'])); ?>		</td>
			<?
	}
?>

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
<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Restaurant', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<?
	}
?>
