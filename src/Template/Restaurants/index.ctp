<?php
$this->set('title', "Liste de restaurants");

if($this->Session->read('Auth.User')['role']!="administrator"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}
?>
<form action='/recettes/restaurants/' method="get" name="formu">
<table>
	<tr>
		<td>
			<input type="text" name="globalsearch" style="width: 350px">
		</td>
		<td>
			<input type="submit" value="chercher">
	</td>
	</tr>
</table>
</form>

<div class="actions columns large-2 medium-3" style="<?php echo $lestyle; ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Restaurant'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="restaurants index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th style="<?php echo $lestyle; ?>"><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('nom') ?></th>
            <th><?= $this->Paginator->sort('tel') ?></th>
            <th><?= $this->Paginator->sort('type') ?></th>
            <th style="<?php echo $lestyle; ?>"><?= $this->Paginator->sort('email') ?></th>
            <th style="<?php echo $lestyle; ?>"><?= $this->Paginator->sort('url') ?></th>
            <th style="<?php echo $lestyle; ?>"><?= $this->Paginator->sort('zip') ?></th>
            <th><?= $this->Paginator->sort('ville') ?></th>
            <th class="actions" style="<?php echo $lestyle; ?>"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($restaurants as $restaurant): ?>
        <tr>
            <td style="<?php echo $lestyle; ?>"><?= $this->Number->format($restaurant->id) ?></td>
            <td>
            <?= $this->Html->link($restaurant->nom, ['action' => 'view', $restaurant->id]) ?>
            </td>
            <td><?= h($restaurant->tel) ?></td>
            <td><?= h($restaurant->type) ?></td>
            <td style="<?php echo $lestyle; ?>">
            <?php
            //email
				if(strlen($restaurant->email)>0){
					echo "<a title=\"mail\" href=\"mailto:" .$restaurant->email ."\">";
					?>
						<img src="/recettes/img/mail.png" style="width: 25px" alt="email" />
					<?php
					echo "</a>";
				}
            ?>
            </td>
            <td style="<?php echo $lestyle; ?>">
			<?php
            //url
				if(strlen($restaurant->url)>0){
					echo "<a title=\"website\" href=\"" .$restaurant->url ."\">";
					?>
						<img src="/recettes/img/illo-16.jpg" style="width: 25px" alt="website" />
					<?php
					echo "</a>";
				}
            ?>
			</td>
            <td style="<?php echo $lestyle; ?>"><?= h($restaurant->zip) ?></td>
            <td>
			<?php
						echo $restaurant->ville;

			//geolocalisation
			if(strlen($restaurant->gps)>0){
			echo "&nbsp;<a target=\"_blank\" href=\"http://www.openstreetmap.org/#map=18/";
			echo trim($restaurant->gps) ."\">";
					?>
						<img src="/recettes/img/local-seo-icon.png" style="width: 25px" alt="GPS" />
					<?php
					echo "</a>";
			}
			?>

			</td>


            <td class="actions" style="<?php echo $lestyle; ?>">
                <?= $this->Html->link(__('View'), ['action' => 'view', $restaurant->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurant->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
