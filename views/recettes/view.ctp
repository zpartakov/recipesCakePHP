<script type="text/javascript">
$(function(){
$('.tags-input input').tagsInput();
});
</script>
<?php
App::import('Lib', 'functions'); //imports app/libs/functions

//stats($recette['Recette']['id']);

/*anti-hack private*/
if($session->read('Auth.User.role')=="member"||$session->read('Auth.User.role')=="administrator") {
	} else {
		if($recette['Recette']['private']=="1") {
			exit;
		}
}


$this->pageTitle = $recette['Recette']['titre']; 

$bgcolor=note($recette['Recette']['time']);
###echo $bgcolor;
?>

<div class="recettes view" style="background-color: <?php echo $bgcolor;?>">
	<?php
		/*	hide from non-admin registred user */
	if($session->read('Auth.User.role')=="administrator") {
	//	if($session->read('Auth.User.role')) {
		
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $recette['Recette']['id'], 'delete_id' => $recette['Recette']['id'], 'delete_text' => ___('do you really want to delete this recette ?', true)));
}
	?>

			
	<table border="0" class="view">

	<tr>
		<td>
			<?php 
			$file = '/var/www/radeff/recettes2/app/webroot/img/pics/'.$recette['Recette']['pict'];
if (file_exists($file)||preg_match("/^http:/",$recette['Recette']['pict'])) {
	if(preg_match("/^http:/",$recette['Recette']['pict'])) { //picture from the web
		echo $html->image($recette['Recette']['pict'], array("alt"=>"Image","style"=>"float: right; width: 300px"));
	} else {
	echo $html->image('pics/'.$recette['Recette']['pict'], array("alt"=>"Image","style"=>"float: right; width: 300px"));
	}
} else {
	//no picture
#	echo $html->image('pics/'.$recette['Recette']['id'] .".jpg", array("alt"=>"Image","style"=>"float: right"));
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
			<?php ___('Note'); ?>
		</td>

		<td>
	<?php echo $recette['Recette']['time']; ?>		</td>
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
			<?php echo "<em>" .lignes_vides($recette['Recette']['ingr'],$recette['Recette']['id']) ."</em>"; ?>
		</td>
	</tr>


	<tr>
		<td>
			<?php ___('Préparation'); ?>
		</td>

		<td>
			<?php echo lignes_vides($recette['Recette']['prep'],$recette['Recette']['id']); ?>
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
			urlize($recette['Recette']['source']);
			//echo "<a href=\"" .$source ."\" target=\"_blank\">" .$recette['Recette']['source'] ."</a>"; 
			?>
			
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


<!--<div style="position: absolute; top: 250px; right: 100px;">-->
<div style="position: relative; top: 25px; margin-bottom: 10px">
	<?php
if($session->read('Auth.User.role')=="administrator") {
    /*
     * print linked recipes
     */
recettes_liees($recette['Recette']['id']);
?>			
			
			<?php echo $this->Form->create('LinkedRecette', array('controller' => 'linked_recettes', 'action' => 'add'));?>
	<div style="position: relative; top: 20px">
	<fieldset>
 		<legend><?php __('Add Linked Recette'); ?></legend>
	<?php
		echo $this->Form->input('recette_id', array("type"=>"hidden","value"=>$recette['Recette']['id']));
		echo $this->Form->input('recettes_id', array("type"=>"text", "label"=>"Recette liée"));
	?>
	</fieldset>
	</div>
<?php echo $this->Form->end(__('Submit', true));?>
	<?
}
?>
</div>
	

<div style="font-size: smaller; color: black; background-color: lightyellow; padding: 12px; margin-right: 10%; margin-left: 10%; margin-bottom: 20px">
<p>
Recette Fred Radeff / akademia.ch, publiée sous <?php echo $html->image('copyleft.jpg', array("alt"=>"GPL License / CopyLeft","title"=>"GPL License / CopyLeft","width"=>"45","height"=>"45"))
?> licence libre.<br />
Vous pouvez reproduire cette recette, à condition de la recopier intégralement, 
de mentionner la source <br/><span style="font-style: italic;">http://radeff.net<?php  echo $_SERVER["REQUEST_URI"];?></span><br/> 
et de la partager dans les mêmes conditions.
</p></div>
