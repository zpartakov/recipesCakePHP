<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Type'), ['action' => 'edit', $type->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type'), ['action' => 'delete', $type->id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recettes'), ['controller' => 'Recettes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recette'), ['controller' => 'Recettes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recettes00'), ['controller' => 'Recettes00', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recettes00'), ['controller' => 'Recettes00', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="types view large-10 medium-9 columns">
    <h2><?= h($type->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($type->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($type->id) ?></p>
            <h6 class="subheader"><?= __('Order') ?></h6>
            <p><?= $this->Number->format($type->order) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Recettes') ?></h4>
    <?php if (!empty($type->recettes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Prov') ?></th>
            <th><?= __('Titre') ?></th>
            <th><?= __('Temps') ?></th>
            <th><?= __('Ingr') ?></th>
            <th><?= __('Pers') ?></th>
            <th><?= __('Type Id') ?></th>
            <th><?= __('Prep') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('Score') ?></th>
            <th><?= __('Source') ?></th>
            <th><?= __('Pict') ?></th>
            <th><?= __('Private') ?></th>
            <th><?= __('Mode Cuisson Id') ?></th>
            <th><?= __('Time') ?></th>
            <th><?= __('Difficulty') ?></th>
            <th><?= __('Price') ?></th>
            <th><?= __('Diet Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($type->recettes as $recettes): ?>
        <tr>
            <td><?= h($recettes->id) ?></td>
            <td><?= h($recettes->prov) ?></td>
            <td><?= h($recettes->titre) ?></td>
            <td><?= h($recettes->temps) ?></td>
            <td><?= h($recettes->ingr) ?></td>
            <td><?= h($recettes->pers) ?></td>
            <td><?= h($recettes->type_id) ?></td>
            <td><?= h($recettes->prep) ?></td>
            <td><?= h($recettes->date) ?></td>
            <td><?= h($recettes->score) ?></td>
            <td><?= h($recettes->source) ?></td>
            <td><?= h($recettes->pict) ?></td>
            <td><?= h($recettes->private) ?></td>
            <td><?= h($recettes->mode_cuisson_id) ?></td>
            <td><?= h($recettes->time) ?></td>
            <td><?= h($recettes->difficulty) ?></td>
            <td><?= h($recettes->price) ?></td>
            <td><?= h($recettes->diet_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Recettes', 'action' => 'view', $recettes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Recettes', 'action' => 'edit', $recettes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Recettes', 'action' => 'delete', $recettes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recettes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Recettes00') ?></h4>
    <?php if (!empty($type->recettes00)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Prov') ?></th>
            <th><?= __('Titre') ?></th>
            <th><?= __('Temps') ?></th>
            <th><?= __('Ingr') ?></th>
            <th><?= __('Pers') ?></th>
            <th><?= __('Type Id') ?></th>
            <th><?= __('Prep') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('Score') ?></th>
            <th><?= __('Source') ?></th>
            <th><?= __('Pict') ?></th>
            <th><?= __('Private') ?></th>
            <th><?= __('Mode Cuisson Id') ?></th>
            <th><?= __('Time') ?></th>
            <th><?= __('Difficulty') ?></th>
            <th><?= __('Price') ?></th>
            <th><?= __('Diet Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($type->recettes00 as $recettes00): ?>
        <tr>
            <td><?= h($recettes00->id) ?></td>
            <td><?= h($recettes00->prov) ?></td>
            <td><?= h($recettes00->titre) ?></td>
            <td><?= h($recettes00->temps) ?></td>
            <td><?= h($recettes00->ingr) ?></td>
            <td><?= h($recettes00->pers) ?></td>
            <td><?= h($recettes00->type_id) ?></td>
            <td><?= h($recettes00->prep) ?></td>
            <td><?= h($recettes00->date) ?></td>
            <td><?= h($recettes00->score) ?></td>
            <td><?= h($recettes00->source) ?></td>
            <td><?= h($recettes00->pict) ?></td>
            <td><?= h($recettes00->private) ?></td>
            <td><?= h($recettes00->mode_cuisson_id) ?></td>
            <td><?= h($recettes00->time) ?></td>
            <td><?= h($recettes00->difficulty) ?></td>
            <td><?= h($recettes00->price) ?></td>
            <td><?= h($recettes00->diet_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Recettes00', 'action' => 'view', $recettes00->]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Recettes00', 'action' => 'edit', $recettes00->]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Recettes00', 'action' => 'delete', $recettes00->], ['confirm' => __('Are you sure you want to delete # {0}?', $recettes00->)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
