<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Vins Type'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="vinsTypes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($vinsTypes as $vinsType): ?>
        <tr>
            <td><?= h($vinsType->id) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $vinsType->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vinsType->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vinsType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vinsType->id)]) ?>
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
