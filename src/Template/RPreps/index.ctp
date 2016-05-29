<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New R Prep'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rPreps index large-9 medium-8 columns content">
    <h3><?= __('R Preps') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('recette_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rPreps as $rPrep): ?>
            <tr>
                <td><?= $this->Number->format($rPrep->id) ?></td>
                <td><?= $rPrep->has('recette') ? $this->Html->link($rPrep->recette->id, ['controller' => 'Recettes', 'action' => 'view', $rPrep->recette->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rPrep->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rPrep->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rPrep->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rPrep->id)]) ?>
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
