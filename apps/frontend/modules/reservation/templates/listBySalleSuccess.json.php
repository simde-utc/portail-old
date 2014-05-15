<?php
$result = array();
foreach ($reservation as $res){
  $asso = $res->getAsso();
  $result[] = array(
    "id" => ($res->getId()),
    "title" => $asso->getName(),
    "allDay" => false,
    "start" => strtotime($res->getDate() . " " . $res->getheuredebut()),
    "end" => strtotime($res->getDate() . " " . $res->getheurefin()),
    "color" => $res->getSalle()->getCouleur(),
    "url" => url_for('reservation_show', array("id" => $res->getID()))
  );  
}
echo json_encode($result);
?>
