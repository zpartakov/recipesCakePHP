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

<?=$html->css(array('print'), 'stylesheet', array('media' => 'print'));?>
<link rel="shortcut icon" href="<? echo CHEMIN; ?>app/webroot/img/casserole.ico" type="image/x-icon" />

<?
#echo $javascript->link('jquery.min.js');
#echo $javascript->link('bak2top.js');
echo $javascript->link('recettes.js');
/* scroll to top script */
echo $javascript->link('jquery-1.5.1.js');
echo $javascript->link('scrolltopcontrol');

e($html->meta('rss', array('controller' => 'recettes', 'action' => 'rss'), array('title' => "Les dernières recettes")));
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
<? 
/*$utilisateur=$session->read('Auth.User.id');

echo "Utilisateur: " .$utilisateur ."<br>";
echo "Votre groupe: " .$session->read('Auth.User.role')."<br>";*/
    //get the authentification informations
   #echo $session->flash();
   #echo  $session->flash('auth');
    ?>
<noscript>
<h1>Activez JavaScript! si vous voulez bénéficiez de toutes les fonctionnalités de ce site</h1>
</noscript>

<h1 id="header" class="titre">
<table class="titre">
	<tr class="titre">
		<td class="titre">
			<a href="<? echo CHEMIN; ?>" title="Accueil recettes Fred Radeff">
			<? echo $html->image('logo/6505.02.gif', array("alt"=>"Accueil recettes Fred Radeff", "width" => "80px", "style"=>"vertical-align: middle"));?>
			</a>
			<!-- flux rss http://www.akademia.ch/recettes2/recettes/rss?user=login&password=pwd -->
			<? echo SITE ." - " .$this->pageTitle ?>
		&nbsp;
<a href="<? echo CHEMIN; ?>recettes/rss" title="Flux RSS recettes Fred Radeff">
			<? echo $html->image('rss.gif', array("alt"=>"Flux RSS recettes Fred Radeff", "width" => "40px"));
			?>
			</a></td>
		<td class="titre" style="vertical-align: middle">
<!-- ########################### GLOBAL SEARCH ENGINE ######################## -->

<form method="get" action="<? echo CHEMIN; ?>recettes/chercher">
<input type="text" name="chercher" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
<input type="image" src="/recettes2/img/find.png" alt="Chercher" title="Chercher">
</form>
<div class="suggestionsBox" id="suggestions" style="display: none;">
<img src="<? echo CHEMIN?>/img/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
&nbsp;
</div>
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


<div class="help">
<table>
	<tr>

<td class="tablepied"><?
echo "<a href=\"http://www.akademia.ch/dokuwiki/doku.php?id=cuisine:aide_recettes\">";
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
echo '<a class="contact" href="http://www.akademia.ch/dokuwiki/fred_radeff" title="About">'.$html->image('linux/tux_che.jpg', array("alt"=>"About")).'</a>';
?>
</td>
<!-- contact -->
<td class="tablepied">
<?php
echo '<a class="contact" href="http://www.akademia.ch/writemail.php" title="Contact">'.$html->image('ico-contact.gif', array("alt"=>"Contact")).'</a>';
?>
</td>

<td class="tablepied">
<?
//license
echo '<a target="_blank" href="http://www.gnu.org/licenses/gpl-3.0.txt">'.$html->image('copyleft.jpg', array("alt"=>"GPL License / CopyLeft","title"=>"GPL License / CopyLeft","width"=>"45","height"=>"45")).'</a>';
?>
</td></tr>
</table>

</div>


</div>
		<?
echo $html->image('qrcode.png', array("alt"=>"Code QR","title"=>"Code QR"));
?>

 </body>
 </html>