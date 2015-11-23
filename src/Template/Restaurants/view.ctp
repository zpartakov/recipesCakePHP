<?php 
$this->set('title', "Restaurant: " .$restaurant->nom);

if($this->Session->read('Auth.User')['role']!="administrator"){
	$admin=0;
	$lestyle="display: none";
}else {
	$admin=1;
	$lestyle="";
}
?>
<div class="actions columns large-2 medium-3" style="<?php echo $lestyle; ?>">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Restaurant'), ['action' => 'edit', $restaurant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Restaurant'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Restaurants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Restaurant'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="restaurants view large-10 medium-9 columns">
    <h2 style="<?php echo $lestyle; ?>"><?= h($restaurant->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader" style="<?php echo $lestyle; ?>"><?= __('Nom') ?></h6>
            <p style="<?php echo $lestyle; ?>"><?= h($restaurant->nom) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($restaurant->email) ?></p>
            <h6 class="subheader"><?= __('Url') ?></h6>
            <p><?= h($restaurant->url) ?></p>
            <h6 class="subheader"><?= __('Zip') ?></h6>
            <p><?= h($restaurant->zip) ?></p>
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= h($restaurant->type) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Tel') ?></h6>
            <p><?= h($restaurant->tel) ?></p>
            <h6 class="subheader" style="<?php echo $lestyle; ?>"><?= __('Id') ?></h6>
            <p style="<?php echo $lestyle; ?>"><?= $this->Number->format($restaurant->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Ville') ?></h6>
            <p><?= h($restaurant->ville) ?></p>
            <h6 class="subheader"><?= __('Pays') ?></h6>
            <p><?= h($restaurant->pays) ?></p>
            <h6 class="subheader" style="<?php echo $lestyle; ?>"><?= __('Created') ?></h6>
            <p style="<?php echo $lestyle; ?>"><?= h($restaurant->created) ?></p>
            <h6 class="subheader" style="<?php echo $lestyle; ?>"><?= __('Modified') ?></h6>
            <p style="<?php echo $lestyle; ?>"><?= h($restaurant->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Adresse') ?></h6>
            <?= $this->Text->autoParagraph(h($restaurant->adresse)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Rem') ?></h6>
            <?= $this->Text->autoParagraph(h($restaurant->rem)) ?>
        </div>
    </div>
</div>
