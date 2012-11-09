<?php
#    'title' => preg_replace("/\?/","_",preg_replace("/<!--.*-->/","",utf8_decode($recette['Recette']['titre']))),
#    'title' => utf8_encode($recette['Recette']['titre']),

exit;
e($rss->items($recettes, 'sortieRSS'));
function sortieRSS($recette)
{
  return array(
    'title' => preg_replace("/\?/","_",preg_replace("/<!--.*-->/","",utf8_decode($recette['Recette']['titre']))),
    'link'  => "http://".$_SERVER["HTTP_HOST"].CHEMIN.'recettes/view/'.$recette['Recette']['id'],
    'pays' => utf8_encode($recette['Recette']['prov']),
    'date' => $recette['Recette']['date']
  );
}
?>
