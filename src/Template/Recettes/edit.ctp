<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $recette->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $recette->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Recettes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mode Cuissons'), ['controller' => 'ModeCuissons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mode Cuisson'), ['controller' => 'ModeCuissons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diets'), ['controller' => 'Diets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diet'), ['controller' => 'Diets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Recette User'), ['controller' => 'RecetteUser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Recette User'), ['controller' => 'RecetteUser', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stats'), ['controller' => 'Stats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stat'), ['controller' => 'Stats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users Tags'), ['controller' => 'UsersTags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Users Tag'), ['controller' => 'UsersTags', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="recettes form large-10 medium-9 columns">
    <?= $this->Form->create($recette) ?>
    <fieldset>
        <legend><?= __('Edit Recette') ?></legend>
        <?php
            echo $this->Form->input('prov');
            echo $this->Form->input('titre');
            echo $this->Form->input('temps');
            echo $this->Form->input('ingr');
            echo $this->Form->input('pers');
            echo $this->Form->input('type_id', ['options' => $types]);
            echo $this->Form->input('prep');
            echo $this->Form->input('date');
            echo $this->Form->input('score');
            echo $this->Form->input('source');
            echo $this->Form->input('pict');
            echo $this->Form->input('private');
            echo $this->Form->input('mode_cuisson_id', ['options' => $modeCuissons]);
            echo $this->Form->input('time');
            echo $this->Form->input('difficulty');
            echo $this->Form->input('price');
            echo $this->Form->input('diet_id', ['options' => $diets]);
            echo $this->Form->input('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
