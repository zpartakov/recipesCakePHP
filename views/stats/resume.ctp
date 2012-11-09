<?
$this->pageTitle = "Statistiques de consultation des recettes"; 
#debug($stats);
#debug($recettes);
    #[157] => SALADE AU YAOURT

//only show to registred users
if($session->read('Auth.User.role')) {
	#debug($mystats);
?>
<h2><a href="#mystats">Mes statistiques</a><br>
<a href="#stats">Statistiques globales</a></h2>
<a name="mystats"></a>
<h1>Mes statistiques</h1>
<div class="mystats index">
	

    
	<table cellspacing="0" class="administration">
	
	<tr class="searchHeader">
		<th>Hits</th>
			<th>
			Recette
		</th>
	</tr>
	
	<?php
	$i = 0;
	foreach ($mystats as $mystat):
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
			<?php echo $mystat['0']['hits']; ?>

		</td>
		<td>
			<?php #echo $this->Html->link($mystat['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $mystat['stat']['recette_id'])); ?>
			<?php #echo $this->Html->link($mystat['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $mystat['Recette']['id'])); ?>
			<?php echo "<a href=\"/recettes2/recettes/view/" .$mystat['stats']['recette_id'] ."\">"; ?>
			<?php #echo $mystat['recettes'][$mystat['mystats']['recette_id']]; ?>
			<?php echo titre_recette($mystat['stats']['recette_id']); 
			echo "</a>";
			?>
			

		</td>
	</tr>
<?php endforeach; ?>
	</table>


	
	
	
</div>

<hr>
<?
}
/* 
 * END MY STATS
 * ##################################################################
 * */
?>
<a name="stats"></a>
<h1>Statistiques globales</h1>
<div class="stats index">
	

    
	<table cellspacing="0" class="administration">
	
	<tr class="searchHeader">
		<th>Hits</th>
			<th>
			Recette
		</th>
	</tr>
	
	<?php
	$i = 0;
	foreach ($stats as $stat):
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
			<?php echo $stat['0']['hits']; ?>

		</td>
		<td>
			<?php #echo $this->Html->link($stat['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $stat['stat']['recette_id'])); ?>
			<?php #echo $this->Html->link($stat['Recette']['titre'], array('controller' => 'recettes', 'action' => 'view', $stat['Recette']['id'])); ?>
			<?php echo "<a href=\"/recettes2/recettes/view/" .$stat['stats']['recette_id'] ."\">"; ?>
			<?php #echo $stat['recettes'][$stat['stats']['recette_id']]; ?>
			<?php echo titre_recette($stat['stats']['recette_id']); 
			echo "</a>";
			?>
			

		</td>
	</tr>
<?php endforeach; ?>
	</table>


	
	
	
</div>
