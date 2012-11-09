<?
$this->pageTitle = 'Glossaire - ' .$glossaire['Glossaire']['libelle']; 
echo "<h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1>";
?>
<div class="glossaires view">
		<?php
	/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
	?>	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $glossaire['Glossaire']['id'], 'delete_id' => $glossaire['Glossaire']['id'], 'delete_text' => ___('do you really want to delete this glossaire ?', true)));
	?>
<?}?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('libellé'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['libelle']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('définition1'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['definition1']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('définition2'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['definition2']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('définition3'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['definition3']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('définition4'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['definition4']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('source'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['source']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('type'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $glossaire['Glossaire']['type']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('image'); ?>
		</td>
		<td>:</td>
		<td>
			<?php 
			if(strlen($glossaire['Glossaire']['image'])>0) {
		echo $html->image('ustensile/'.$glossaire['Glossaire']['image'], array("alt"=>"image"));?>
		}
			 ?>
		</td>
	</tr>
	</table>
</div>
<?
echo "<h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1>";
?>
