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

	<?
if($session->read('Auth.User.role')) {
	?>
	<?php echo $form->create('Comment',array('url'=>array('controller'=>'comments','action'=>'add',$post['Recette']['id'])));?>
    <fieldset>
        <legend><?php __('Ajouter un commentaire');?></legend>
        <input type="hidden" name="data[Comment][recette_id]" value="<?php echo $recette['Recette']['id']?>">
            <?php    
        echo $form->input('Comment.name', array( 'label' => 'Nom'));
        echo $form->input('Comment.email', array( 'label' => 'Courriel'));
        echo $form->input('Comment.text', array( 'label' => 'Commentaire'));
        echo $this->Form->input('captcha');
        
    ?>
    <em>Note: votre email ne sera pas affiché</em>
    </fieldset>
    <img id="captcha" src="<?php echo $this->Html->url('/comments/captcha_image');?>" alt="" />
<a href="javascript:void(0);" onclick="javascript:document.images.captcha.src='<?php echo $this->Html->url("/comments/captcha_image");?>?' + Math.round(Math.random(0)*1000)+1" >Reset</a>
    
<?php echo $form->end('Enregistrer votre commentaire');?>
<?php 
}
?>

<?php 
echo "<h2>Commentaires</h2>";
foreach ( $comment[ 'Comment' ] as $commentaire ){

	//output the 'text' field of a 'comment' object
	echo "<em>" .$commentaire[ 'text' ] ."</em>";
	echo "<br/>";
	echo "Date: " .$commentaire[ 'created' ];
	echo "<br/>";
	echo "Auteur: " .$commentaire[ 'name' ];
	echo "<hr/>";
}


?>
	
	</div>



<div class="retour">
<?
echo "<h1><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a></h1>";
?>
</div>
<?php
#echo phpinfo();
if($session->read('Auth.User.role')=="administrator") {

	echo '
	<h2>Tags</h2>
	<form id="UsersTagAddForm" method="post" action="/recettes2/users_tags/add" accept-charset="utf-8">
	<div style="display:none;">
	<input type="hidden" name="_method" value="POST" />
	<input type="hidden" name="data[UsersTag][user_id]" value="6" />
	<input type="hidden" name="data[UsersTag][recette_id]" value="' .$recette['Recette']['id'] .'" />
	<input type="hidden" name="data[UsersTag][datein]" value="' .date("Y-m-d H:i:s").'" />
	</div>
	
	<div>
	<select name="data[UsersTag][tag_id]" id="UsersTagTagId">';

	$sql="SELECT * FROM tags ORDER BY lib";
	$sql=mysql_query($sql);
	$i=0;
	while($i<mysql_num_rows($sql)) {
		echo '<option value="' .mysql_result($sql,$i,'id') .'">' .mysql_result($sql,$i,'lib') .'</option>';
	$i++;
	}

echo '	</select>
	</div>
	<div class="input textarea">
	<label for="UsersTagNote">Note</label><textarea name="data[UsersTag][note]" cols="30" rows="6" id="UsersTagNote" ></textarea></div>
	
	<div class="submit"><input type="submit" value="Submit" /></div></form></div>
    ';
}
?>
