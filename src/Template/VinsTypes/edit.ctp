<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vinsType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vinsType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vins Types'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="vinsTypes form large-10 medium-9 columns">
    <?= $this->Form->create($vinsType) ?>
    <fieldset>
        <legend><?= __('Edit Vins Type') ?></legend>
        <?php
            echo $this->Form->input('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
