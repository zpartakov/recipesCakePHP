<?php
$this->set('title', "Login");
?>
<?= $this->Form->create() ?>
<?= $this->Form->input('username') ?>
<?= $this->Form->input('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
