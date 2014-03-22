<?
######################################################
//redirections pour assurer les anciens urls
if(preg_match("/show.php/",$_SERVER["QUERY_STRING"])){
	if($_GET['id']) {
	header("Location: /recettes2/recettes/view/" .$_GET['id']);
	}
}
if(preg_match("/search.php/",$_SERVER["QUERY_STRING"])){
	#echo phpinfo(); exit;
	header("Location: /recettes2/recettes/chercher?" .preg_replace("/url=search.php./","",$_SERVER["QUERY_STRING"]));
}
######################################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
             "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title><? echo SITE ." - " .$this->pageTitle ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

   <?php e($scripts_for_layout); ?>

<?=$html->css(array('cake.generic'), 'stylesheet', array('media' => 'screen'));?>
<?=$html->css(array('hiermenu'), 'stylesheet', array('media' => 'screen'));?>
<?=$html->css(array('recettes'), 'stylesheet', array('media' => 'screen'));?>
<?=$html->css(array('jquery.tagsinput'), 'stylesheet', array('media' => 'screen'));?>
<?=$html->css(array('print'), 'stylesheet', array('media' => 'print'));?>

<link rel="shortcut icon" href="<? echo CHEMIN; ?>app/webroot/img/casserole.ico" type="image/x-icon" />

<?
echo $javascript->link('recettes.js');
/* scroll to top script */
echo $javascript->link('jquery-1.5.1.js');
echo $javascript->link('scrolltopcontrol');
echo $javascript->link('jquery.tagsinput');
//e($html->meta('rss', array('controller' => 'recettes', 'action' => 'rss'), array('title' => "Les dernières recettes")));
?>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("<? echo CHEMIN;?>pages/rpc", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

</head>

<body>
<noscript>
<h1>Activez JavaScript! si vous voulez bénéficiez de toutes les fonctionnalités de ce site</h1>
</noscript>

<h1 id="header" class="titre">
<table class="titre">
	<tr class="titre">
		<td class="titre">
			<a href="<? echo CHEMIN; ?>" title="Accueil recettes Fred Radeff">
			<? echo $html->image('logo/6505.02.gif', array("alt"=>"Accueil recettes Fred Radeff", "width" => "80px", "style"=>"vertical-align: middle"));?>
			<span style="color: rgb(255, 217, 123);">
            <? echo SITE; ?>
            <? #echo SITE ." - " .$this->pageTitle ?>
			</span>
			</a>
<?php 
/*
 * bug with rss so hidden?
 */?>			
<!--		&nbsp;
<a href="<? echo CHEMIN; ?>recettes/rss" title="Flux RSS recettes Fred Radeff">
			<? echo $html->image('rss.gif', array("alt"=>"Flux RSS recettes Fred Radeff", "width" => "40px"));
			?>
			</a>
			-->
			</td>
		<td class="titre" style="vertical-align: middle">
<!-- ########################### GLOBAL SEARCH ENGINE ######################## -->

<div style="position: relative; left: -70px; top: 5px;">
<form method="get" action="<? echo CHEMIN; ?>recettes/chercher">
<input style="width: 80px; position: relative; left: -10px;" type="text" name="chercher" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
<input type="image" src="/recettes2/img/find.png" alt="Chercher" title="Chercher">
</form>
</div>
<!-- <div class="suggestionsBox" id="suggestions" style="display: none;">
<img src="<? echo CHEMIN?>/img/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
&nbsp;
</div> -->
</td>
	</tr>
</table>
 	<!-- AddThis Button BEGIN -->
<div style="position:fixed;
top:5px;
right:100px;" class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_tweet"></a>
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f60817a65334906"></script>
<!-- AddThis Button END -->

</h1>


<!-- navigation -->
<div id="leftnav" class="menu">
<?php echo $this->element('menu');?>
</div>

<!-- content -->
		
		<div id="container">


    <div id="content">

    <br />


         <?=$content_for_layout;?>
     </div>
     </div>

<div id="footer">
<!-- footer -->
<div style="font-size: smaller; color: black; background-color: lightyellow; padding: 12px; margin-right: 10%; margin-left: 10%; margin-bottom: 20px">
<div class="help">
<table>
	<tr>

<td class="tablepied"><?
echo "<a href=\"http://radeff.net/dokuwiki/doku.php?id=cuisine:aide_recettes\">";
echo $html->image('help.png', array("alt"=>"Aide","title"=>"Aide","width"=>"50","height"=>"50"));
echo "</a>";
?>
 </td>

<td class="tablepied">
<?php 
//print page
echo "<a class=\"logoprint\" href=\"javascript:window.print();\">";
echo $html->image('icon-print.jpg', array("alt"=>"Imprimer","title"=>"Imprimer"));
echo "</a>"; 
?>
</td>
<!-- about -->
<td class="tablepied">
<?php
echo '<a class="contact" href="http://radeff.net/c5/webmastering/" title="About">'.$html->image('linux/tux_che.jpg', array("alt"=>"About")).'</a>';
?>
</td>
<!-- github -->
<td class="tablepied">
<?php
echo '<a class="contact" href="https://github.com/zpartakov/recipesCakePHP" title="github repository">'.$html->image('github.png', array("alt"=>"github repository")).'</a>';
?>
</td>
<!-- contact -->
<td class="tablepied">
<?php
echo '<a class="contact" href="http://radeff.net/c5/contact-us/" title="Contact">'.$html->image('ico-contact.gif', array("alt"=>"Contact")).'</a>';
?>
</td>

<td class="tablepied">
<?
//license
echo '<a target="_blank" href="http://www.gnu.org/licenses/gpl-3.0.txt">'
.$html->image('copyleft.jpg', array("alt"=>"GPL License / CopyLeft","title"=>"GPL License / CopyLeft","width"=>"45","height"=>"45"))
.'</a>';
?>
</td>
<td>
		<?
echo $html->image('qrcode.png', array("alt"=>"Code QR","title"=>"Code QR", 'width'=>'45'));
#echo phpinfo();
?>
</td>
<td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/fr_FR/CH/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
</td>
</tr>
</table>

</div>


</div>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://radeff.net/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();

</script>
<noscript><p><img src="http://radeff.net/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

 </body>
 </html>
