<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rIngr->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rIngr->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List R Ingrs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rIngrs form large-9 medium-8 columns content">
    <?= $this->Form->create($rIngr) ?>
    <fieldset>
        <legend><?= __('Edit R Ingr') ?></legend>
        <?php
            echo $this->Form->input('recette_id', ['options' => $recettes]);
            echo $this->Form->input('ingr');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
