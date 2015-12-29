<style>
	.epices {     
	-webkit-column-count: 4; 
	/* Chrome, Safari, Opera */
    -moz-column-count: 4; 
    /* Firefox */
    column-count: 4;
    }
    br {
    content: " ";
    display: none;
}
</style>

<form action='/recettes/epices/' method="get" name="formu"> 
<table>
	<tr>
		<td>
			<input type="text" name="globalsearch" style="width: 350px">
		</td>
		<td>
			<input type="submit" value="chercher">
		</td>
		<td><a href="./">reset</a></td>
	</tr>
</table>
</form>
<?php
$this->set('title', "Liste d'épices, condiments etc.");
if($this->Session->read('Auth.User')['role']!="administrator"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}

use Cake\Filesystem\Folder;
		$dir = new Folder(WWW_ROOT . 'img/pics/epices');
?>
<div class="actions columns large-2 medium-3" style="<?php echo $lestyle; ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Epice'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="epices">
    <?php foreach ($epices as $epice): ?>
            <p style="<?php echo $lestyle; ?>"><?= $this->Number->format($epice->id) ?></p>
            <p>
            <?php
		$files = $dir->find($epice->image, true);
		$nimg=count($files);
		if($nimg==1) {
            echo $this->Html->image('pics/epices/th/'.$epice->image, [
			"alt" => $epice->lib,
			"title" => $epice->lib,
			'url' => ['controller' => 'Epices', 'action' => 'view', $epice->id]
			]);
		}

            ?>
            <br />				<?= $this->Html->link($epice->lib, ['action' => 'view', $epice->id]) 
            
            ?>
			</p>
            <p style="<?php echo $lestyle; ?>">

            <?= h($epice->url) ?></p>
            <p style="<?php echo $lestyle; ?>"><?= h($epice->origine) ?></p>
            <div class="actions" style="<?php echo $lestyle; ?>">
                <?= $this->Html->link(__('View'), ['action' => 'view', $epice->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $epice->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $epice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $epice->id)]) ?>
            </div>
            <hr style="<?php echo $lestyle; ?>"/>

    <?php endforeach; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
