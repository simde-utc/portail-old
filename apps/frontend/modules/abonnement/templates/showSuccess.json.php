[<?php
$result = array();
$i=0;
foreach ($abonnements as $abonnement) 
{
  if($i!=0) { echo ","; } else { $i++; }
  $asso = $abonnement->getAsso();
  $arr = array(
    "id" => ($asso->getId()),
    "name" => ($asso->getName()),
    "login" => ($asso->getLogin()),
    "pole" => array(
    		"id" => $asso->getPoleId(),
    		"name" => $asso->getPoleName()
    		)
  );
  echo json_encode($arr);
}
?>]
