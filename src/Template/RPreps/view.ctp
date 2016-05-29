<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit R Prep'), ['action' => 'edit', $rPrep->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete R Prep'), ['action' => 'delete', $rPrep->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rPrep->id)]) ?> </li>
        <li><?= $this->Html->link(__('List R Preps'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New R Prep'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rPreps view large-9 medium-8 columns content">
    <h3><?= h($rPrep->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Recette') ?></th>
            <td><?= $rPrep->has('recette') ? $this->Html->link($rPrep->recette->id, ['controller' => 'Recettes', 'action' => 'view', $rPrep->recette->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($rPrep->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Prep') ?></h4>
        <?= $this->Text->autoParagraph(h($rPrep->prep)); ?>
    </div>
</div>
