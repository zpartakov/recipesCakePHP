<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Diet'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recettes00'), ['controller' => 'Recettes00', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recettes00'), ['controller' => 'Recettes00', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="diets index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('lib') ?></th>
            <th><?= $this->Paginator->sort('date_mod') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($diets as $diet): ?>
        <tr>
            <td><?= $this->Number->format($diet->id) ?></td>
            <td><?= h($diet->lib) ?></td>
            <td><?= h($diet->date_mod) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $diet->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diet->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diet->id)]) ?>
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
