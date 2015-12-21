<?php
$this->set('title', "Liste d'ingrédients de cuisine");

if($this->Session->read('Auth.User')['role']!="administrator"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}

use Cake\Filesystem\Folder;
//use Cake\Filesystem\File; //not mandatory
$dir = new Folder(WWW_ROOT . 'img/pics');

?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Ingredient'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="ingredients index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('libelle') ?></th>
            <th><?= $this->Paginator->sort('unit') ?></th>
            <th><?= $this->Paginator->sort('kcal') ?></th>
            <th><?= $this->Paginator->sort('price') ?></th>
            <th><?= $this->Paginator->sort('img') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($ingredients as $ingredient): ?>
        <tr>
            <td><?= $this->Number->format($ingredient->id) ?></td>
            <td><?= h($ingredient->libelle) ?></td>
            <td><?= h($ingredient->unit) ?></td>
            <td><?= $this->Number->format($ingredient->kcal) ?></td>
            <td><?= $this->Number->format($ingredient->price) ?></td>
            <td><?= h($ingredient->img) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $ingredient->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ingredient->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ingredient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id)]) ?>
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
