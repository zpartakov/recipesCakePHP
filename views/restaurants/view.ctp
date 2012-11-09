<style>
* {font-size: 13px;}
</style>
<?
$this->pageTitle = 'Restaurant "' .$restaurant['Restaurant']['nom'] .'"'; 
?>
<div class="restaurants view">
<h2><?php  __('Restaurant "');?><? echo $restaurant['Restaurant']['nom'];?>"</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Adresse'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo nl2br($restaurant['Restaurant']['adresse']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['tel']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<a href="mailto:<?php echo $restaurant['Restaurant']['email']; ?>"><?php echo $restaurant['Restaurant']['email']; ?></a>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<a href="<?php echo $restaurant['Restaurant']['url']; ?>" target="_blank"><?php echo $restaurant['Restaurant']['url']; ?></a>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['zip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ville'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['ville']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pays'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['pays']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remarques'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo nl2br($restaurant['Restaurant']['rem']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Créé'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurant['Restaurant']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
			<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Restaurant', true), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Restaurant', true), array('action' => 'delete', $restaurant['Restaurant']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restaurant['Restaurant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurants', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
			<?
	}
?>
