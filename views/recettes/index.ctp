	<?php
	if($session->read('Auth.User.role')=="administrator") {

	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
}
	?>
	<div class="recettes index">
 	<table cellspacing="0" class="administration">
		<tr class="sortHeader">
		<th><?php echo $this->Paginator->sort(__('titre', true), 'Recette.titre');?></th>
		<th><?php echo $this->Paginator->sort(__('Provenance', true), 'Recette.prov');?></th>
		<th><?php echo $this->Paginator->sort(__('date', true), 'Recette.date');?></th>
	</tr>
	
	
	<?php
	$i = 0;
	foreach ($recettes as $recette):
	
	
	
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

		<td>
			<?php echo "<a href=\"" .CHEMIN ."recettes/view/" .$recette['Recette']['id']."\" class=\"".$class."\">" .ucfirst($recette['Recette']['titre']) ."</a>"; ?>
		</td>
		<td>
			<?php echo $recette['Recette']['prov']; ?>
		</td>	
		<td>
			<?php echo $recette['Recette']['date']; ?>
		</td>
	</tr>
<?php 

endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 |
	 	<?php echo $this->Paginator->numbers();?>	 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	
	
</div>
