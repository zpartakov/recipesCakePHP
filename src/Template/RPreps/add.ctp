<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List R Preps'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rPreps form large-9 medium-8 columns content">
    <?= $this->Form->create($rPrep) ?>
    <fieldset>
        <legend><?= __('Add R Prep') ?></legend>
        <?php
            echo $this->Form->input('recette_id', ['options' => $recettes]);
            echo $this->Form->input('prep');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
