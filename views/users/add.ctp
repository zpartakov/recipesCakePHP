<?php
App::import('Lib', 'functions'); //imports app/libs/functions
?>
<div class="users form">

	<?php echo $this->AlaxosForm->create('User');?>
	
 	<h2><?php ___('add user'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>

<div>	
<hr />
Bonjour,<br/>
<br/>
Voici tes informations pour te connecter sur la face cachée de la lune - mes recettes protégées, il y en a plusieurs milliers et elles sont top, mais je peux pas les publier pour raisons de copyright:<br/>
<br/>
http://radeff.net/recettes2/users/login (en haut à droite du menu)<br/>
<br/>
&nbsp;&nbsp;Utilisateur  :   <? echo $_POST['mail'];?><br/>
&nbsp;&nbsp;Mot de passe :  <? echo generate_password(8); ?><br/>
<br/>
(attention à bien respecter les minuscules/majuscules et à ne pas mettre d'espace avant/après)<br/>
<br/>
Une fois enregistré, regarde p. ex. l'intégrale des magnifiques recettes de Dino Bugialli, star toscane outre-atlantique inconnue ici et dont le livre magnifique est épuisé:
<br/>
http://radeff.net/recettes2/recettes/chercher?chercher=bugialli
<br/>
En plus 95% des nouvelles recettes de mon site vont sur cet intranet, car malheureusement aujourd'hui c'est la tendance sur les sites culinaires, on publie des recettes mais on veut qu'elles soit sous copyright (absurde mais c'est comme ça).<br/><br/>
Merci de garder ces infos pour toi, et bonne cuisine!
</div>




<div>
	<!-- 1st COLUMN -->
			<table border="0" cellpadding="5" cellspacing="0" class="edit">
			<tr>
				<td>
					<?php ___('username') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('username', array('label' => false)); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('password') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('password', array('label' => false, 'value'=>'ta3.14oka')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('email') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('email', array('label' => false)); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('pseudo') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('pseudo', array('label' => false)); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('role') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('role', array('label' => false, 'value'=>'member')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('dateIn') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('dateIn', array('label' => false)); ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
			</tr>
			</table>
</div>

</div>
