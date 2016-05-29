<?php
$this->set('title', $recette->titre);
if(!$this->Session->read('Auth.User')['role']&&$recette->private=="1" && $_SERVER["HTTP_HOST"]!="localhost"){ //do not display private recipe to non-logged users

echo $this->Html->charset();

	echo "Désolé, cette recette est privée...";
	echo "<p><a href=\"javascript:history.go(-2)\">retour</a>";
	exit;
}
require_once("/var/www/radeff/libs/Zpartakov.php"); //required for external php functions like putz_lignes_vides

if($this->Session->read('Auth.User')['role']!="administrator"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}
?>
<div class="actions columns large-2 medium-3" style="<?php echo $lestyle; ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Recette'), ['action' => 'edit', $recette->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Recette'), ['action' => 'delete', $recette->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recette->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Recettes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recette'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mode Cuissons'), ['controller' => 'ModeCuissons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mode Cuisson'), ['controller' => 'ModeCuissons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Diets'), ['controller' => 'Diets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diet'), ['controller' => 'Diets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recette User'), ['controller' => 'RecetteUser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recette User'), ['controller' => 'RecetteUser', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stats'), ['controller' => 'Stats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stat'), ['controller' => 'Stats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users Tags'), ['controller' => 'UsersTags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Tag'), ['controller' => 'UsersTags', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="recettes view large-10 medium-9 columns">
    <p style="float: right">
		<?php
		/*
		 * is there any image of that recipe?
		 * */
		use Cake\Filesystem\Folder;

		$dir = new Folder(WWW_ROOT . 'img/pics');
		$files = $dir->find($recette->pict, true);
		$nimg=count($files);
		if($nimg==1) {
            echo $this->Html->image('pics/'.$recette->pict);
		}
        ?>
	</p>
    <div class="row">
        <div class="large-5 columns strings">

            <h6 class="subheader"><?= __('Type') ?></h6>

				<?php
					echo $this->Text->autoParagraph(h($recette->type->name));
				?>

            <h6 class="subheader"><?= __('Mode de Cuisson') ?></h6>

				<?php
					echo $this->Text->autoParagraph(h($recette->mode_cuisson->lib));

				?>

            <h6 class="subheader"><?= __('Régime') ?></h6>
            				<?php
					echo $this->Text->autoParagraph(h($recette->diet->lib));

				?>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Nombre de personnes') ?></h6>
            <p><?= $this->Number->format($recette->pers) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date') ?></h6>
            <p><?php
            $date=$recette->date;
            $date=preg_replace("/ .*/","",$date);
            echo $date;
             ?></p>
			<p>
        	<h6 class="subheader"><?= __('Pays d\'origine') ?></h6>
            <?= $this->Text->autoParagraph(h($recette->prov)) ?>
            <h6 class="subheader"><?= __('Temps') ?></h6>
            <?= $this->Text->autoParagraph(h($recette->temps)) ?>
            </p>
        </div>
        <div class="large-2 columns booleans end" style="<?php echo $lestyle; ?>">
            <h6 class="subheader"><?= __('Private') ?></h6>
            <p><?= $recette->private ? __('Yes') : __('No'); ?></p>
        </div>

    <div class="row texts">
        <div class="columns large-9">
            <strong><?= __('Ingrédients') ?></strong>
            <div style="font-style: italic"><?php
			$ingredients=$recette->r_ingr->ingr;
			$ingredients=html_entity_decode($ingredients);
            //$ingredients=preg_replace("/-/","<br />-", $ingredients);
			//$ingredients=stripslashes($ingredients);
            //putz_lignes_vides($ingredients);
            echo nl2br($ingredients);
             ?></div>
        </div>
    </div>

    <div class="row texts">
        <div class="columns large-9">
            <strong><?= __('Préparation') ?></strong>
            <?php
			$preparation=$recette->r_prep->prep;
			$preparation=html_entity_decode($preparation);
			$preparation = $this->Text->autoLink($preparation);
            $preparation=html_entity_decode($preparation);
            $preparation=preg_replace("/[\n\r ]-/","<br />-", $preparation);
            echo nl2br($preparation);
            //putz_lignes_vides($preparation);
			?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><strong><?= __('Source') ?></strong></h6>
            <?php
            $zesource=$recette->source;
            $source=$this->Text->autoParagraph(h($recette->source));
            $source=$this->Text->autolink($source);
            $source=html_entity_decode($source);
            echo $source;
             ?>
        </div>
    </div>
    <div class="row texts">
		<div class="copyleft">
		Recette Fred Radeff / radeff.red, publiée sous
		<?php
		echo '<a target="_blank" href="http://creativecommons.org/licenses/by-sa/2.0/fr/">';
		echo $this->Html->image('copyleft.jpg', array("alt"=>"GPL License / CopyLeft","title"=>"GPL License / CopyLeft","width"=>"15","height"=>"15"));
		echo '</a>';
		?> licence libre.
		<br />Vous pouvez reproduire cette recette, à condition de:
		<ul style="margin-top: 5px; font-size: 11px; ">
			<li>la recopier intégralement</li>
			<li>mentionner les sources:
			<ul style="margin-top: 5px; font-size: 11px; ">
			 <li><?php echo $zesource;?></span></li>
			 <li>http://radeff.red<?php  echo $_SERVER["REQUEST_URI"];?></li>
			 </ul>
			<li>la partager dans les mêmes conditions</li>
		</ul>
		</div>
	</div>
</div>


<!-- EXPERIMENTAL STUFF TO IGNORE -->

<div class="related row" style="<?php echo $lestyle; ?>">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Comments') ?></h4>
    <?php if (!empty($recette->comments)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Text') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($recette->comments as $comments): ?>
        <tr>
            <td><?= h($comments->id) ?></td>
            <td><?= h($comments->recette_id) ?></td>
            <td><?= h($comments->name) ?></td>
            <td><?= h($comments->email) ?></td>
            <td><?= h($comments->text) ?></td>
            <td><?= h($comments->created) ?></td>

            <td class="actions" style="<?php echo $lestyle; ?>">
                <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row"  style="<?php echo $lestyle; ?>">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Menus') ?></h4>
    <?php if (!empty($recette->menus)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Identifiantmenu') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('Rem') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($recette->menus as $menus): ?>
        <tr>
            <td><?= h($menus->id) ?></td>
            <td><?= h($menus->identifiantmenu) ?></td>
            <td><?= h($menus->recette_id) ?></td>
            <td><?= h($menus->rem) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $menus->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $menus->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $menus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menus->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row"  style="<?php echo $lestyle; ?>">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Recette User') ?></h4>
    <?php if (!empty($recette->recette_user)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($recette->recette_user as $recetteUser): ?>
        <tr>
            <td><?= h($recetteUser->id) ?></td>
            <td><?= h($recetteUser->recette_id) ?></td>
            <td><?= h($recetteUser->user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'RecetteUser', 'action' => 'view', $recetteUser->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'RecetteUser', 'action' => 'edit', $recetteUser->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RecetteUser', 'action' => 'delete', $recetteUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recetteUser->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row"  style="<?php echo $lestyle; ?>">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Stats') ?></h4>
    <?php if (!empty($recette->stats)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Ip') ?></th>
            <th><?= __('Date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($recette->stats as $stats): ?>
        <tr>
            <td><?= h($stats->id) ?></td>
            <td><?= h($stats->recette_id) ?></td>
            <td><?= h($stats->user_id) ?></td>
            <td><?= h($stats->ip) ?></td>
            <td><?= h($stats->date) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Stats', 'action' => 'view', $stats->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Stats', 'action' => 'edit', $stats->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stats', 'action' => 'delete', $stats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stats->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row" style="<?php echo $lestyle; ?>">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Users Tags') ?></h4>
    <?php if (!empty($recette->users_tags)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('Tag Id') ?></th>
            <th><?= __('Note') ?></th>
            <th><?= __('Datein') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($recette->users_tags as $usersTags): ?>
        <tr>
            <td><?= h($usersTags->id) ?></td>
            <td><?= h($usersTags->user_id) ?></td>
            <td><?= h($usersTags->recette_id) ?></td>
            <td><?= h($usersTags->tag_id) ?></td>
            <td><?= h($usersTags->note) ?></td>
            <td><?= h($usersTags->datein) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'UsersTags', 'action' => 'view', $usersTags->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'UsersTags', 'action' => 'edit', $usersTags->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UsersTags', 'action' => 'delete', $usersTags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersTags->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row" style="<?php echo $lestyle; ?>">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tags') ?></h4>
    <?php if (!empty($recette->tags)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Lib') ?></th>
            <th><?= __('Datein') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($recette->tags as $tags): ?>
        <tr>
            <td><?= h($tags->id) ?></td>
            <td><?= h($tags->lib) ?></td>
            <td><?= h($tags->datein) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
