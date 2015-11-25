<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Recette User'), ['controller' => 'RecetteUser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Recette User'), ['controller' => 'RecetteUser', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stats'), ['controller' => 'Stats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stat'), ['controller' => 'Stats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Username') ?></h6>
            <p><?= h($user->username) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($user->email) ?></p>
            <h6 class="subheader"><?= __('Pseudo') ?></h6>
            <p><?= h($user->pseudo) ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= h($user->role) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('DateIn') ?></h6>
            <p><?= h($user->dateIn) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Password') ?></h6>
            <?= $this->Text->autoParagraph(h($user->password)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Recette User') ?></h4>
    <?php if (!empty($user->recette_user)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->recette_user as $recetteUser): ?>
        <tr>
            <td><?= h($recetteUser->id) ?></td>
            <td><?= h($recetteUser->recette_id) ?></td>
            <td><?= h($recetteUser->user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'RecetteUser', 'action' => 'view', $recetteUser->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'RecetteUser', 'action' => 'edit', $recetteUser->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RecetteUser', 'action' => 'delete', $recetteUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recetteUser->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Stats') ?></h4>
    <?php if (!empty($user->stats)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Recette Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Ip') ?></th>
            <th><?= __('Date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->stats as $stats): ?>
        <tr>
            <td><?= h($stats->id) ?></td>
            <td><?= h($stats->recette_id) ?></td>
            <td><?= h($stats->user_id) ?></td>
            <td><?= h($stats->ip) ?></td>
            <td><?= h($stats->date) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Stats', 'action' => 'view', $stats->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Stats', 'action' => 'edit', $stats->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stats', 'action' => 'delete', $stats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stats->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tags') ?></h4>
    <?php if (!empty($user->tags)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Lib') ?></th>
            <th><?= __('Datein') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->tags as $tags): ?>
        <tr>
            <td><?= h($tags->id) ?></td>
            <td><?= h($tags->lib) ?></td>
            <td><?= h($tags->datein) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
