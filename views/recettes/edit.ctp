<?
$this->pageTitle = "Modifier une recette"; 
$largeur_champs_text=50;
$largeur_champs_textarea=60;
$hauteur_champs_textarea=20;
?>
<div class="recettes form">

	<?php echo $this->AlaxosForm->create('Recette');?>
	<?php echo $this->AlaxosForm->input('id'); ?>	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $recette['Recette']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('titre') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('titre', array('type'=>'text', 'size'=>$largeur_champs_text, 'label' => false)); ?>
		</td>
	</tr>	
	<tr>
		<td>
			<?php ___('Pays') ?>
<br>
			<?php echo $this->AlaxosForm->input('prov', array('type'=>'text', 'size'=>20, 'label' => false)); ?>
		</td>

		<td>
			<?php ___('temps') ?>
<br>

			<?php echo $this->AlaxosForm->input('temps', array('type'=>'text', 'size'=>$largeur_champs_text, 'label' => false)); ?>
		
					<?php ___('personnes') ?>
<br>

			<?php echo $this->AlaxosForm->input('pers', array('type'=>'text', 'size'=>$largeur_champs_text, 'label' => false)); ?>

		</td>
	</tr>
	<tr>
		<td>
			<?php ___('Ingrédients') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('ingr', array('label' => false, 'rows'=> $hauteur_champs_textarea, 'cols'=> $largeur_champs_textarea)); ?>
		</td>
	</tr>


	<tr>
		<td>
			<?php ___('type') ?>
		</td>

		<td>
			<?php 
						addtypes();

			#echo $this->AlaxosForm->input('type_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('Préparation') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('prep', array('label' => false,'rows'=> $hauteur_champs_textarea,'cols'=> $largeur_champs_textarea)); ?>

		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('date', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('source') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('source', array('type'=>'text', 'size'=>$largeur_champs_text, 'label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('pict') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('pict', array('type'=>'text', 'size'=>$largeur_champs_text, 'label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('private') ?>
		</td>

		<td>
			<?php echo $this->AlaxosForm->input('private', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('update', true)); ?> 		</td>
 	</tr>
	</table>

</div>
