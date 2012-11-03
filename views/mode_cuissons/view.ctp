<div class="modeCuissons view">
<h2><?php  __('Mode Cuisson');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modeCuisson['ModeCuisson']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modeCuisson['ModeCuisson']['parent']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lib'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modeCuisson['ModeCuisson']['lib']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modeCuisson['ModeCuisson']['rem']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mode Cuisson', true), array('action' => 'edit', $modeCuisson['ModeCuisson']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Mode Cuisson', true), array('action' => 'delete', $modeCuisson['ModeCuisson']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modeCuisson['ModeCuisson']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mode Cuissons', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mode Cuisson', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
