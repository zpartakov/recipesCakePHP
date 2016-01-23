<?php
//http://book.cakephp.org/3.0/en/orm/query-builder.html
$this->set('title', 'Accueil');
?>

<div style="margin-left: 5%; margin-right: 7%">
<table>
	<tr>
		<td>
			<?php
			echo $this->element('total_recettes');
			?>
		</td>
		<td>
			<?php
			echo $this->element('random_image');
			?>
		</td>
	</tr>
</table>			
<div style="text-align: center">
<form action='/recettes/recettes/' method="get" name="formu"> 
	<input type="hidden" name="cherche" value="1">
<h3 style="display: inline;">Recherche simple&nbsp;<input type="text" name="globalsearch" style="width: 250px; display: inline">&nbsp;<input type="submit"></h2>
</form>
</div>
<div id="advanced_search">
<hr />
<h2 style="text-align: center">Recherche avancée</h2>
<form action='/recettes/recettes/' method="get" name="formu" target="_blank"> 
		<input type="hidden" name="cherche" value="1">

  <table width="95%" border="0" cellpadding="5">
    <tr> 
      <td style="width: 25%; vertical-align: top">
		<h2 style="padding-top: 8px">Provenance</h2>
		<?php
		echo $this->element('les_pays');
		?>

      <h2 style="padding-top: 8px">Mode de cuissons</h2>
		<?php
		echo $this->element('les_modes2cuisson');
		?>
      </td>
	 
      <td style="width: 45%; vertical-align: top"> 
        <table class=latable>

    <tr> 
      <td class=gros> Titre </td>
      <td class=gros> 
        <input type='text' name='titre' size="30">
      </td>
    </tr>
    <tr> 
      <td class=gros>Préparation </td>
      <td class=gros> 
        <input type='text' name='prep' size="30">

      </td>
 </tr><tr>
      <td class=gros  colspan=2>

   </td>

	
    </tr>
    <tr> 
      <td rowspan="3" class=gros>Ingrédients</td>
      <td class=gros> 
		<?php
		echo $this->element('ingredients');
		?>
	  </td>
    </tr>

    <tr> 
	<td>2e ingrédient (facultatif)</td>	
      <td class=gros> 
        <input type="radio" name="selection" value="" checked>&nbsp;ET
        <input type="radio" name="selection" value="NOT">&nbsp;NON
        <input type='text' name='ingrNot'>
      </td>
    </tr>
    
    <tr> 
	<td>3e ingrédient (facultatif)</td>	
      <td class=gros> 
        <input type="radio" name="selection1" value="" checked>&nbsp;ET
        <input type="radio" name="selection1" value="NOT">&nbsp;NON
        <input type='text' name='ingrNot1'>
      </td>
     </tr>
    
    <tr> 
      <td> 
              <div align="left"> 
                <input type='reset' value='Annuler'>
				</div>
				</td><td>

  <div align="right"> 
                  <input class="bigbutton" type='submit' name='Chercher' value='Chercher'>
              </div>
		</table>
	  </td>
	  <td style="width: 25%; vertical-align: top">
        <h2>Type</h2>
	  <?php
		echo $this->element('les_types');
      ?>
      
        <h2>Régime</h2>
	  <?php
		echo $this->element('les_regimes');
      ?>
      
<table>
	<tr>
		<td>Recettes pour enfants&nbsp;<input type="checkbox" name="kids" value="1"></td>
	</tr>
		<tr>
		<td>Recettes avec image&nbsp;<input type="checkbox" name="image" value="1"></td>
	</tr>
<?php
if($this->Session->read('Auth.User')['role']=="administrator"||$_SERVER["HTTP_HOST"]=="localhost"){
?>
	<tr>
		<td>Texte intégral&nbsp;<input type="checkbox" name="fulltext" value="1"></td>
	</tr>
	<tr>
		<td>Source&nbsp;<input type="text" name="source"></td>
	</tr>
<?
}
?>
</table>
</td>
    </tr>
  </table>
  </div>
</form>













