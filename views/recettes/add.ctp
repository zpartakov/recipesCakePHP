<?
$this->pageTitle = "Ajouter une recette"; 
$largeur_champs_text=50;
$largeur_champs_textarea=60;
$hauteur_champs_textarea=5;
#infos from previous entry
	$sqltl="SELECT * FROM recettes ORDER BY id DESC LIMIT 0,1";
	$result = mysql_query($sqltl); 
	testsql($result);
?>
<style>
* {
	font-size: small;
	}
</style>
<div class="recettes form">

	<?php echo $this->AlaxosForm->create('Recette', array('enctype' => 'multipart/form-data'));?>
<!-- a main table to see all on one page -->
<table>
	<tr>
		<td> 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td colspan="2">
			<?php ___('titre') ?>
<br>
			<?php echo $this->AlaxosForm->input('titre', array('size'=>$largeur_champs_text, 'label' => false)); ?>
		</td>
	</tr>	
	<tr>


		<td>
			<?php ___('temps') ?>
<br>
			<?php echo $this->AlaxosForm->input('temps', array('type'=>'text', 'size'=>20, 'label' => false, 'value'=>'30')); ?>
<br>
			<?php ___('personnes') ?>
<br>
			<?php echo $this->AlaxosForm->input('pers', array('label' => false, 'size'=>20, 'value'=>'6')); ?>
		</td>
				<td>
			<?php ___('Pays') ?>
		<br>
		<?
      addpays();
      ?>
		</td>
	</tr>
		<tr>
		<td>
			<?php ___('type') ?>
		</td>
		<td>
			<?php 
			addtypes();
			#echo $this->AlaxosForm->input('type_id', array('label' => false)); 
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php ___('ingrédients') ?>
<br>
			<?php 
			echo $this->AlaxosForm->input('ingr', array('label' => false, 'rows'=> $hauteur_champs_textarea, 'cols'=> $largeur_champs_textarea));   
			?>
		</td>
	</tr>
</table>
 </td>
		<td>
		<table>
	<tr>
		<td colspan="2">
			<?php ___('Préparation') ?>
<br>
			<?php echo $this->AlaxosForm->input('prep', array('label' => false,'rows'=> $hauteur_champs_textarea,'cols'=> $largeur_champs_textarea)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('date', array('label' => false,'value'=>date("Y-m-d"))); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('source') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('source', array('type'=>'text','size'=>$largeur_champs_text,'label' => false, 'value'=>mysql_result($result,0,'source'), 'size'=>'25')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('Image') ?>
		</td>
		<td>
			<?php 
			//renvoyer le dernier id
	$lastid= 1+mysql_result($result,0,'id').".jpg";
			echo $this->AlaxosForm->input('pict', array('type'=>'text','size'=>'10', 'label' => false, 'value' => $lastid)); ?>
			<?echo $form->file('Recette.image');?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('Privé?') ?>
		</td>
		<td>
		
		<div class="input checkbox">
		<input type="hidden" name="data[Recette][private]" id="RecettePrivate_" value="0" />
		<input type="checkbox" name="data[Recette][private]" value="1" id="RecettePrivate" checked /></div>
			<?php #echo $this->AlaxosForm->input('private', array('label' => false)); ?>
			&nbsp;			 		</td>

		</td>
	</tr>
	</table>
		 </td>
		 <td><?php echo $this->AlaxosForm->end(___('submit', true)); ?></td>
	</tr>
</table>	




</div>
