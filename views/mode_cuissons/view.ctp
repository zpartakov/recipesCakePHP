<?
$this->pageTitle = 'Mode de cuisson: ' .$modeCuisson['ModeCuisson']['lib']; 
?>
<div class="modeCuissons view">
<h2><?php echo $modeCuisson['ModeCuisson']['lib']; ?></h2>
<p style="height: 400px;">
		<img style="float: left; padding: 20px;" src="<?php echo CHEMIN."img/glossaire/".$modeCuisson['ModeCuisson']['img']; ?>">
<span style="font-size: 1.6em"><?php echo $modeCuisson['ModeCuisson']['rem']; ?>
<br/><br/><a href="<?php echo CHEMIN."recettes/chercher?mode_cuisson=".$modeCuisson['ModeCuisson']['id']?>">Voir les recettes utilisant ce mode de cuisson
		</div>
					</p>
	
</div>
<?php
	if($session->read('Auth.User.role')=="administrator") {
		
	?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mode Cuisson', true), array('action' => 'edit', $modeCuisson['ModeCuisson']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Mode Cuisson', true), array('action' => 'delete', $modeCuisson['ModeCuisson']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modeCuisson['ModeCuisson']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mode Cuissons', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mode Cuisson', true), array('action' => 'add')); ?> </li>
	</ul>
</div>

		<?php 
	}
?>