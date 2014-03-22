<?
$this->pageTitle = 'Blog'; 
?>
<!-- begin search form -->
<div class="Post">
 <table>
	 <tr>
		 <td>
<?php echo $form->create('Post', array('url' => array('action' => 'index'))); ?>
		<?php echo $form->input('q', array('label' => false, 'size' => '50')); ?>
		</div>
</td><td>
<input type="button" value="Vider" onClick="javascript:vide_recherche('PostQ')" />
<input type="submit" value="Chercher" /> 
</td>
</tr>
</table>
</div>
<!-- end search form -->


<div class="posts index">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% de %pages%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<!--<th><?php echo $paginator->sort('id');?></th>-->
	<th><?php echo $paginator->sort('Titre','title');?></th>
	<th><?php echo $paginator->sort('Date','created');?></th>
<!--	<th><?php echo $paginator->sort('modified');?></th>-->
<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>

	<th class="actions"><?php __('Actions');?></th>
<?
	}
?>
	
</tr>
<?php
$i = 0;
foreach ($posts as $post):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php 
			echo "<a href=\"" .CHEMIN ."posts/view/" .$post['Post']['id'] ."\">" .$post['Post']['title'] ."</a>"; ?>
		</td>
		<td>
			<?php echo $post['Post']['created']; ?>
		</td>
<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>

		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id'])); ?>
		</td>
<?
	}
?>

	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('précédent', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('suivant', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<?php
############## ADMIN AREA ##################
/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Post', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<?
	}
?>
