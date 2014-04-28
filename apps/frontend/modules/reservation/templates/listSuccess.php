<?php
$result = array();
foreach ($reservations as $res){
  $asso = $res->getAsso();
  $result[] = array(
    "id" => ($res->getId()),
    "title" => $asso->getName(),
    "allDay" => false,
    "start" => strtotime($res->getDate() . " " . $res->getheuredebut()),
    "end" => strtotime($res->getDate() . " " . $res->getheurefin()),
    //"color" => ($res->getAsso()->isPole())?($res->getAsso()->getPoleInfos()->getCouleur()) :($res->getAsso()->getPole()->getCouleur()),
  );  
}
echo json_encode($result);
?>
