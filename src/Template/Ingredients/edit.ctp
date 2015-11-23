<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ingredient->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ingredients'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="ingredients form large-10 medium-9 columns">
    <?= $this->Form->create($ingredient) ?>
    <fieldset>
        <legend><?= __('Edit Ingredient') ?></legend>
        <?php
            echo $this->Form->input('libelle');
            echo $this->Form->input('typ');
            echo $this->Form->input('unit');
            echo $this->Form->input('kcal');
            echo $this->Form->input('price');
            echo $this->Form->input('img');
            echo $this->Form->input('commissions');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
