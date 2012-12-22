<div class="linkedRecettes view">
<h2><?php  __('Linked Recette');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $linkedRecette['LinkedRecette']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Recette'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($linkedRecette['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $linkedRecette['Recette']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Recettes Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $linkedRecette['LinkedRecette']['recettes_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Linked Recette', true), array('action' => 'edit', $linkedRecette['LinkedRecette']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Linked Recette', true), array('action' => 'delete', $linkedRecette['LinkedRecette']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $linkedRecette['LinkedRecette']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Linked Recettes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Linked Recette', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Recettes', true), array('controller' => 'recettes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recette', true), array('controller' => 'recettes', 'action' => 'add')); ?> </li>
	</ul>
</div>
