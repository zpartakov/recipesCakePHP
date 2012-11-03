<?php
$this->pageTitle = 'Accueil'; 

if($session->read('Auth.User.role')) {
		echo "Bienvenue, " .$session->read('Auth.User.username');
	echo "<br>Ton groupe: " .$session->read('Auth.User.role')."<br>";
}



 //total_recettes
      $this->requestAction('/recettes/total_recettes');
?>


<form action='recettes/chercher' method="get" name="formu">
  <table width="641" border="0" cellpadding="5">
    <tr> 
      <td rowspan="6" width="189">
      <?
		//include countries
      $this->requestAction('/recettes/pays');
      ?>
      </td>
	 
      <td width="385"> 
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
      <td rowspan="3" class=gros>Ingr&eacute;dients 
</td>
      <td class=gros> 
      <?
		//include ingrédients
      $this->requestAction('/ingredients/liste_ingredients');
      ?>
	  </td>
    </tr>

    <tr> 
      <td class=gros> 
        <select name=selection>
          <option value="" selected>ET 
          <option value="NOT" default>NON 
        </select>
        <input type='text' name='ingrNot'>
      </td>
    </tr>
    <tr> 
      <td class=gros> 
        <select name=selection1>
          <option value="" selected>ET 
          <option value="NOT" default>NON 
        </select>
        <input type='text' name='ingrNot1'>
      </td></tr>
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
	  <td>
        <h2>Type</h2>
              <?
		//include ingrédients
      $this->requestAction('/recettes/les_types');
      ?>
<table>
	<tr>
		<td>Recettes pour enfants&nbsp;<input type="checkbox" name="kids" value="1"></td>
	</tr>
		<tr>
		<td>Recettes avec image&nbsp;<input type="checkbox" name="image" value="1"></td>
	</tr>
<?php
#if($session->read('Auth.User.role')=="administrator") {
if($session->read('Auth.User.role')) {
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
</form>











