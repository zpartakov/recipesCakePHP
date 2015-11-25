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
            <td style="<?php echo $lestyle; ?>"><?= h($restaurant->email) ?></td>
            <td style="<?php echo $lestyle; ?>"><?= h($restaurant->url) ?></td>
            <td style="<?php echo $lestyle; ?>"><?= h($restaurant->zip) ?></td>
            <td><?= h($restaurant->ville) ?></td>
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