<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Mode Cuissons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recettes00'), ['controller' => 'Recettes00', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recettes00'), ['controller' => 'Recettes00', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="modeCuissons form large-10 medium-9 columns">
    <?= $this->Form->create($modeCuisson) ?>
    <fieldset>
        <legend><?= __('Add Mode Cuisson') ?></legend>
        <?php
            echo $this->Form->input('parent');
            echo $this->Form->input('lib');
            echo $this->Form->input('rem');
            echo $this->Form->input('img');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
