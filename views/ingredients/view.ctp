<?
$this->pageTitle = 'Ingrédient - ' .$ingredient['Ingredient']['libelle']; 
echo "<h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1>";

?>
<div class="ingredients view">
	
	
		<?php
	/*	hide from non-admin registred user */
if($session->read('Auth.User.role')=="administrator") {
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $ingredient['Ingredient']['id'], 'delete_id' => $ingredient['Ingredient']['id'], 'delete_text' => ___('do you really want to delete this ingredient ?', true)));
}
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('libelle'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['libelle']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('typ'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['typ']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unit'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['unit']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kcal'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['kcal']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('price'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['price']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('img'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['img']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('commissions'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $ingredient['Ingredient']['commissions']; ?>
		</td>
	</tr>
	</table>
</div>
<?
echo "<h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1>";
?>
