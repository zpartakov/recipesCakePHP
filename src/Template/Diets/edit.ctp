<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diet->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Diets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recettes00'), ['controller' => 'Recettes00', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recettes00'), ['controller' => 'Recettes00', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="diets form large-10 medium-9 columns">
    <?= $this->Form->create($diet) ?>
    <fieldset>
        <legend><?= __('Edit Diet') ?></legend>
        <?php
            echo $this->Form->input('lib');
            echo $this->Form->input('rem');
            echo $this->Form->input('date_mod');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
