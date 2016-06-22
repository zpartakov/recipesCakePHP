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
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
		<?= $this->Html->css('hamburger.css') ?>
		<?= $this->Html->css('recettes.css') ?>
		<?= $this->Html->css('print.css', array('media' => 'print'));?>

		<?= $this->Html->script('recettes.js') ?>
        <?= $this->Html->script('jquery-2.1.4.js') ?>

		<?= $this->Html->script('jquery-ui.js') ?>
        <?= $this->Html->script('hamburger.js') ?>
        <?= $this->Html->script('jquery.scroll2Top.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    		<!-- scroll2Top CSS -->
		<style>
			#to_the_top {
				display: none;
				position: fixed;
				cursor: pointer;
				/* modify below css to your needs */
				background: url('/pics/top.png') no-repeat left top;
				width: 60px;
				height: 60px;
				top: 240px;
				right: 50px;
			}
		</style>

		<!-- scroll2Top JS -->
		<script>
			$(function() {
				// default configuration
				$("#to_the_top").scroll2Top();
			});
		</script>
</head>
<body>
<div id="container">



    <header>
    <h1><a href="<?php echo CHEMIN; ?>">Recettes de cuisine Fred Radeff&nbsp;<img src="/pics/casserole.png" alt="image casserole"/></a><a href="<? echo CHEMIN; ?>recettes/rss"><img src="/pics/rss.png" alt="Flux RSS"></a></h1>
           <div id="hamburger">
                <div></div>
   		         <div></div>
   		         <div></div>
  	      </div>
    </header>


  	      <h2 style="margin-left: 1em"><?php echo $title; ?></h2>

        <!-- navigation -->
<?php echo $this->element('menu');?>
        <!--The Layer that will be layed over the content
    so that the content is unclickable while menu is shown-->
    <div id="contentLayer"></div>
    <!--The content of the site-->
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
<table>
	<tr>
	<td>
		<a href="/recettes/pages/aide" title="Aide"><img src="/recettes/img/help.png" alt="Aide" /></a>
	</td>
	<td>
		<a href="/www2/services" title="About"><img src="/recettes/img/linux/tux_che.jpg" alt="About" /></a>
	</td>
	<td>
		<a href="https://github.com/zpartakov/recipesCakePHP" title="github repository"><img src="/recettes/img/github.png" alt="github repository" /></a>
	</td>
	<td>
		<a href="/www2/contact" title="contact"><img src="/recettes/img/ico-contact.gif" alt="contact" /></a>
	</td>
	<td>
		<a href="http://creativecommons.org/licenses/by-sa/2.0/fr/" title="GPL License / CopyLeft"><img src="/recettes/img/copyleft.jpg" style="width: 45; height: 45" alt="GPL License / CopyLeft" /></a></td>
	<td>
		<a href="<? echo CHEMIN; ?>recettes/rss"><img src="/pics/rss-feed.png" alt="Flux RSS" style="width: 15; height: 45"></a>
	</td>
	<td>
		<img src="/recettes/img/qrcode.png" style="width: 45" alt="Code QR" />
	</td>
	</tr>
</table>
        </div>
    </div>

</div>
<?= $this->Flash->render('auth') ?>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//radeff.red/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 4]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//radeff.red/piwik/piwik.php?idsite=4" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
		<div id="to_the_top"></div>
</body>
</html>
