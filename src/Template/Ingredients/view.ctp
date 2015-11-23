<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Ingredient'), ['action' => 'edit', $ingredient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ingredient'), ['action' => 'delete', $ingredient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ingredients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ingredient'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="ingredients view large-10 medium-9 columns">
    <h2><?= h($ingredient->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Libelle') ?></h6>
            <p><?= h($ingredient->libelle) ?></p>
            <h6 class="subheader"><?= __('Unit') ?></h6>
            <p><?= h($ingredient->unit) ?></p>
            <h6 class="subheader"><?= __('Img') ?></h6>
            <p><?= h($ingredient->img) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($ingredient->id) ?></p>
            <h6 class="subheader"><?= __('Kcal') ?></h6>
            <p><?= $this->Number->format($ingredient->kcal) ?></p>
            <h6 class="subheader"><?= __('Price') ?></h6>
            <p><?= $this->Number->format($ingredient->price) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Typ') ?></h6>
            <?= $this->Text->autoParagraph(h($ingredient->typ)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Commissions') ?></h6>
            <?= $this->Text->autoParagraph(h($ingredient->commissions)) ?>
        </div>
    </div>
</div>
