<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Vins Type'), ['action' => 'edit', $vinsType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vins Type'), ['action' => 'delete', $vinsType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vinsType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vins Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vins Type'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="vinsTypes view large-10 medium-9 columns">
    <h2><?= h($vinsType->libelle) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= h($vinsType->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Libelle') ?></h6>
            <?= $this->Text->autoParagraph(h($vinsType->libelle)) ?>
        </div>
    </div>
</div>
