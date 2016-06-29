<?php
$cakeDescription = 'Recettes de cuisine Fred Radeff';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?php echo $title; ?>
    </title>
		<?= $this->Html->css('print.css', array('media' => 'screen'));?>
		<?= $this->Html->css('print.css', array('media' => 'print'));?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <h1>Recettes de cuisine Fred Radeff&nbsp;<img src="/pics/casserole.png" alt="image casserole"/></h1>
  	  <h2 style="margin-left: 1em"><?php echo $title; ?></h2>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>

</body>
</html>
