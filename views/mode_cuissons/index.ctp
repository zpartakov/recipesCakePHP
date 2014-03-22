<?
$this->pageTitle = 'Modes de cuisson'; 
?>
<!-- begin search form -->
<div class="Post">
 <table>
	 <tr>
		 <td>
<?php echo $form->create('ModeCuisson', array('url' => array('action' => 'index'))); ?>
		<?php echo $form->input('q', array('label' => false, 'size' => '50')); ?>
		</div>
</td><td>
<input type="button" value="Vider" onClick="javascript:vide_recherche('ModeCuissonQ')" />
<input type="submit" value="Chercher" /> 
</td>
</tr>
</table>
</div>
<!-- end search form -->

<div class="modeCuissons index">
	<h2><?php __('Mode Cuissons');?></h2>
	<table cellpadding="0" cellspacing="0">
<?php
	if($session->read('Auth.User.role')=="administrator") {
		
	?>
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('parent');?></th>
			
			<th><?php echo $this->Paginator->sort('lib');?></th>
			<th><?php echo $this->Paginator->sort('rem');?></th>
						<th><?php echo $this->Paginator->sort('Image','img');?></th>
						<th class="actions"><?php __('Actions');?></th>
	</tr>
<?php 
	}
?>			
	<?php
	$i = 0;
	foreach ($modeCuissons as $modeCuisson):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<?php
	if($session->read('Auth.User.role')=="administrator") {
		
	?>
		<td><?php echo $modeCuisson['ModeCuisson']['id']; ?>&nbsp;</td>
		<td><?php echo $modeCuisson['ModeCuisson']['parent']; ?>&nbsp;</td>
		<?php 
	}
?>	
		<td><a href="<?php echo CHEMIN ."mode_cuissons/view/" .$modeCuisson['ModeCuisson']['id']; ?>"><?php echo $modeCuisson['ModeCuisson']['lib']; ?></a>&nbsp;</td>
		<td><?php echo $modeCuisson['ModeCuisson']['rem']; ?>&nbsp;</td>
		<td><img style="width: 100px" src="<?php echo CHEMIN."img/glossaire/".$modeCuisson['ModeCuisson']['img']; ?>"></td>
				<?php
	if($session->read('Auth.User.role')=="administrator") {
		
	?>	
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $modeCuisson['ModeCuisson']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $modeCuisson['ModeCuisson']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $modeCuisson['ModeCuisson']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modeCuisson['ModeCuisson']['id'])); ?>
		</td>
		<?php 
	}
?>	
	</tr>
<?php endforeach; ?>
	</table>
<?php
	if($session->read('Auth.User.role')=="administrator") {
		
	?>	
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
	<?php 
	}
?>	
</div>
		<?php
	if($session->read('Auth.User.role')=="administrator") {
		
	?>	
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Mode Cuisson', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php 
	}
?>	