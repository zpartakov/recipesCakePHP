<?php
stats($recette['Recette']['id']);

/*anti-hack private*/
if($session->read('Auth.User.role')=="member"||$session->read('Auth.User.role')=="administrator") {
	} else {
		if($recette['Recette']['private']=="1") {
			exit;
		}
}



$this->pageTitle = $recette['Recette']['titre']; 
echo "<div class=\"retour\"><h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1></div>";
?>

<div class="recettes view">
	
	<?php
		/*	hide from non-admin registred user */
	if($session->read('Auth.User.role')=="administrator") {
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $recette['Recette']['id'], 'delete_id' => $recette['Recette']['id'], 'delete_text' => ___('do you really want to delete this recette ?', true)));
}
	?>

			
	<table border="0" class="view">

	<tr>
		<td>
			<?php 
			
if(strlen($recette['Recette']['pict']>0)) {
	echo $html->image('pics/'.$recette['Recette']['pict'], array("alt"=>"Image","style"=>"float: right"));
} else {
	echo $html->image('pics/'.$recette['Recette']['id'] .".jpg", array("alt"=>"Image","style"=>"float: right"));
}
 ?>
		</td>
		<td>
			<h1><?php echo $recette['Recette']['titre']; ?></h1>
		</td>
	</tr>
		<tr>
		<td>
			<?php ___('Type'); ?>
		</td>

		<td>
	<?php le_type_lib($recette['Recette']['type_id']); ?>		</td>
		</tr>
			<tr>
		<td>
			<?php ___('Mode de cuisson'); ?>
		</td>

		<td>
				<?php modecuisson($recette['Recette']['mode_cuisson_id']); ?>
		</td>
		</tr>
	
	
		<tr>


		<td>
			<?php ___('Provenance'); ?>
		</td>

		<td>
			<?php echo $recette['Recette']['prov']; ?>
		</td>
	</tr>
	<?
	if(strlen($recette['Recette']['temps'])>0) {
	?>
	<tr>
		<td>
			<?php ___('temps'); ?>
		</td>

		<td>
			<?php echo $recette['Recette']['temps']; ?>
		</td>
	</tr>
	<?
	}
	?>
	<?
	if(strlen($recette['Recette']['pers'])>0&&$recette['Recette']['pers']!=0) {
	?>	<tr>
		<td>
			<?php ___('Personnes'); ?>
		</td>

		<td>
			<?php echo $recette['Recette']['pers']; ?>
		</td>
	</tr>
	<?
	}
	?>
	<tr>
		<td>
			<?php ___('Ingrédients'); ?>
		</td>

		<td>
			<?php echo "<em>" .stripslashes(stripslashes(nl2br($recette['Recette']['ingr']))) ."</em>"; ?>
		</td>
	</tr>


	<tr>
		<td>
			<?php ___('Préparation'); ?>
		</td>

		<td>
			<?php echo stripslashes(stripslashes(nl2br($recette['Recette']['prep']))); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date'); ?>
		</td>

		<td>
			<?php 
			#echo DateTool :: sql_to_date($recette['Recette']['date']);
			echo datetime2fr($recette['Recette']['date']);
			
			 ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php ___('source'); ?>
		</td>
		<td>
			<?php 
			$source=$recette['Recette']['source'];
			if(preg_match("/Radeff/",$source)) {
				$source="/recettes2/recettes/chercher?source=radeff";
			}
			
			echo "<a href=\"" .$source ."\" target=\"_blank\">" .$recette['Recette']['source'] ."</a>"; ?>
		</td>
	</tr>
	<tr class="permalink">
	<td>Permalink</td>
	<td><? echo "http://" .$_SERVER["HTTP_HOST"] ."/" .$_REQUEST["url"];?></td>
	</tr>
	<?
if($session->read('Auth.User.role')) {
	?>
	<tr>
		<td>
			<?php ___('private'); ?>
		</td>

		<td>
			<?php
			echo $alaxosHtml->get_yes_no($recette['Recette']['private']);
			?>
		</td>
	</tr>
	
	<tr>
		<td>
			<dl>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mode Cuisson'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $recette['Recette']['time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Difficulty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $recette['Recette']['difficulty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $recette['Recette']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Diet'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($recette['Diet']['lib'], array('controller' => 'diets', 'action' => 'view', $recette['Diet']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
	</td>
	</tr>
	<?
}
?>
	</table>
</div>



<div class="retour">
<?
echo "<h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1>";
?>
</div>
<?php
#echo phpinfo();
?>
