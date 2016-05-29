<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit R Ingr'), ['action' => 'edit', $rIngr->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete R Ingr'), ['action' => 'delete', $rIngr->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rIngr->id)]) ?> </li>
        <li><?= $this->Html->link(__('List R Ingrs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New R Ingr'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rIngrs view large-9 medium-8 columns content">
    <h3><?= h($rIngr->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Recette') ?></th>
            <td><?= $rIngr->has('recette') ? $this->Html->link($rIngr->recette->id, ['controller' => 'Recettes', 'action' => 'view', $rIngr->recette->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($rIngr->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Ingr') ?></h4>
        <?= $this->Text->autoParagraph(h($rIngr->ingr)); ?>
    </div>
</div>
