<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $restaurant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Restaurants'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="restaurants form large-10 medium-9 columns">
    <?= $this->Form->create($restaurant) ?>
    <fieldset>
        <legend><?= __('Edit Restaurant') ?></legend>
        <?php
            echo $this->Form->input('nom');
            echo $this->Form->input('adresse');
            echo $this->Form->input('tel');
            echo $this->Form->input('email');
            echo $this->Form->input('url');
            echo $this->Form->input('zip');
            echo $this->Form->input('ville');
            echo $this->Form->input('pays');
            echo $this->Form->input('type');
            echo $this->Form->input('rem');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
